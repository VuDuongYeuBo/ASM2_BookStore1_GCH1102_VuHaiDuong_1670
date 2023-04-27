<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public $rootview;

    public function __construct()
    {
        $this->rootview='FrontEnd.product.';
    }
    
    public function index()
    {
        $products = Product::all();
        return view($this->rootview.'products', compact('products'));
    }

    public function cart()
    {   
        return view($this->rootview.'cart');
    }
    public function addToCart($id)
    {
        $product = Product::find($id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                    $id => [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "image" => $product->image
                    ]
            ];

            session()->put('cart', $cart);

            $cart_html = view('FrontEnd.product.cart-item', ['cart' => $cart])->render();

            return response()->json([
                'success' => true,
                'message' =>  'Product added to cart successfully!',
                'cart' => $cart_html
            ]);

            // return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            $cart_html = view('FrontEnd.product.cart-item', ['cart' => $cart])->render();

            return response()->json([
                'success' => true,
                'message' =>  'Product added to cart successfully!',
                'cart' => $cart_html
            ]);

            // return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];

        session()->put('cart', $cart);

        $cart_html = view('FrontEnd.product.cart-item', ['cart' => $cart])->render();

        return response()->json([
            'success' => true,
            'message' =>  'Product added to cart successfully!',
            'cart' => $cart_html
        ]);

        // return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
            
        }
        return response()->json([
            'success' => true,
            'message' => 'Product update successfully',
            'cart_body' => view($this->rootview.'cart')->fragment('cart-body'),
            'cart_footer' => view($this->rootview.'cart')->fragment('cart-footer')
        ]);
    }


    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }

        return response()->json([
            'success' => true,
            'message' => 'Product removed successfully',
            'cart_body' => view($this->rootview.'cart')->fragment('cart-body'),
            'cart_footer' => view($this->rootview.'cart')->fragment('cart-footer')
        ]);
    }

    public function clear(Request $request)
    {
        session()->forget('cart');
        session()->flash('success', 'Cart is clear');
    }
}
