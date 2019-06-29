<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\User;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $products = new Product;
        $products = Product::with('categories', 'brands')->get();
        //$category = Category::where('user_id', auth()->user()->id)->get();
        return view('admin.panel.product.list.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::where('user_id', auth()->user()->id)->get();
        $brands     = Brand::all();

        return view('admin.panel.product.index', compact('categories', 'brands', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        $product          = new Product;
        $product->user_id = auth()->user()->id;
        
        $brand_id = [];

        if ($request->filled('brand_name')) { 
            $brand = new Brand;
            $brand->name = $request->brand_name;
            $brand->save();
            $brand_id = $brand->id;
        }

        if ($request->filled('category_name')) {   
            $category          = new Category;
            $category->user_id = auth()->user()->id;
            $category->name    = $request->category_name;
            $category->save();
        }


        $product->brand_id    = (!empty($brand_id)) ? $brand_id : $request->brand_id;   
        $product->name        = $request->name;
        $product->stock       = $request->quantity;
        $product->price_cost  = $request->price_cost;
        $product->price_sale  = $request->price_sale;
        $product->description = $request->description;
        $product->save();

        $product->categories()->attach(
            ($request->filled('category_name')) ? $category->id : $request->category_id, 
            ['product_id' => $product->id]
        );    
       
        return redirect('/admin/produtos-listar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //s
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all(); 
        $brands     = Brand::all();
        $products   = Product::all();   
        $product = $product->where('id', $product->id)->with('categories', 'brands')->first(); 
        // dd($product);
        return view('admin.panel.product.edit.index', compact('product', 'categories', 'brands', 'products'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();  
        return redirect('/admin/produtos-listar');  
    }
}
