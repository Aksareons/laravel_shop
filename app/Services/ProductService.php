<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Gallery;

use App\Http\Requests\ProductFormRequest;
use \Exception;

class ProductService
{
    /**
     * @param ProductFormRequest $request
     */
    public function storeProduct(ProductFormRequest $request): void
    {
        $path = [];
        if ($request->fileUpload) {
        foreach ($request->fileUpload as $item) {
            array_push($path, $item->getClientOriginalName());
            $item->move(public_path('images'), $item->getClientOriginalName());
            }
            $path = json_encode($path);
        }
            $product = Product::create($request->all());
            $gallery = new Gallery();
        
            $gallery->product_id = $product->id;
            $gallery->photos = $path;
           
            $gallery->save();
            
             
        foreach ($request->categories as $categoryId) {
            $product->categories()->attach($categoryId);
        }
    }

    /**
     * @param ProductFormRequest $request
     * @param Product $product
     */
    public function updateProduct(ProductFormRequest $request, Product $product): void
    {
        $product->update($request->all());
        foreach ($request->categories as $categoryId) {
            $product->categories()->sync($categoryId);
        }
    }

    /**
     * @param Product $product
     * @throws Exception
     */
    public function deleteProduct(Product $product): void
    {
        $gallery = Gallery::where('product_id', $product->id);
        $product->delete();
    }

    /**
     * @param Product $product
     */
    public function restoreProduct(Product $product): void
    {
       
        $product->restore();    
    }

    /**
     * @param Product $product
     */
    public function destroyProduct(Product $product): void
{

     $gallery = Gallery::where('product_id', $product->id);
        $gallery->forceDelete();
        $product->forceDelete();
    }
}