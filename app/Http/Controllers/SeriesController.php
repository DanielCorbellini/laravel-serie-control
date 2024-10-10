<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::query()->orderBy('name', 'desc')->get();

        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $nomeSerie = $request->input('nome');
        $serie = new Serie();
        $serie->name = $nomeSerie;
        $serie->save();

        return redirect('/series');
    }
}
