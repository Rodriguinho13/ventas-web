<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB; //para el constructo de consultas en Laravel

Route::get('/', function () {
    $sale = Sale::find(1);
    return view('test', ['sale' => $sale]);
});

Route::get('/test', function(){

    //////////AGREGAMOS UNA NUEVA CATEGORIA UTILIZANDO ELOQUENT ORM////////////

    //$category = new Category();
    //$category->name = "Aguas y gaseosas";
    //$category->save(); //guardamos la categoria
    //return view('test', ['category' => $category]); //retorna los datos de la base de datos en la vista blade

    /////////MUESTRA TODAS LAS CATEGORIAS QUE EXISTEN EN LA BASE DE DATOS//////

    //$categories = Category::all(); //para que muestre todas las categorias
    //return view('test', ['categories' => $categories]); //retorna los datos de la base de datos en la vista blade

    /////////HACEMOS QUE NOS MUESTRE LOS NOMBRES DE LAS CATEGORIAS//////////
    //$categories = Category::select('name')->get(); //selecciona los nombres de las categorias
    //return view('test', ['categories' => $categories]); //retorna los datos de la base de datos en la vista blade

    /////////HACEMOS UNA FILTRACIÓN DE INFORMACIÓN, MOSTRANDO CATEGORIAS CON ID=1///////////////
    //$categories = Category::where('id', '=', '1')->select('name')->get();
    //return view('test', ['categories' => $categories]); //retorna los datos de la base de datos en la vista blade

    /////////HACEMOS UNA FILTRACIÓN DE INFORMACIÓN, MOSTRANDO CATEGORIAS CON nombre=Limpieza///////////////
    //$categories = Category::where('name', '=', 'Limpieza')->select('name')->get();
    //return view('test', ['categories' => $categories]); //retorna los datos de la base de datos en la vista blade

    //////////AGREGAMOS UN NUEVO PRODUCTO UTILIZANDO ELOQUENT ORM////////////

    // $product = new Product();
    // $product->name = "Coca Cola";
    // $product->sale_price = 7; //precio del producto
    // $product->quantity = 50; //cantidad de ese producto
    // $product->status = "Activo"; //estado del producto Activo
    // $product->category_id = 2; //La categoria aguas y gaseosas es la categoria 2
    // $product->save(); //guardando ese producto

    //return view('test', ['product' => $product]); //retorna los datos de la base de datos en la vista blade

    // $product2 = new Product();
    // $product2->name = "Toallas humedas";
    // $product2->sale_price = 3; //precio del producto
    // $product2->quantity = 20; //cantidad de ese producto
    // $product2->status = "Activo"; //estado del producto Activo
    // $product2->category_id = 1; //La categoria Limpieza es la categoria 1
    // $product2->save(); //guardando ese producto

    //return view('test', ['product' => $product]); //retorna los datos de la base de datos en la vista blade

    //////////BUSQUEDA DE UNA CATEGORIA POR EL ID Y MUESTRA TODOS LOS PRODUCTOS UTILIZANDO ELOQUENT ORM////////////
    // $category = Category::find(1); //buscando la categoria y todos los productos de esa categoria
    // return view('test', ['category' => $category]); //retorna los datos de la base de datos en la vista blade

    //////////BUSQUEDA DE UNA CATEGORIA POR EL NOMBRE Y MUESTRA TODOS LOS PRODUCTOS UTILIZANDO ELOQUENT ORM////////////
    // $category = Category::where('name', '=', 'Aguas y gaseosas')->first(); //buscando la categoria y todos los productos de esa categoria
    // return view('test', ['category' => $category]); //retorna los datos de la base de datos en la vista blade

    //////////BUSQUEDA DE UN PRODUCTO Y MUESTRA LA CATEGORIA A LA CUAL PERTENECE UTILIZANDO ELOQUENT ORM////////////
    //$products = Product::all();
    //return view('test', ['products' => $products]); //retorna los datos de la base de datos en la vista blade


    /////////////CONSTRUCTOR DE CONSULTAS A LA BASE DE DATOS////////////////////
    //obtener todos los productos y las categorias a la que pertenece cada producto
    // $products = DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->select('products.name', 'categories.name as category_name')->get();
    // return view('test', ['products' => $products]); //retorna los datos de la base de datos en la vista blade

    // $category = DB::table('categories')->insert(['name' => "Celulares"]);
    // return view('test', ['category' => $category]);


});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
