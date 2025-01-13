<?php

namespace App\Helpers;

use App\Models\product;
use Illuminate\Support\Facades\Cookie;

class CartManagement {
//add item to cart
static public function addItemToCart($product_id){
    $cart_item = self::getCartItemFromCookie();

    $existing_item = null;

    foreach($cart_item as $key => $item){
        if($item['product_id']== $product_id){
            $existing_item = $key;

            break;
        }
    }

    if($existing_item !== null){
        $cart_item[$existing_item]['quantity']++;
        $cart_item[$existing_item]['total_amount'] = $cart_item[$existing_item]['quantity']*$cart_item[$existing_item]['unit_amount'];
    }else{
        $product = Product::where('id', $product_id)->first(['id','name','price','image']);

        if($product){
            
            $cart_item[]= [
                'product_id' => $product->id,
                'name' => $product->name,
                'img'=>$product->image[0],
                'quantity' => 1,
                'unit_amount'=> $product->price,
                'total_amount'=> $product->price
            ];
        }
    }
    self::addCartItemToCookie($cart_item);
    return $cart_item;
}

// remove item from cart
static public function removeItemFromCart($product_id){
    $cart_item = self::getCartItemFromCookie();

    foreach($cart_item as $key => $item){
        if($item['product_id']== $product_id){
            unset($cart_item[$key]);
        }
    }
    self::addCartItemToCookie($cart_item);

    return $cart_item;
}

// add cart item to cookie
static public function addCartItemToCookie($cart_item){
    Cookie::queue('cart_item', json_encode($cart_item), 60*24*30);
}

// clear cart item from cookie
static public function clearCartItemFromCookie(){
    Cookie::queue(Cookie::forget('cart_item'));
}

// get all cart item from cookie
static public function getCartItemFromCookie(){
    $cart_item = json_decode(Cookie::get('cart_item'),true);

    if(!$cart_item){
        $cart_item = [];
    }
    return $cart_item;
}

// increement item quantity
static public function incrementQuantityToCartItem($product_id){
    $cart_item = self::getCartItemFromCookie();

    foreach($cart_item as $key => $item){
        if($item['product_id']== $product_id){
            $cart_item[$key]['quantity']++;
            $cart_item[$key]['total_amount'] = $cart_item[$key]['quantity'] * $cart_item[$key]['unit_amount'];
        }
    }
    self::addCartItemToCookie($cart_item);

    return $cart_item;
}

// decreement item quantity
static public function decrementQuantityToCartItem($product_id){
    $cart_item = self::getCartItemFromCookie();

    foreach($cart_item as $key => $item){
        if($item['product_id']== $product_id){
            if($cart_item[$key]['quantity']>1){
                $cart_item[$key]['quantity']--;
                $cart_item[$key]['total_amount'] = $cart_item[$key]['quantity']* $cart_item[$key]['unit_amount'];
            }
        }
    }
}

// calculate grand total
static public function calculateGrandTotal($item){
    return array_sum(array_column($item, 'total_amount'));
}

}