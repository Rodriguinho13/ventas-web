<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BuyController extends Controller
{
    public function index()
    {
        $buys = Buy::all();
        return Inertia::render('Buys/Index', ['buys' => $buys]);
    }

    public function create()
    {
        return Inertia::render('Buys/Create');
    }

    public function store(Request $request)
    {
        $buy = new Buy();
        $buy->buy_date = $request->buy_date;
        $buy->provider_id = $request->provider_id;
        $buy->user_id = $request->user_id;
        $buy->save();

        return Redirect::route('buys.index');
    }

    public function show(string $id)
    {
        $buy = Buy::find($id);
        return Inertia::render('Buys/Show', ['buy' => $buy]);
    }

    public function edit(string $id)
    {
        $buy = Buy::findOrFail($id);
        return Inertia::render('Buys/Edit', ['buy' => $buy]);
    }

    public function update(Request $request, string $id)
    {
        $buy = Buy::find($id);
        $buy->buy_date = $request->buy_date;
        $buy->provider_id = $request->provider_id;
        $buy->user_id = $request->user_id;
        $buy->save();

        return Redirect::route('buys.index');
    }

    public function destroy(string $id)
    {
        $buy = Buy::find($id);
        $buy->delete();
        return Redirect::route('providers.index');
    }
}
