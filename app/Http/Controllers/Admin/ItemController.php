<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ItemProduct;
use Illuminate\Http\Request;
use App\Models\Attribute;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $id = auth()->user()->id;
        $itens = Item::with('attributes', 'categories', 'users', 'products')->paginate(3);
        //$attr  = Attribute::find($itens);
        //dd($itens);
        return view('admin.panel.item.list.index', compact('itens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        
        $id = auth()->user()->id; 
        $users      = User::where('user_id', $id)->orWhere('id', $id)->get();
        $categories = Category::where('user_id', $id)->get();  
        $products = Product::where('user_id', $id)->with('categories', 'brands')->get();  
        $itens = Item::TYPE;

        return view('admin.panel.item.index', compact('users', 'categories', 'products', 'id', 'itens'));
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
        $request->validate([  
            //'category_id'    => 'required|integer',
            'user_id'        => 'required|integer',
            'type'           => 'required|string',
            //'product_id'     => 'required|integer',
           // 'amount'         => 'required|numeric|between:0,99.99',
            'payment_date'   => 'required|date',
            'payment_method' => 'required|integer',
            'payment_status' => 'required|integer',
        ]);

        $product   = new Product;
        $item      = new Item;
        $attribute = new Attribute;
        
        // if (!$request->filled('product_id')) { 
            
        //     $product->category_id = $request->category_id; 
        //     $product->name        = $request->name; 
        //     $product->save();                                       
        // } 
        
        $item->user_id        = $request->user_id;
        //$item->category_id    = $request->category_id;
        $item->type           = $request->type;
        $item->payment_date   = $request->payment_date;
        $item->payment_method = $request->payment_method; 
        $item->payment_status = $request->payment_status;
        $item->description    = $request->description;
        $item->credit         = $request->credit;
        $item->discount       = $request->discount;
        $item->amount_total   = $request->amount_total;
        $item->save();
       

        for ($i=0; $i < count($request->amount); $i++) { 
            if ($request->filled('product_id') && !empty($request->product_id[$i])) {
                
                $item->products()->attach($request->product_id, 
                    [
                        'quantity' => $request->quantity[$i],
                        'amount'   => $request->amount[$i], 
                    ]
                );

            } else {
                
                $attribute->name     = $request->product_name[$i];
                $attribute->quantity = $request->quantity[$i];
                $attribute->amount   = (float) $request->amount[$i];
                $attribute->save();
                
                $item->attributes()->attach($attribute->id);       
            }       
        }   
        
        return redirect('/admin/item-cadastrar')->with('success', 'Item cadastrado com sucesso!');  
    }

 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {   
          
        $item = Item::where('id', $item->id)->with('categories', 'users', 'products')->first();
        
        return view('admin.panel.item.show.index', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        
        $categories   = Category::all();  
        $itens = $item->where('id', $item->id)->with('categories', 'users', 'products')->get(); 
        
        return view('admin.panel.item.edit.index', compact('itens', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $attributes = ['product_id' => $request->product_id, 'quantity' => $request->quantity, 'amount' => $request->amount];
        
        $item->products()->updateExistingPivot($request->product_id, $attributes);
    
        $item->update($request->except(['_token']));
        
        return redirect('/admin/itens-listar')->with('success', 'Item atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();  
        return redirect('/admin/itens-listar');  
    }
}
