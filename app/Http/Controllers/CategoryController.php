<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); //recuperando toda la información de la categoria
            //return view('categories.index', ['categories'=> $categories]); //vista por si usamos vistas blade
        return Inertia::render('Categories/Index', ['categories' => $categories]); //mostrando los resultados
                                        //en una vista en inertia
        //dd(csrf_token()); para pruebas en POSTMAN y obtener el token de la aplicacion
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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

        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        //dd($category); para pruebas en POSTMAN
        return Redirect::route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return Inertia::render('Categories/Show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return Inertia::render('Categories/Edit', ['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;

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

        //dd($category); para pruebas en POSTMAN
        return Redirect::route('categories.index');
    }
}
