<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use Psy\Command\EditCommand;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('name', 'desc')->get();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {

        Serie::create($request->all());
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$request->name}' adicionada com sucesso");
    }

    public function destroy(Serie $series)
    {
        $series->delete();
        return to_route('series.index')
            ->with("mensagem.sucesso", "Série '$series->name' removida com sucesso");
    }

    public function update(Request $request, SeriesFormRequest $series)
    {
        $series->fill($request->all());
        $series->save();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$series->name} atualizada com sucesso!");
    }

    public function edit(Serie $series)
    {
        dd($series->season);
        return view('series.edit')->with('serie', $series);
    }
}
