<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpsertProductRequest;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;

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
            if(Storage::exists($product->image_path)){
                Storage::delete($product->image_path);
            }
        }
        $product->save();
        return redirect(route('products.index'))->with('status', __('shop.product.store.success'));
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
        $oldImagePath = $product->image_path;
        $product->fill($request->validated());
        if($request->hasFile('image')){
            if(Storage::exists($oldImagePath)){
                Storage::delete($oldImagePath);
            }
            $request->file('image')->store('public/products');
            $product->image_path = $request->file('image')->store('products');
        }

        $product->save();
        return redirect(route('products.index'))->with('status', __('shop.product.update.success'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        try {
            $product->delete();
            Session()->flash('status', __('shop.product.delete.success'));
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

    public function downloadImage(Product $product)
    {
            if(Storage::exists($product->image_path)){
                return Storage::download($product->image_path);
            }
        return Redirect::back();

    }
}
