<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Http\Request;
use Psy\Command\EditCommand;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function __construct(protected SeriesRepository $seriesRepository)
    {
        $this->seriesRepository = $seriesRepository;
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

        $serieData = [
            'name' => $request->name,
            'seasonsQty' => $request->seasonsQty,
            'episodesPerSeason' => $request->episodesPerSeason,
        ];

        $serie = $this->seriesRepository->add($serieData);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->name}' adicionada com sucesso");
    }

    public function destroy(Series $series)
    {
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
