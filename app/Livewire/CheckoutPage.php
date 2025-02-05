<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('checkout-E-Canteen')]
class CheckoutPage extends Component
{
    public $nama_lengkap;
    public $telpon;
    public $catatan;
    public $metode_pembayaran;
    public $cart_items;

    public function mount(){
        $this->cart_items = CartManagement::getCartItemFromCookie();

        // dd($this->cart_items);
         
    }

    public function placeOrder(){

        $existingOrder = [];
        $listNomorPesan=[];
        
        
        foreach($this->cart_items as $item){
            $product = product::find($item['product_id']);
            $tokoId = $product['shop_id'];

            
            
        if(!isset($existingOrder[$tokoId])){
            $order=Order::create([
                'user_id' => auth()->id(),
                'nomor_pesanan' => 'ORD-'.random_int(10000,999999),
                'grand_total' => 0,
                'payment_methode' => $this->metode_pembayaran,
                'payment_status' => 'pending',
                'status' => 'new',
                'currency' => 'IDR',
                'nama_customer' => $this->nama_lengkap,
                'telpon' => $this->telpon,
                'notes' => $this->catatan,
            ]);

            $existingOrder[$tokoId] = $order;
        }else{
            $order = $existingOrder[$tokoId];
        }


        Order_item::create([
            'order_id' => $order->id,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'unit_amount' => $item['unit_amount'],
            'total_amount' => $item['total_amount'],
        ]);
                
        array_push($listNomorPesan,$order->nomor_pesanan); 
        $order->grand_total += $item['total_amount'];
        // dd($order);
        $order->save();
    }
    
    // dd("end");


    $route = '/succes?';
        foreach($listNomorPesan as $index=> $nomorPesanan){
            if($index > 0){
                $route .= '&order'.$index.'='.$nomorPesanan;
            }else{

                $route .= 'order'.$index.'='.$nomorPesanan;
            }
        }

        CartManagement::clearCartItemFromCookie();
        return redirect($route);
    }
 

    public function render()
    {
       
        $grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        return view('livewire.checkout-page',[
            'cart_items' => $this->cart_items,
            'grand_total' => $grand_total,
        ]);
    }
}
