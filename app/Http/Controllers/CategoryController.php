<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; //llamamos al modelo categoria para acceder a la base de datos
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();//Recuperamos toda la información haciendo uso de la funcion all y lo guardamos en la variable categories

        //Para que podamos retornar la información en una vista de Blade, usamos lo siguiente:
        //return view('categories.index',['categories' => $categories]);

        //Como estamos usando o usaremos inertia (REACT)
        return Inertia::render('Categories/Index', ['categories' => $categories]);

        //dd($categories->toArray());//para hacer las pruebas en POSTMAN

        //dd(csrf_token());//para generar la llave de acceso para formulario
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Hacemos que retorne una vista de inertia, como Categorias, no depende de nadie, no envia nada y solo creamos la vista del Usuario
        //Vista de Inertia   Carpeta Categories/vista Create donde va el formulario
        return Inertia::render('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = new Category(); //Se tiene que usar el Modelo para que estoy usando, la cual tiene una relación, para que tambien pueda acceder a todos los atributos de ese nombre, descripcion

        $category->name = $request->name;//obtenemos el nombre desde un formulario y almacenamos la información en el $request, obteniendo toda la información que pasamos desde la vista del usuario final desde el controlador
        $category->description = $request->description;//obtenemos la descripcion desde un formulario y almacenamos la información en el $request, obteniendo toda la información que pasamos desde la vista del usuario final desde el controlador

        $category->save();//almacena toda la información en la BD

        return Redirect::route('categories.index');//redireccionamos a la funcion index que tiene una vista de usuario

        //dd($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Permite mostrar una categoria segun el Id

        //obtenemos información de una categoria segun el id
        $category = Category::find($id);

        //mostramos la información en una vista llamada Show
        return Inertia::render('Categories/Show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //findOrFail muestra nulo si no encuentra la categoria
        $category = Category::findOrFail($id);
        return Inertia::render('Categories/Edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description=$request->description;
        $category->save();

        return Redirect::route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();

        //dd($category);
        return Redirect::route('categories.index');
    }
}
