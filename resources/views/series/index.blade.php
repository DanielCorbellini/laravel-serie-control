<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between
             align-items-center">
                <a href="{{ route('seasons.index', $serie->id) }}">
                    {{ $serie->name }}
                </a>

                <span class="d-flex">
                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">E</a>
                    <form action="{{ route('series.destroy', $serie) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">X</button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
    </body>
</x-layout>
