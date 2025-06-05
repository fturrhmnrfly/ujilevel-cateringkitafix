class CheckoutManager {
    constructor() {
        this.cartItems = [];
        this.currentOrderId = null;
        this.init();
    }

    init() {
        this.renderCheckoutItems();
        this.setupEventListeners();
        this.setupValidation();
    }

    setupEventListeners() {
        // Shipping modal
        document.getElementById('see-all-shipping')?.addEventListener('click', (e) => {
            e.preventDefault();
            this.showShippingModal();
        });

        document.getElementById('close-shipping-modal')?.addEventListener('click', () => {
            this.closeShippingModal();
        });

        document.getElementById('confirm-shipping')?.addEventListener('click', () => {
            this.confirmShippingOption();
        });

        // Payment modal
        document.getElementById('payment-method-link')?.addEventListener('click', (e) => {
            this.showPaymentModal(e);
        });

        // Form submission
        document.getElementById('submit-order')?.addEventListener('click', (e) => {
            this.submitOrder(e);
        });

        // Form field changes
        document.querySelectorAll('input, textarea').forEach(field => {
            field.addEventListener('change', () => this.checkFormCompletion());
            field.addEventListener('input', () => this.checkFormCompletion());
        });

        // Modal close handlers
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeAllModals();
            }
        });
    }

    setupValidation() {
        this.setupPhoneValidation();
        this.setupDateValidation();
    }

    formatPrice(price) {
        return "Rp " + price.toLocaleString('id-ID');
    }

    generateOrderId() {
        const timestamp = new Date().getTime();
        const random = Math.floor(Math.random() * 1000);
        return `ORD${timestamp}${random}`;
    }

    renderCheckoutItems() {
        const container = document.getElementById('checkout-items');
        this.cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        container.innerHTML = '';

        this.cartItems.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'order-item';
            itemElement.innerHTML = `
                <img src="${item.image}" alt="${item.nama_produk}" class="item-image">
                <div class="item-details">
                    <div class="item-name">${item.nama_produk || 'Nama tidak tersedia'}</div>
                    <div class="item-price">${this.formatPrice(item.price)} x ${item.quantity}</div>
                </div>
                <button class="remove-item" onclick="checkout.removeItem(${item.id})">×</button>
            `;
            container.appendChild(itemElement);
        });
        
        this.updateTotals();
    }

    updateTotals() {
        this.cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const subtotal = this.cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);

        document.getElementById('subtotal').textContent = this.formatPrice(subtotal);

        const selectedShipping = document.querySelector('input[name="shipping_option"]:checked');
        const shippingCosts = { 'self': 0, 'instant': 10000, 'regular': 5000, 'economy': 2000 };
        const shippingCost = selectedShipping ? shippingCosts[selectedShipping.value] : 0;

        const shippingDisplay = document.querySelector('.summary-item:nth-child(2) span:last-child');
        shippingDisplay.textContent = shippingCost ? this.formatPrice(shippingCost) : '-';

        const total = subtotal + shippingCost;
        document.getElementById('total').textContent = this.formatPrice(total);
        localStorage.setItem('orderTotal', total.toString());
    }

    removeItem(itemId) {
        const index = this.cartItems.findIndex(item => item.id === itemId);
        if (index !== -1) {
            this.cartItems.splice(index, 1);
            localStorage.setItem('cartItems', JSON.stringify(this.cartItems));
            this.renderCheckoutItems();
        }
    }

    showShippingModal() {
        const modal = document.getElementById('shippingModal');
        modal.style.display = 'block';
        setTimeout(() => modal.classList.add('show'), 10);
    }

    closeShippingModal() {
        const modal = document.getElementById('shippingModal');
        modal.classList.remove('show');
        setTimeout(() => modal.style.display = 'none', 300);
    }

    confirmShippingOption() {
        const selectedOption = document.querySelector('input[name="modal_shipping_option"]:checked');
        if (selectedOption) {
            this.updateShippingDisplay(selectedOption.value);
            this.closeShippingModal();
        } else {
            alert('Silakan pilih opsi pengiriman');
        }
    }

    updateShippingDisplay(option) {
        const shippingOptions = {
            'self': { title: 'Ambil Sendiri', price: 0, icon: '🏪' },
            'instant': { title: 'Garansi Tepat Waktu', price: 10000, icon: '⚡' },
            'regular': { title: 'Regular', price: 5000, icon: '🚚' },
            'economy': { title: 'Hemat', price: 2000, icon: '💰' }
        };

        const selectedOption = shippingOptions[option];
        const mainShippingOptions = document.querySelector('.shipping-options');
        
        mainShippingOptions.innerHTML = `
            <div class="shipping-option">
                <input type="radio" id="selected-delivery" name="shipping_option" value="${option}" checked>
                <label for="selected-delivery" class="shipping-option-label">
                    <div class="option-content">
                        <div class="option-header">
                            <div class="option-title">${selectedOption.icon} ${selectedOption.title}</div>
                            <div class="option-price">${this.formatPrice(selectedOption.price)}</div>
                        </div>
                    </div>
                </label>
            </div>
        `;

        this.updateTotals();
        this.checkFormCompletion();
    }

    showPaymentModal(e) {
        e.preventDefault();
        
        const selectedShipping = document.querySelector('input[name="shipping_option"]:checked');
        if (!selectedShipping) {
            alert('Silakan pilih opsi pengiriman terlebih dahulu');
            return;
        }

        const orderId = this.generateOrderId();
        this.currentOrderId = orderId;
        const expiryTime = new Date(Date.now() + 24 * 60 * 60 * 1000);

        const modal = this.createPaymentModal(orderId);
        document.body.appendChild(modal);
        setTimeout(() => modal.classList.add('show'), 10);

        this.setupPaymentModalEvents(modal, orderId);
        this.startCountdown(expiryTime);
    }

    createPaymentModal(orderId) {
        const modal = document.createElement('div');
        modal.className = 'payment-modal';
        modal.id = 'paymentModal';
        modal.innerHTML = `
            <div class="payment-modal-content">
                <div class="modal-header">
                    <h3>Metode Pembayaran</h3>
                    <span class="close" id="close-payment-modal">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="order-info">
                        <div class="order-row">
                            <span>Order ID</span>
                            <span>${orderId}</span>
                        </div>
                        <div class="order-row">
                            <span>Batas Waktu Pembayaran</span>
                            <span class="countdown">23:59:59</span>
                        </div>
                    </div>
                    <div class="payment-options">
                        ${this.createPaymentOptions()}
                    </div>
                    <button class="konfirmasi-btn" id="confirm-payment">Konfirmasi</button>
                </div>
            </div>
        `;
        return modal;
    }

    createPaymentOptions() {
        const options = [
            { id: 'bca', name: 'BCA Virtual Account', image: 'kartubca.png' },
            { id: 'dana', name: 'Dana', image: 'dana.png' },
            { id: 'gopay', name: 'Gopay', image: 'gopay.png' },
            { id: 'cod', name: 'COD', image: 'cod.png' }
        ];

        return options.map(opt => `
            <div class="payment-option">
                <input type="radio" id="${opt.id}" name="payment_method" value="${opt.id}">
                <label for="${opt.id}">
                    <img src="/assets/${opt.image}" alt="${opt.name}">
                    <span>${opt.name}</span>
                </label>
            </div>
        `).join('');
    }

    setupPaymentModalEvents(modal, orderId) {
        // Payment options
        modal.querySelectorAll('input[name="payment_method"]').forEach(option => {
            option.addEventListener('change', () => {
                localStorage.setItem('selectedPaymentMethod', option.value);
                this.checkFormCompletion();
            });
        });

        // Close button
        modal.querySelector('#close-payment-modal').addEventListener('click', () => {
            this.closePaymentModal();
        });

        // Confirm button
        modal.querySelector('#confirm-payment').addEventListener('click', () => {
            this.confirmPaymentMethod(orderId);
        });

        // Close on outside click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) this.closePaymentModal();
        });
    }

    closePaymentModal() {
        const modal = document.getElementById('paymentModal');
        if (modal) {
            modal.classList.remove('show');
            setTimeout(() => modal.remove(), 300);
        }
    }

    confirmPaymentMethod(orderId) {
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
        if (!selectedPayment) {
            alert('Silakan pilih metode pembayaran');
            return;
        }

        const paymentLabels = {
            'bca': 'BCA Virtual Account',
            'dana': 'Dana',
            'gopay': 'Gopay',
            'cod': 'COD'
        };

        document.getElementById('selected-payment').textContent = paymentLabels[selectedPayment.value];
        localStorage.setItem('selectedPaymentMethod', selectedPayment.value);
        this.closePaymentModal();
        this.checkFormCompletion();
    }

    startCountdown(expiryTime) {
        const countdownElement = document.querySelector('.countdown');
        if (!countdownElement) return;

        const timer = setInterval(() => {
            const now = new Date().getTime();
            const target = new Date(expiryTime).getTime();
            const distance = target - now;

            if (distance <= 0) {
                clearInterval(timer);
                countdownElement.textContent = "Waktu Habis";
                countdownElement.style.color = "#e74c3c";
                this.cancelOrder();
                return;
            }

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElement.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }, 1000);
    }

    submitOrder(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submit-order');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Memproses...';

        if (!this.validateOrder()) {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Buat Pesanan';
            return;
        }

        const orderData = this.prepareOrderData();

        fetch('/checkout/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                localStorage.removeItem('cartItems');
                alert('Pesanan berhasil dibuat!');
                window.location.href = `/payment/metodepembayaran/${localStorage.getItem('selectedPaymentMethod')}`;
            } else {
                throw new Error(data.message || 'Gagal membuat pesanan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan: ' + error.message);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Buat Pesanan';
        });
    }

    validateOrder() {
        this.cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        if (!this.cartItems.length) {
            alert('Keranjang belanja kosong');
            return false;
        }

        const requiredFields = [
            { id: 'delivery-date', message: 'Tanggal pengiriman wajib diisi.' },
            { id: 'delivery-time', message: 'Waktu pengiriman wajib diisi.' },
            { id: 'address', message: 'Alamat pengiriman wajib diisi.' },
            { id: 'phone', message: 'Nomor telepon wajib diisi.' }
        ];

        for (const field of requiredFields) {
            const el = document.getElementById(field.id);
            if (!el || !el.value.trim()) {
                alert(field.message);
                el?.focus();
                return false;
            }
        }

        if (!document.querySelector('input[name="shipping_option"]:checked')) {
            alert('Silakan pilih opsi pengiriman.');
            return false;
        }

        if (!localStorage.getItem('selectedPaymentMethod')) {
            alert('Silakan pilih metode pembayaran terlebih dahulu.');
            return false;
        }

        return true;
    }

    prepareOrderData() {
        const shippingOptionElement = document.querySelector('input[name="shipping_option"]:checked');
        return {
            order_id: this.currentOrderId || this.generateOrderId(),
            nama_pelanggan: document.getElementById('user-name').value,
            kategori_pesanan: this.determineOrderCategory(this.cartItems),
            tanggal_pesanan: new Date().toISOString().split('T')[0],
            jumlah_pesanan: this.cartItems.reduce((sum, item) => sum + item.quantity, 0),
            tanggal_pengiriman: document.getElementById('delivery-date').value,
            waktu_pengiriman: document.getElementById('delivery-time').value,
            lokasi_pengiriman: document.getElementById('address').value,
            nomor_telepon: document.getElementById('phone').value,
            pesan: document.getElementById('notes').value || null,
            opsi_pengiriman: shippingOptionElement.value,
            total_harga: parseFloat(document.getElementById('total').textContent.replace(/[^\d]/g, '')),
            status_pengiriman: 'diproses',
            status_pembayaran: 'pending',
            items: this.cartItems
        };
    }

    determineOrderCategory(cartItems) {
        const nasiBoxItems = cartItems.some(item => item.nama_produk?.toLowerCase().includes('nasi box'));
        const prasmananItems = cartItems.some(item => item.nama_produk?.toLowerCase().includes('prasmanan'));

        if (nasiBoxItems && prasmananItems) return 'Nasi Box & Prasmanan';
        if (nasiBoxItems) return 'Nasi Box';
        if (prasmananItems) return 'Prasmanan';
        return 'Lainnya';
    }

    setupPhoneValidation() {
        const phoneInput = document.getElementById('phone');
        if (!phoneInput) return;

        phoneInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/(?!^\+)\D/g, '');
            if (this.value.length > 13) this.value = this.value.slice(0, 13);

            const phoneRegex = /^(?:(?:\+62|62)|0)(?:8[1-9][0-9]{8,10})$/;
            const isValid = phoneRegex.test(this.value) && this.value.length >= 10;
            
            this.setCustomValidity(isValid ? '' : 'Format nomor telepon tidak valid');
            this.style.borderColor = isValid ? '#2ecc71' : '#e74c3c';
        });
    }

    setupDateValidation() {
        const deliveryDateInput = document.getElementById('delivery-date');
        const deliveryTimeInput = document.getElementById('delivery-time');

        if (deliveryDateInput) {
            deliveryDateInput.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                const today = new Date();
                
                if (selectedDate.getDay() === 0) {
                    alert('Maaf, kami tidak melayani pengiriman di hari Minggu.');
                    this.value = '';
                    return;
                }
                
                if (selectedDate <= today) {
                    alert('Pemesanan harus dilakukan minimal H-1.');
                    this.value = '';
                    return;
                }
            });
        }

        if (deliveryTimeInput) {
            deliveryTimeInput.addEventListener('change', function() {
                const [hours] = this.value.split(':').map(Number);
                if (hours < 8 || hours > 20) {
                    alert('Waktu pengiriman hanya tersedia antara jam 08:00 - 20:00');
                    this.value = '';
                }
            });
        }
    }

    checkFormCompletion() {
        const requiredFields = ['delivery-date', 'delivery-time', 'address', 'phone'];
        const allFieldsFilled = requiredFields.every(fieldId => {
            const field = document.getElementById(fieldId);
            return field && field.value.trim() !== '';
        });

        const shippingSelected = document.querySelector('input[name="shipping_option"]:checked');
        const paymentSelected = localStorage.getItem('selectedPaymentMethod');

        const submitButton = document.getElementById('submit-order');
        if (submitButton) {
            submitButton.disabled = !(allFieldsFilled && shippingSelected && paymentSelected);
        }
    }

    closeAllModals() {
        const shippingModal = document.getElementById('shippingModal');
        const paymentModal = document.getElementById('paymentModal');
        
        if (shippingModal?.classList.contains('show')) this.closeShippingModal();
        if (paymentModal?.classList.contains('show')) this.closePaymentModal();
    }

    cancelOrder() {
        // Implementation for order cancellation
        localStorage.removeItem('currentOrder');
        localStorage.removeItem('selectedPaymentMethod');
        alert('Pesanan dibatalkan karena melebihi batas waktu pembayaran');
        window.location.href = '/keranjang';
    }
}

// Initialize checkout when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.checkout = new CheckoutManager();
});