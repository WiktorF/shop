<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpsertProductRequest;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index', [
            'products' => product::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', [
            'categories' => ProductCategory::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertProductRequest $request)
    {

        $product = new Product($request->validated());
        if($request->hasFile('image')){
            $request->file('image')->store('public/products');
            $product->image_path = $request->file('image')->store('products');
        }
        $product->save();
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product,
            'categories' => ProductCategory::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'categories' => ProductCategory::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertProductRequest $request, Product $product)
    {
        $product->fill($request->validated());
        if($request->hasFile('image')){
            $request->file('image')->store('public/products');
            $product->image_path = $request->file('image')->store('products');
        }

        $product->save();
        return redirect(route('products.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        try {
            $product->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd'
            ])->setStatusCode(500);
        }
    }
}
