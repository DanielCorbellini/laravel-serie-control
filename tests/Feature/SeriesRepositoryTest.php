<?php

// test when a series is created its seasons and episodes must also be created

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;



test('example', function () {


    //Arrange
    $repository = $this->app->make(SeriesRepository::class);
    $request = new SeriesFormRequest();
    $request = [
        'name' => 'nome da série',
        'seasonsQty' => 1,
        'episodesPerSeason' => 1,
        'cover' => 'fds'
    ];

    //Act
    $repository->add($request);

    //Assert
    $this->assertDatabaseHas('series', ['name' => 'nome da série']);
    $this->assertDatabaseHas('seasons', ['number' => 1]);
    $this->assertDatabaseHas('episodes', ['number' => 1]);
});
