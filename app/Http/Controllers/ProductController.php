<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Imprimos en pantalla los productos y la categoria al cual pertenece

        $products = Product::All();//debido a la relación que hicimos en la base de datos, tiene una relación con categorias, colocando esto, nos muestra los productos y las categorias a la cual pertenece

        return Inertia::render('Product/Index');//retorna a una vista de inertia para ver los productos
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Retorna a una vista que nos muestre el formulario de crear
        $categories = Category::all();//Debemos recuperar a todas las categorias, ya que el momento de seleccionar un producto, seleccionaremos la categoria a la cual pertence, debido a la relacion que tienen estos.
        return Inertia::render('Products/Create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //guarda el producto desde un formulario o vista del cliente
        $product = new Product();
        $product->name = $request->name;
        $product->sale_price = $request->sale_price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->category_id = $request->category_id;//Al momento de crear el producto, recuperamos por el id la categoria correspondiente, para poder almacenar donde corresponda.
        $product->save();//guardamos la información

        return Redirect::route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Obtenemos los datos de un producto en base al id
        $product = Product::find($id);
        //retorna una vista en inertia
        return Inertia::render('Products/Show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        //Obtenemos los datos de un producto en base al id
        $product = Product::find($id);
        //retorna una vista en inertia, que retorna los productos y las categorias
        return Inertia::render('Products/Edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Buscamos el producto por el id
        $product = Product::find($id);
        $product = new Product();
        $product->name = $request->name;
        $product->sale_price = $request->sale_price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->category_id = $request->category_id;//Al momento de crear el producto, recuperamos por el id la categoria correspondiente, para poder almacenar donde corresponda.
        $product->save();//guardamos la información

        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();

        return Redirect::route('products.index');
    }
}
