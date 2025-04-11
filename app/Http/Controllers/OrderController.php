<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(Request $request)
{
    // dd("Hii",$request->all());
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'contact_number' => 'required|string',
        'address' => 'required|string',
        'quantity' => 'required|integer|min:1'
    ]);

    $product = Product::findOrFail($request->product_id);
    
    if ($product->stock_quantity < $request->quantity) {
        return redirect()->back()->with('error', 'Not enough stock available.');
    }

    Order::create([
        'product_id' => $product->id,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'contact_number' => $request->contact_number,
        'address' => $request->address,
        'quantity' => $request->quantity
    ]);

    // Update product stock
    $product->stock_quantity -= $request->quantity;
    $product->save();

    return redirect()->back()->with('success', 'Order placed successfully!');
}
}
