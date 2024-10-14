<?php

namespace App\Repositories;

use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeriesFormRequest;

class SeriesRepository
{

    public function add(array $serieData): Series
    {
        DB::beginTransaction();

        $serie = Series::create(['name' => $serieData['name']]);

        $seasons = [];

        for ($i = 1; $i <= $serieData['seasonsQty']; $i++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i,
            ];
        }

        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->seasons as $temp) {
            for ($j = 1; $j <= $serieData['episodesPerSeason']; $j++) {
                $episodes[] = [
                    'season_id' => $temp->id,
                    'number' => $j,
                ];
            }
        }

        Episode::insert($episodes);
        DB::commit();

        return $serie;
    }
}
