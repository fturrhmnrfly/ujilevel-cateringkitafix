<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Pesanan - Catering Kita</title>
    <style>
        .review-form {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .rating {
            display: flex;
            gap: 5px;
            margin: 10px 0;
        }

        .star {
            font-size: 24px;
            color: #ffd700;
            cursor: pointer;
        }

        .review-textarea {
            width: 100%;
            min-height: 100px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px 0;
        }

        .submit-review {
            background: #2c2c77;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <x-navbar />

    <div class="container">
        <div class="review-form">
            <h2>Berikan Penilaian</h2>
            
            @foreach($orders as $order)
                <div class="order-review">
                    <h3>Order #{{ $order->order_number }}</h3>
                    
                    <form action="{{ route('pesanan.submit-review', $order->id) }}" method="POST">
                        @csrf
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="star" data-rating="{{ $i }}">★</span>
                            @endfor
                            <input type="hidden" name="rating" id="rating">
                        </div>

                        <textarea name="review" class="review-textarea" placeholder="Bagaimana pengalaman anda?" required></textarea>

                        <button type="submit" class="submit-review">Kirim Penilaian</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.querySelector('#rating');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.dataset.rating;
                ratingInput.value = rating;
                
                stars.forEach(s => {
                    s.style.color = s.dataset.rating <= rating ? '#ffd700' : '#ddd';
                });
            });
        });
    </script>
</body>
</html>