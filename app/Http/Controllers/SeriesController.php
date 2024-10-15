<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Series;
use App\Mail\SeriesCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\Autenticador;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;

class SeriesController
{
    public function __construct(protected SeriesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        //->orderBy('name', 'desc')->get()
        $series = Series::all();
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
        $path = $request->file('cover')->store('series_cover', 'public');


        $serieData = [
            'name' => $request->name,
            'seasonsQty' => $request->seasonsQty,
            'episodesPerSeason' => $request->episodesPerSeason,
            'cover' => $path,
        ];

        $serie = $this->repository->add($serieData);
        \App\Events\SeriesCreated::dispatch(
            $serieData['name'],
            $serie->id,
            $serieData['seasonsQty'],
            $serieData['episodesPerSeason']
        );

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->name}' adicionada com sucesso");
    }

    public function destroy(Series $series)
    {
        \App\Events\SeriesDeleted::dispatch(
            $series->id,
            $series->cover
        );

        $series->delete();
        return to_route('series.index')
            ->with("mensagem.sucesso", "Série '$series->name' removida com sucesso");
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$series->name} atualizada com sucesso!");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }
}
