@component('mail::message')
# Série {{ $nomeSerie }} criada

A série {{ $nomeSerie }} com {{ $qtdTemporadas }} temporadas e {{ $episodiosPorTemporada }} episódios por temporada
foi criada

Acesse aqui:
@component('mail::button', ['url' => route('series.index', $idSerie)])
Ver série
@endcomponent
@endcomponent
