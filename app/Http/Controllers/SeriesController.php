<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Season;
use App\Models\Series;
use Psy\Command\EditCommand;
use App\Models\Episode;

class SeriesController extends Controller
{
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
        $serie = Series::create($request->all());

        $seasons = [];

        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i,
            ];
        }

        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->season as $temp) {
            for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $episodes[] = [
                    'seasons_id' => $temp->id,
                    'number' => $j,
                ];
            }
        }

        Episode::insert($episodes);


        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$request->name}' adicionada com sucesso");
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
