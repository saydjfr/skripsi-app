<?php

namespace App\Livewire;

use App\Http\Controllers\MidtransController;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Livewire\Component;

class MyOrderPage extends Component
{

    public function midtrans_payment($nomor_pesanan)
    {
        $newOrderId = 'ORD-' . random_int(10000, 999999);

        $order = Order::with('items.product')->where("nomor_pesanan", $nomor_pesanan)->first();
        $order->nomor_pesanan = $newOrderId;
        $order->save();

        $midtrans = new MidtransController();

        $itemDetails = [];

        foreach ($order->items as $item) {
            $product = [
                "id" => $item->product->id,
                "price" => $item->product->price,
                "quantity" => $item->quantity,
                "name" => $item->product->name,
            ];

            array_push($itemDetails, $product);
        }

        $params = [
            "transaction_details" => [
                'order_id' => $newOrderId,
                "gross_amount" => $order->grand_total
            ],
            "item_details" => $itemDetails
        ];

        $urlPayment = $midtrans->payment($params);

        return redirect()->away($urlPayment);
    }

    public function render()
    {
        $myorders = Order::with('items')->where('user_id', auth()->id())->latest()->get();

        return view('livewire.my-order-page', [
            'myorders' => $myorders,
        ]);
    }
}
