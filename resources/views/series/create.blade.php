<x-layout title="Nova Série">
    <form action="{{ route('series.store') }}" method="POST">
        @csrf

        <div class="row mb-3">

            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" autofocus id="nome" name="name" class="form-control"
                    value="{{ old('name') }}">
            </div>

            <div class="col-2">
                <label for="seasons" class="form-label">N° Temporadas:</label>
                <input type="text" id="seasons" name="seasonsQty" class="form-control"
                    value="{{ old('seasons') }}">
            </div>

            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Episódios / Temporada:</label>
                <input type="text" id="episodesPerSeason" name="episodesPerSeason" class="form-control"
                    value="{{ old('episodesPerSeason') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>

</x-layout>
