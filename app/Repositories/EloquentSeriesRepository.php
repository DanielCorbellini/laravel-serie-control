<?php

namespace App\Repositories;

use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{

    public function add(array $serieData): Series
    {
        DB::beginTransaction();

        $serie = Series::create([
            'name' => $serieData['name'],
            'cover' => $serieData['cover']
        ]);

        $seasons = [];

        for ($i = 1; $i <= $serieData['seasonsQty']; $i++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i,
            ];
        }

        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->seasons as $season) {
            for ($j = 1; $j <= $serieData['episodesPerSeason']; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j,
                ];
            }
        }

        Episode::insert($episodes);
        DB::commit();

        return $serie;
    }
}
