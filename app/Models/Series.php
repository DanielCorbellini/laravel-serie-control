<?php

namespace App\Models;

use App\Models\Season;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'cover'];
    //protected $with = ['seasons'];
    protected $appends = ['links'];

    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id');
    }


    public function episodes()
    {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name', 'desc');
        });
    }

    public function links(): Attribute
    {
        return new Attribute(
            get: fn() => [
                [
                    'rel' => 'self',
                    'url' => "/api/series/{$this->id}"
                ],
                [
                    'rel' => 'seasons',
                    'url' => "/api/series/{$this->id}/seasons"
                ],
                [
                    'rel' => 'episodes',
                    'url' => "/api/series/{$this->id}/episodes"
                ],
            ],
        );
    }
}
