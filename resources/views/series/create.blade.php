<x-layout title="Nova Série">
    <form action="{{ route('series.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">

            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" autofocus id="nome" name="name" class="form-control"
                    value="{{ old('name') }}">
            </div>

            <div class="col-2">
                <label for="seasons" class="form-label">N° Temporadas:</label>
                <input type="number" id="seasons" name="seasonsQty" class="form-control"
                    value="{{ old('seasons') }}">
            </div>

            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Episódios / Temporada:</label>
                <input type="number" id="episodesPerSeason" name="episodesPerSeason" class="form-control"
                    value="{{ old('episodesPerSeason') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label for="cover" class="form-label">Capa</label>
                <input type="file" id="cover" name="cover" class="form-control"
                    accept="image/gif, image/jpeg, image/png">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>
