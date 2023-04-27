<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'items' => 'required|array',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:1',
            'items.*.product_id' => 'required|integer|min:1',
        ]);

        $items = $request->input('items');

        $tongtien = 0;
        foreach( $items as $item ) {
            $tongtien =  $tongtien + ($item['quantity'] * $item['price']);
        }

        $order = new Order();
        $order->Tong_Tien = $tongtien;
        $order->save();

        foreach( $items as $item ) {
            $itemModel = new OrderItem();
            $itemModel->Product_ID = $item['product_id'];
            $itemModel->Quantity = $item['quantity'];
            $itemModel->Don_Gia = $item['price'];
            $itemModel->Order_ID = $order->id;
            $itemModel->save();
        }

        $request->session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'OK'
        ]);
    
    }
}
