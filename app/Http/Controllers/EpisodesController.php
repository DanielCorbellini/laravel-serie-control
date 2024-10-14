<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodesController
{
    public function index(Season $season)
    {
        $episodes = $season->episodes()->orderBy('id')->get();
        return view('episodes.index', [
            'episodes' => $episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, season $season)
    {
        $watchedEpisodes = $request->episodes;

        if (!empty($watchedEpisodes)) {
            $season->episodes()->update([
                'watched' => DB::raw('id IN (' . implode(',', $watchedEpisodes) . ')')
            ]);
        } else {
            // Se a lista estiver vazia, desmarcar todos os episódios como não assistidos
            $season->episodes()->update(['watched' => false]);
        }

        return to_route('episodes.index', $season->id)->with('mensagem.sucesso', 'Episódios marcados com sucesso!');
    }
}
