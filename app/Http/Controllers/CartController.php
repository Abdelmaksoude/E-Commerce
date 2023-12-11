<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Order;
use App\Models\FavouriteProduct;
use Illuminate\Support\Facades\Cache;
use Auth;

class CartController extends Controller
{
    public function cartList()
    {
        $site_details = Cache::remember('site_settings', 60, function () {
            return SiteSetting::first();
        });
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        if(Auth()->check())
        {
            $theFavourite = FavouriteProduct::where('user_id',Auth::user()->id)->count();
        }
        else
        {
            $theFavourite = 0;
        }
        return view('user.cart', compact('cartItems','site_details','theFavourite'));
    }

    public function addToCart(Request $request)
    {
        // return $request->id;
        \Cart::add([
            'id' => $request->id,
            'name' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);

        // return redirect()->back()->with('error','Product Add To Cart Successfully');
        return response()->json(['message' => 'Product added to cart successfully']);

    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        $updatedTotalPrice = \Cart::getTotal(); // Get the updated total price

        return response()->json([
            'message' => 'Product updated in the cart successfully',
            'updatedTotalPrice' => $updatedTotalPrice,
        ]);
        // session()->flash('success', 'Item Cart is Updated Successfully !');

        // return redirect()->route('cart.list');
        // return response()->json(['message' => 'Product updated in the cart successfully']);
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        $updatedTotalPrice = \Cart::getTotal();

        return response()->json([
            'message' => 'Product deleted from the cart successfully',
            'updatedTotalPrice' => $updatedTotalPrice,
        ]);
    }

    public function clearAllCart()
    {
        \Cart::clear();

        // session()->flash('success', 'All Item Cart Clear Successfully !');

        // return redirect()->route('cart.list');
        return response()->json([
            'message' => 'All producted deleted from the cart successfully',
        ]);
    }

    public function makeOrder(Request $request)
    {
        $user_id = Auth::user()->id;
        $cartItems = \Cart::getContent();

        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => $user_id,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'adress1' => $request->adress1,
                'adress2' => $request->adress2,
                'country' => $request->country,
                'city' => $request->city,
                'productname' => $item->name,
                'productid' => $item->id,
                'productquantity' => $item->quantity,
                'productprice' => $item->price,
                'shipping' => $request->shipping,
                'totalprice' => $request->totalprice,
            ]);
        }

        \Cart::clear();
        return redirect()->route('home')->with('error','Order Maked Successful Wait until Your Order Accepted And Comunicate With You');
    }

}






// $user = Auth::user();

//         // Create an order in the database
//     $order = Order::create([
//         'user_id' => $user ? $user->id : null,
//         'total_price' => \Cart::getTotal(),
//     ]);

//     // Retrieve cart items
//     $cartItems = \Cart::getContent();

//     // Attach each cart item to the order
//     foreach ($cartItems as $item) {
//         $order->products()->attach($item->id, [
//             'quantity' => $item->quantity,
//             'price' => $item->price,
//         ]);
//     }

//     // Clear the cart after creating the order
//     \Cart::clear();

//     // You can add additional logic or redirect as needed
//     return redirect()->route('cart.list', ['order_id' => $order->id]);
