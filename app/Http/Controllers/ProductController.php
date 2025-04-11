<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function index()
    {
        $productList = Product::get();
        // dd($productList);
        return view('products.list', compact('productList'));
    }
    public function ProductDetail($slug , Request $request)
    {
        $productDetail = Product::where('slug', $slug)->firstOrFail();
        $lang = $request->query('lang', 'en'); // default to English if no param
        $description = $lang === 'es' ? $productDetail->description_es : $productDetail->description_en;
        return view('products.productdetail', compact('productDetail','description'));
    }
    public function create()
{
    return view('products.create');
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:products,name,',
        'image' => 'required|image|mimes:jpg,jpeg,png',
        'base_price' => 'required|numeric',
        'stock_quantity' => 'required|integer|min:1',
        'description_en' => 'required',
        'description_es' => 'required',
        'override_price' => 'nullable|numeric',
    ]);
    

    $slug = Str::slug($request->name);
    $slugCount = Product::where('slug', $slug)->count();
    if ($slugCount) {
        $slug .= '-' . ($slugCount + 1);
    }

    $imagePath = $request->file('image')->store('products', 'public');
    Product::create([
        'name' => $request->name,
        'slug' => $slug,
        'base_price' => $request->base_price,
        'override_price' => $request->override_price,
        'override_start_date' => $request->override_start_date,
        'override_end_date' => $request->override_end_date,
        'stock_quantity' => $request->stock_quantity,
        'description_en' => $request->description_en,
        'description_es' => $request->description_es,
        'image' => $imagePath,
        'tags' => $request->tags,
    ]);

    return redirect()->back()->with('success', 'Product created successfully!');
}

public function checkQuantity(Request $request)
{
    $product = Product::find($request->product_id);
    if (!$product) {
        return response()->json(['available' => false]);
    }
    if ($request->requested_quantity <= $product->stock_quantity) {
        return response()->json(['available' => true]);
    } else {
        return response()->json(['available' => false]);
    }
}
}