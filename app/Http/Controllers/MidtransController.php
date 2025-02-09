<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public $serverKey;
    public $clientKey;

    public function __construct()
    {
        $this->serverKey = env('MIDTRANS_SERVERKEY');
        $this->clientKey = env('MIDTRANS_CLIENTKEY');

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $this->serverKey;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    public function payment($params)
    {
        $transaction = \Midtrans\Snap::createTransaction($params);

        return $transaction->redirect_url;
    }

    public function payment_hook(Request $request)
    {
        $nomor_pesanan = $request->order_id;
        $order = Order::where("nomor_pesanan", $nomor_pesanan)->first();

        $status = $request->transaction_status;

        if ($status == "settlement") {
            $order->payment_status = "paid";
            $order->save();

            return redirect()->away("http://localhost:8000/myorders");
        } elseif ($status == "expire") {
            $order->payment_status = "expired";
            $order->status = "failed";
            $order->save();

            return redirect()->away("http://localhost:8000/myorders");
        }

        dd($status);
    }
}
