<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Products/Index');
        //dd($products->toArray()); para pruebas en POSTMAN
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Products/Create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $product = new Product($request->all());
        $product->save();

        if($request->hasFile('image')){
            $image_path = 'public/images';
            $image = $request->file('image');
            $name_image = time() . "-" . $image->getClientOriginalName();
            $request->file('image')->storeAs($image_path, $name_image);

            $product->image()->create(['url' => $name_image]);
        }
        //dd('OK'); para pruebas en POSTMAN
        return Redirect::route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return Inertia::render('Products/Show', ['product' => $product]);
        //dd($product->category); para pruebas en POSTMAN
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return Inertia::render('Products/Edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->sale_price = $request->sale_price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->save();

        if($request->hasFile('image')){
            $image_path = 'public/images';
            $image = $request->file('image');
            $name_image = time() . "-" . $image->getClientOriginalName();
            $request->file('image')->storeAs($image_path, $name_image);

            $product->image()->update(['url' => $name_image]);
        }
        //dd('OK'); para pruebas en POSTMAN
        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        //dd($product); para pruebas en POSTMAN

        return Redirect::route('products.index');
    }
}
