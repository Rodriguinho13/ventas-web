<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        //dd($products->toArray());
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
        // //guarda el producto desde un formulario o vista del cliente
        // $product = new Product();
        // $product->name = $request->name;
        // $product->sale_price = $request->sale_price;
        // $product->quantity = $request->quantity;
        // $product->status = $request->status;
        // $product->category_id = $request->category_id;//Al momento de crear el producto, recuperamos por el id la categoria correspondiente, para poder almacenar donde corresponda.
        // $product->save();//guardamos la información

        /////AGREGAMOS DATOS DE MANERA MASIVA
        // $product = new Product($request->all());

        // $product->save();//guardamos la información
        // // dd('OK');
        //return Redirect::route('products.index');

        //$product = new Product($request->all());

        //$product->save();//guardamos la información

        //verificamos si existe el producto
        $product = new Product($request->all());
        $product->save();

        if($request->hasFile('image')){
            // Guardar la imagen en storage/app/public/images
            $image_path = 'public/images';
            $image = $request->file('image');
            $name_image = time() . "-" . $image->getClientOriginalName();

            // Almacenar la imagen
            $path = $request->file('image')->storeAs($image_path, $name_image);

            // Crear la relación con la imagen (asumiendo que tienes una relación polimórfica)
            $product->image()->create([
                'url' => Storage::url($path) // Esto genera la URL pública (/storage/images/nombre_imagen)
            ]);

        // Alternativa si no usas relación polimórfica
        // $product->image = Storage::url($path);
        // $product->save();
    }
        return Redirect::route('products.index');
        //dd('OK');
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

        //dd($product->category);
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

        $product->name = $request->name;
        $product->sale_price = $request->sale_price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->category_id = $request->category_id;//Al momento de crear el producto, recuperamos por el id la categoria correspondiente, para poder almacenar donde corresponda.
        $product->save();//guardamos la información

        /////ACTUALIZAMOS LA IMAGEN/////
        if($request->hasFile('image')){
            $image_path = 'public/images';
            $image = $request->file('image');
            $name_image = time() . "-" . $image->getClientOriginalName();
            $request->file('image')->storeAs($image_path, $name_image);

            $product->image()->update(['url' => $name_image]);
        }
        //dd('ok');

        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();

        //dd($product);
        return Redirect::route('products.index');
    }
}
