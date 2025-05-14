<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

//RUTA PARA PODER HACER PRUEBAS CON ELOQUENT ORM
Route::get('/test', function(){
    //AGREGAMOS UNA NUEVA CATEGORIA USANDO ORM A LA BD
    // $category = new Category();
    // $category->name = "Aguas y gaseosas";
    // $category->save();
    //return view('test', ['category' => $category]);

    //MOSTRAMOS TODAS LAS CATEGORIAS USANDO ORM DE LA BD
    //$categories = Category::all();

    //MOSTRAMOS TODAS LAS CATEGORIAS USANDO ORM DE LA BD
    //$categories = Category::all();

    //MOSTRAMOS UNICAMENTE LOS NOMBRES DE LAS CATEGORIAS
    //$categories = Category::select('name')->get();

    //FILTRAMOS LA INFORMACION USANDO EL WHERE
    //mostrando la categoria con el id = 1
    //$categories = Category::where('id', '=', 1)->select('name')->get();

    //FILTRAMOS LA INFORMACION USANDO EL WHERE
    //mostramos el nombre con el nombre Limpieza
    //$categories = Category::where('name', '=', 'Limpieza')->select('name')->get();

    //Agregamos el producto coca cola a la categoria aguas y gaseosas
    // $product = new Product();
    // $product->name = "Coca cola";
    // $product->sale_price = 7;
    // $product->quantity = 50;
    // $product->status = "Activo";
    // $product->category_id=2; // haciendo referencai a lo que es el id de la categoria.
    // $product->save();

    ////////////////////////////////////////////////////////////////////
    // //Agregamos el producto tohallas humedas a la categoria limpieza
    // $product2 = new Product();
    // $product2->name = "Tohallas humedas";
    // $product2->sale_price = 3;
    // $product2->quantity = 20;
    // $product2->status = "Activo";
    // $product2->category_id=1; // haciendo referencai a lo que es el id de la categoria.
    //$product2->save();
    // return view('test', ['product' => $product]); // retorna los datos que enviamos de la base de datos

    //OBTENEMOS LOS PRODUCTOS DE LA CATEGORIA 2
    // $category = Category::find(2); //muestra la categoria
    // return view('test', ['category'=> $category]);//devuelve la categoria

    //OBTENEMOS LA CATEGORIA CON EL NOMBRE DE LA CATEGORIA
    // $category = Category::where('name', '=', 'Aguas y gaseosas')->first();
    // return view('test', ['category' => $category]);

    //OBTENEMOS TODOS LOS PRODUCTOS
    // $products = Product::all();
    // return view('test', ['products' => $products]);

    ////////////////CONSTRUCTOR DE CONSULTAS A LA BASE DE DATOS/////////
    //Obtener todos los productos y las cateogiras a la que pertenece cada producto
    // $products = DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->select('products.name','categories.name as category_name')->get(); //usamos de la base de datos la tabla productos
    // return view('test', ['products' => $products]);

    /////INSERTANDO DATOS A LA BASE DE DATOS SIN UAR ELOQUENT ORM/////
    //$category = DB::table('categories')->insert(['name'=>"Celulares"]);

    /////HACIENDO LA PRUEBA DE LA TERCERA TABLA DE PRODUCTOS, VENTAS Y CLIENTES
    $sale = Sale::find(1);
    return view('test', ['sale'=>$sale]);
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
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
