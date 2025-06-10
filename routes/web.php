<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;//agregamos el controlador que usaremos
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Spatie\Permission\Contracts\Role;

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

////////MOSTRAMOS LOS DATOS DE INDEX EN LA RUTA CATEGORIES//////
//colocamos el metodo en este caso get para listar
//colocamos la ruta respectiva /categories
//Colocamos el controlador que usaremos y la funcion
Route::get('/categories', [CategoryController::class, 'index']);



/////CREAMOS TODAS LAS FUNCIONES CORRESPONDIENTES DEL CRUD EN BASE A LAS FUNCIONES Y METODOS DEL CONTROLADOR RESPECTIVO//////////

//CREAMOS LA RUTA PARA PODER UTILIZAR LA FUNCION INDEX DEL CATEGORYCONTROLLER
//Route::get('/categories', [CategoryController::class, 'index']); // Ruta para llamar a la funcion index el cual muestra la información, usa metodo get por que obtenemos información

//CREAMOS LA RUTA PARA PODER UTILIZAR LA FUNCION CREATE DEL CATEGORYCONTROLLER
//Route::get('/categories', [CategoryController::class, 'create']); // Ruta para llamar a la funcion create el cual va a crear datos para ser almacenados en la BD, usa metodo get por que obtenemos información

//CREAMOS LA RUTA PARA PODER UTILIZAR LA FUNCION STORE DEL CATEGORYCONTROLLER
//Route::post('/categories/store', [CategoryController::class, 'store']); // Ruta para llamar a la funcion store el cual va a almacenar los datos que seran almacenados en la BD, usa metodo post por que vamos a insertar información en la base de datos

//CREAMOS LA RUTA PARA PODER UTILIZAR LA FUNCION SHOW DEL CATEGORYCONTROLLER
//Route::get('/categories/show/[{id}]', [CategoryController::class, 'show']); // Ruta para llamar a la funcion show el cual nos va a mostrar los datos almacenados, pero utilizando el id, ya que ese parametro nos pide en el controlador

//CREAMOS LA RUTA PARA PODER UTILIZAR LA FUNCION EDIT DEL CATEGORYCONTROLLER
//Route::get('/categories/edit/[{id}]', [CategoryController::class, 'edit']); // Ruta para llamar a la funcion edit el cual nos va a permitir modificar los datos almacenados, pero utilizando el id, ya que ese parametro nos pide en el controlador

//CREAMOS LA RUTA PARA PODER UTILIZAR LA FUNCION UPDATE DEL CATEGORYCONTROLLER
//Route::put('/categories/update/[{id}]', [CategoryController::class, 'update']); // Ruta para llamar a la funcion update el cual nos va a permitir actulizar los datos almacenados, pero utilizando el id, ya que ese parametro nos pide en el controlador

//CREAMOS LA RUTA PARA PODER UTILIZAR LA FUNCION DELETE DEL CATEGORYCONTROLLER
//Route::delete('/categories/delete/[{id}]', [CategoryController::class, 'destroy']); // Ruta para llamar a la funcion delete el cual nos va a permitir borrar todos los datos almacenados, pero utilizando el id, ya que ese parametro nos pide en el controlador

/////////////////////-------------//////////////---------------///////////
////TODAS ESTAS RUTAS, SE PUEDEN SIMPLIFICAR, DEBIDO A QUE TODAS LAS FUCIONES UTILIZAN EL MISMO CONTROLADOR, PARA LO CUAL SE USA LA AGRUPACIÓN DE CATEGORIAS///////

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
        Route::post('/products/store', 'store')->name('products.store');
        Route::get('/products/show/{id}', 'show');
        Route::get('/products/edit/{id}', 'edit');
        Route::put('/products/update/{id}', 'update')->name('products.update');
        Route::delete('/products/delete/{id}', 'destroy');
        Route::post('/products/import', 'import')->name('products.import');
        Route::post('/products/load', 'load')->name('products.load');
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
        // Route::get('/sales', 'index');
        // Route::get('/sales/create', 'create');
        Route::post('/sales', 'store')->name('sales.store');
        // Route::get('/sales/{id}', 'show');
        // Route::get('/sales/{id}/edit', 'edit');
        // Route::put('/sales/{id}', 'update');
        // Route::delete('/sales/{id}', 'destroy');
    });
require __DIR__.'/auth.php';
