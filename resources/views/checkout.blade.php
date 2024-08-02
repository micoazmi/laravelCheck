<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        h1 {
            margin-bottom: 20px;
        }
        #pay-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        #pay-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Checkout</h1>
    <button id="pay-button">Pay Now</button>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{  env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    window.location.href = '/payment/finish';
                },
                onPending: function (result) {
                    window.location.href = '/payment/finish';
                },
                onError: function (result) {
                    window.location.href = '/payment/finish';
                }
            });
        };
    </script>
</body>
</html>
