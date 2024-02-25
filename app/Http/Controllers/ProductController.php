<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sku' => ['required', 'string', 'max:30', 'unique:products'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'category_id' => ['required'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'quantity' => ['required', 'integer'],
            'cost' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ]);

        $product = new Product();

        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->quantity = $request->quantity;
        $product->cost = $request->cost;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id)->with('category')->first();
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'sku' => ['required', 'string', 'max:30', 'unique:products,sku,' . $id],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'category_id' => ['required'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'quantity' => ['required', 'integer'],
            'cost' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ]);

        $product = Product::find($id);

        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->quantity = $request->quantity;
        $product->cost = $request->cost;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente');
    }
}
