@section('title', 'Your Cart')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Your Cart</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if($cartItems->isEmpty())
        <div class="alert alert-info">
            Your cart is empty. <a href="{{ route('home') }}">Continue shopping</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>
                            <div class="counter">
                                <button type="button" class="minus btn btn-sm btn-secondary" 
                                    data-item-id="{{ $item->id }}" data-action="decrease">-</button>
                                <span class="count mx-2">{{ $item->quantity }}</span>
                                <button type="button" class="plus btn btn-sm btn-secondary" 
                                    data-item-id="{{ $item->id }}" data-action="increase">+</button>
                            </div>
                        </td>
                        <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td colspan="2"><strong>Rp {{ number_format($cart->total, 0, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('home') }}" class="btn btn-secondary">Continue Shopping</a>
            <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const updateButtons = document.querySelectorAll('.minus, .plus');
    
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            const action = this.dataset.action;
            const countSpan = this.parentElement.querySelector('.count');
            let count = parseInt(countSpan.textContent);
            
            if (action === 'decrease' && count > 1) {
                count--;
            } else if (action === 'increase') {
                count++;
            } else if (action === 'decrease' && count === 1) {
                // Handle removing the item
                if (confirm('Remove this item from cart?')) {
                    document.querySelector(`form[action$="cart/remove/${itemId}"]`).submit();
                }
                return;
            }
            
            countSpan.textContent = count;
            
            // Update the cart via AJAX
            fetch('{{ route('cart.update') }}', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    item_id: itemId,
                    quantity: count
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update subtotal and total
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>
@endsection