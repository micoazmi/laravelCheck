<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $cartItems = Cart::with('product')->get();
        $transactionDetails = [];
        $total = 0;

        foreach ($cartItems as $item) {
            $transactionDetails[] = [
                'id' => $item->product->id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            ];
            $total += $item->product->price * $item->quantity;
        }

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $total,
            ],
            'item_details' => $transactionDetails,
            'customer_details' => [
                'first_name' => 'Customer',
                'email' => 'customer@example.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('checkout', compact('snapToken'));
    }

    public function finish(Request $request)
    {
        // Handle post-payment logic here
        return view('payment_finish');
    }
}
