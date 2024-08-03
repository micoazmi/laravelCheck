<?php
function rupiah($angka) {
    $hasil = 'Rp ' . number_format($angka, 2, ",", ".");
    return $hasil;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h2 {
            margin: 0;
            font-size: 1.5em;
        }
        p {
            margin: 5px 0;
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-control button {
            width: 30px;
            height: 30px;
            border: none;
            background-color: #007bff;
            color: white;
            font-size: 1em;
            cursor: pointer;
        }
        .quantity-control input {
            width: 50px;
            text-align: center;
            margin: 0 5px;
        }
        form {
            display: flex;
            align-items: center;
        }
        button[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>
    <script>
        function incrementQuantity(button) {
            const input = button.previousElementSibling;
            input.value = parseInt(input.value) + 1;
        }

        function decrementQuantity(button) {
            const input = button.nextElementSibling;
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>
</head>
<body>
    @include('navbar')
    <h1>Products</h1>
    <ul>
        @foreach($products as $product)
        <li>
            <div>
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p><?php echo rupiah($product->price); ?></p>
            </div>
            <form action="/add-to-cart/{{ $product->id }}" method="POST">
                @csrf
                <div class="quantity-control">
                    <button type="button" onclick="decrementQuantity(this)">-</button>
                    <input type="number" name="quantity" value="1" min="1" readonly>
                    <button type="button" onclick="incrementQuantity(this)">+</button>
                </div>
                <button type="submit" style="margin: 10px">Add to Cart</button>
            </form>
        </li>
        @endforeach
    </ul>
    <a href="/cart">View Cart</a>
</body>
</html>
