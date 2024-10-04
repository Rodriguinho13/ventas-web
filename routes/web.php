<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB; //para el constructo de consultas en Laravel
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProviderController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Route::get('/', function(){

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


//});

///////////////////CREANDO RUTA PARA PODER LISTAR Y UTILIZAR LA FUNCIÓN INDEX DEL CONTROLADOR CATEGORY//////////////
//Route::get('/categories', [CategoryController::class, 'index']);

///////////////////CREANDO RUTA PARA PODER CREAR LA FUNCIÓN CREATE DEL CONTROLADOR CATEGORY//////////////
//Route::get('/categories', [CategoryController::class, 'create']);

///////////////////CREANDO RUTA PARA PODER MOSTRAR, LISTAR Y UTILIZAR LA FUNCIÓN STORE DEL CONTROLADOR CATEGORY//////////////
//Route::post('/categories/store', [CategoryController::class, 'store']);

///////////////////CREANDO RUTA PARA PODER MOSTRAR UNA CATEGORIA DE LA FUNCIÓN SHOW DEL CONTROLADOR CATEGORY//////////////
//Route::get('/categories/show/{$id}', [CategoryController::class, 'show']);


/////////////////////////GRUPO DE RUTAS PARA CATEGORY CONTROLLER/////////////////////////////
Route::middleware('auth')->group(function(){

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::get('/categories/create', 'create');
        Route::post('/categories/store', 'store')->name('categories.store');
        Route::get('/categories/show/{id}', 'show');
        Route::get('/categories/edit/{id}', 'edit');
        Route::put('/categories/update/{id}', 'update')->name('categories.update');
        Route::delete('/categories/delete/{id}', 'destroy');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products.index');
        Route::get('/products/create', 'create');
        Route::post('/products/store', 'store');
        Route::get('/products/show/{id}', 'show');
        Route::get('/products/edit/{id}', 'edit');
        Route::put('/products/update/{id}', 'update');
        Route::delete('/products/delete/{id}', 'destroy');
    });

    Route::controller(ProviderController::class)->group(function () {
        Route::get('/providers', 'index')->name('providers.index');
        Route::get('/providers/create', 'create');
        Route::post('/providers', 'store')->name('providers.store');
        Route::get('/providers/{id}', 'show');
        Route::get('/providers/{id}/edit', 'edit');
        Route::put('/providers/{id}', 'update')->name('providers.update');
        Route::delete('/providers/{id}', 'destroy');
    });

    Route::controller(BuyController::class)->group(function () {
        Route::get('/buys', 'index');
        Route::get('/buys/create', 'create');
        Route::post('/buys', 'store');
        Route::get('/buys/{id}', 'show');
        Route::get('/buys/{id}/edit', 'edit');
        Route::put('/buys/{id}', 'update');
        Route::delete('/buys/{id}', 'destroy');
    });

    Route::controller(ClientController::class)->group(function () {
        Route::get('/clients', 'index')->name('clients.index');
        Route::get('/clients/create', 'create')->name('clients.create');
        Route::post('/clients', 'store')->name('clients.store');
        Route::get('/clients/{id}', 'show')->name('clients.show');
        Route::get('/clients/{id}/edit', 'edit')->name('clients.edit');
        Route::put('/clients/{id}', 'update')->name('clients.update');
        Route::delete('/clients/{id}', 'destroy')->name('clients.destroy');
    });

    Route::controller(SaleController::class)->group(function () {
        Route::get('/sales', 'index');
        Route::get('/sales/create', 'create');
        Route::post('/sales', 'store');
        Route::get('/sales/{id}', 'show');
        Route::get('/sales/{id}/edit', 'edit');
        Route::put('/sales/{id}', 'update');
        Route::delete('/sales/{id}', 'destroy');
    });
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
