<?php
function rupiah($angka) {
    $hasil = 'Rp ' . number_format($angka, 2, ",", ".");
    return $hasil;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            width: 100%;
            max-width: 600px;
        }
        li {
            background-color: white;
            margin: 10px 0;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
        }
        p {
            margin: 5px 0;
        }
        .total {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 20px;
        }
        form {
            margin-top: 20px;
        }
        button[type="submit"], button[type="button"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover, button[type="button"]:hover {
            background-color: #218838;
        }
        .remove-button {
            background-color: #dc3545;
        }
        .remove-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    @include('navbar')
    <h1>Cart</h1>
    <ul>
        @php
            $total = 0;
        @endphp
        @foreach($cartItems as $item)
        <li>
            <div>
                <h2>{{ $item->product->name }}</h2>
                <p>{{ $item->product->description }}</p>
                <p>Quantity: {{ $item->quantity }}</p>
                <p>Price:<?php echo rupiah($item->product->price) ?> </p>
                <p>Subtotal:<?php echo rupiah($item->product->price * $item->quantity)?></p>
                @php
                    $total += $item->product->price * $item->quantity;
                @endphp
            </div>
            <form action="/cart/remove/{{ $item->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="remove-button" onclick="this.closest('form').submit()">Remove</button>
            </form>
        </li>
        @endforeach
    </ul>
    <div class="total">Total:<?php echo rupiah($total)?> </div>
    <form action="/checkout" method="POST">
        @csrf
        <button type="submit">Checkout</button>
    </form>
</body>
</html>
