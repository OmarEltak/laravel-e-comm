<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        body { background: #ddd; min-height: 100vh; display: flex; font-family: sans-serif; }
        .card { margin: auto; max-width: 950px; width: 90%; box-shadow: 0 6px 20px rgba(0,0,0,0.19); border-radius: 1rem; border: transparent; }
        .cart, .summary { padding: 4vh; }
        .cart { background: #fff; border-bottom-left-radius: 1rem; border-top-left-radius: 1rem; }
        .summary { background: #ddd; border-top-right-radius: 1rem; border-bottom-right-radius: 1rem; color: rgb(65, 65, 65); }
        img { width: 200px; height: auto; }
        .quantity-controls { display: flex; align-items: center; }
        .quantity-controls button { width: 40px; height: 40px; line-height: 40px; text-align: center; border: 1px solid #ddd; background: #f8f9fa; cursor: pointer; font-size: 1.5rem; border-radius: 5px; }
        .quantity-controls input { text-align: center; border: 1px solid #ddd; width: 60px; margin: 0 5px; font-size: 1.2rem; border-radius: 5px; }
        .close { cursor: pointer; color: red; }
        .btn { background-color: #000; border-color: #000; color: white; width: 100%; font-size: 0.7rem; margin-top: 4vh; padding: 1vh; border-radius: 0; }
        .btn:focus { box-shadow: none; outline: none; color: white; }
        .back-to-shop { margin-top: 4.5rem; }
        .summary select, .summary input { border: 1px solid #ddd; border-radius: 5px; padding: 10px; width: 100%; margin-top: 0.5rem; }
        .summary p { margin-top: 1rem; }
        .summary form { margin-top: 2rem; }
    </style>
</head>
<body>
<div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col"><h4><b>Shopping Cart</b></h4></div>
                    <div class="col align-self-center text-right text-muted">{{ $cartItems->count() }} {{ $cartItems->count() === 1 ? 'item' : 'items' }}</div>
                </div>
            </div>
            @foreach($cartItems as $item)
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="{{ asset('images/admin_images/product_images/small/' . ($item['main_image'] ?? 'default-image.jpg')) }}" alt="Product Image"></div>
                    <div class="col">
                        <div class="row text-muted">{{ $item['category_name'] ?? 'Unknown Category' }}</div>
                        <div class="row">{{ $item['name'] ?? 'Unknown Product' }}</div>
                    </div>
                    <div class="col">
                        <div class="quantity-controls">
                            <form action="{{ route('cart.update') }}" method="POST" style="display: flex; align-items: center;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] ?? '' }}">
                                <button type="submit" name="action" value="decrement">-</button>
                                <input type="text"  value="{{ $item['quantity'] ?? 1 }}" readonly>
                                <button type="submit" name="action" value="increment">+</button>
                                </form>
                        </div>
                    </div>
                    <div class="col">€ {{ $item['price'] ?? '0.00' }} <span class="close"><form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">@csrf <input type="hidden" name="product_id" value="{{ $item['product_id'] ?? '' }}"><button type="submit" class="btn btn-link p-0">✕</button></form></span></div>
                </div>
            </div>
            @endforeach
            <div class="back-to-shop"><a href="{{ route('frontend.shop') }}">←</a><span class="text-muted">Back to shop</span></div>
        </div>
        <div class="col-md-4 summary">
            <div><h5><b>Summary</b></h5></div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;">ITEMS {{ $cartItems->count() }}</div>
                <div class="col text-right">€ {{ $totalPrice }}</div>
            </div>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <p>SHIPPING</p>
                <select name="shipping">
                    <option class="text-muted">Standard-Delivery- €5.00</option>
                </select>
                <p>GIVE CODE</p>
                <input id="code" name="promo_code" placeholder="Enter your code">
                <button class="btn" type="submit">CHECKOUT</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
