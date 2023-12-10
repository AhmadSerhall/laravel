<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json(['products' => $products], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $product = Product::create($request->all());
        return response()->json(['product' => $product], 201);
    }

    public function show(Product $product)
    {
        return response()->json(['product' => $product], 200);
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'string',
            'price' => 'numeric',
            'description' => 'nullable|string',
        ]);

        $product->update($request->all());
        return response()->json(['product' => $product], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
