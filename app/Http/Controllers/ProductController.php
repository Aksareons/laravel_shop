<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\ProductFormRequest;
use App\Services\ProductService;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::with(['categories'])->simplePaginate();
        $trashedProducts = Product::onlyTrashed()->get();
        foreach ($trashedProducts as $trashedProduct) {
       
        }
        return view('admin.products.index', compact('products', 'trashedProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        

        $categories = Category::all();
        $categories = $categories->pluck('name', 'id');
        $productCategories = [];

        return view('admin.products.create', compact('categories', 'productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {

        $this->productService->storeProduct($request);
        return redirect()->route('admin.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $categories = $categories->pluck('name', 'id');
        $productCategories = $product->categories()->pluck('id');

        return view('admin.products.edit', compact('product', 'categories', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductFormRequest  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, Product $product)
    { 
        $this->authorize('update', $product);
        $this->productService->updateProduct($request, $product);


        return redirect()->route('admin.products.index');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        $this->authorize('delete', $product);
        $this->productService->deleteProduct($product);
        return redirect()->route('admin.products.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {

       
        $product = Product::onlyTrashed()->whereId($id)->first();
        $this->authorize('restore', $product);
        $this->productService->restoreProduct($product);

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {        

        $product = Product::onlyTrashed()->whereId($id)->first();

        $this->authorize('forceDelete', $product);
        $this->productService->destroyProduct($product);
        return redirect()->route('admin.products.index');
    }
}
