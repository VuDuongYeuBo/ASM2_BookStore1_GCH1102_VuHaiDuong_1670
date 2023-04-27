<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Classes\Helper;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('CheckAdminLogin');
        $this->viewprefix='admin.product.';
        $this->index='product.index';
    }
    public function index()
    {
        $products = Product::all();
        return view($this->viewprefix.'index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view($this->viewprefix.'create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'content' => 'required',
            'idcat' => 'required',
        ]);
        $data['image'] = Helper::imageUpload($request);
        if(Product::create( $data))
            Session::flash('message', 'successfully!');
        else
            Session::flash('message', 'Failure!');
        return redirect()->route($this->index);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $products = Product::all();
        $category = Category::all();
        return view($this->viewprefix.'edit',compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {        
        $data=$request->validate([
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'content' => 'required',
            'idcat' => 'required',
        ]);
       $data['images'] = Helper::imageUpload($request);

        if($product->update($data)) {
            return response()->json([
                'success' => true,
                'message' => 'successfully!'
            ]);
        }
           
        return response()->json([
            'success' => false,
            'message' => 'failed!'
        ]);

            

        // return redirect()->route($this->index);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->delete())
            Session::flash('message', 'successfully!');
        else       
            Session::flash('message', 'Failure!');

            $products = Product::all();
        return response()->json([
            
            'success' => true,
            'message' => 'Product update successfully',
            'cart_body' => view($this->viewprefix.'index', 
            ['products' => $products])->fragment('cart-body')
        ]); 

    }
}
