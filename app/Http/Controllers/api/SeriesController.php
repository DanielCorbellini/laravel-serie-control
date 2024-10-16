<?php

namespace App\Http\Controllers\api;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Series::query();
        if ($request->has('name')) {

            $query->where('name', $request->name);
        }

        return response()->json($query->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeriesFormRequest $request)
    {
        $this->seriesRepository->add($request->toArray());

        return response()->json([
            'message' => "Série criada com sucesso",
            'Séries' => $request->all(),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serie = Series::find($id);
        if ($serie === null) {
            return response()->json(['message' => 'Série não encontrada'], 404);
        }
        return response()->json($serie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Series::where('id', $id)->update($request->all());
        return response()->json(["Serie alterada com sucesso"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Series::destroy($id);
        return response()->json(["Item deletado com sucesso!"]);
    }
}
