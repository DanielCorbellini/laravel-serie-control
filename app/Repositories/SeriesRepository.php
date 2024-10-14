<?php

namespace App\Repositories;

use App\Models\Series;

interface SeriesRepository
{
    public function add(array $serieData): Series;
}
