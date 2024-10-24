@extends('layouts.shop')

@section('content')
<body class="spotify-view"> <!-- Añadir la clase spotify-view aquí -->
    <div class="container">
        <div class="row">
            <!-- Columna izquierda: Información del artista -->
            <div class="col-md-6">
                <h1 class="spotify-title">Búsqueda de Artista en Spotify</h1>

                <form method="POST" action="{{ route('buscar.artista') }}">
                    @csrf
                    <label for="artist_name">Nombre del Artista:</label>
                    <input type="text" id="artist_name" name="artist_name" placeholder="Ingrese el nombre del artista" required>
                    <button type="submit">Buscar</button>
                </form>

                @if (isset($artist_data))
                    <div class="artist-info">
                        <h2>Información del Artista</h2>
                        <p><strong>Nombre:</strong> {{ $artist_data['name'] }}</p>
                        <p><strong>Seguidores:</strong> {{ number_format($artist_data['followers']) }}</p>
                        <p><strong>Géneros:</strong> {{ $artist_data['genres'] }}</p>
                        @if ($artist_data['image'])
                            <img src="{{ $artist_data['image'] }}" alt="Imagen del artista" class="artist-image">
                        @endif
                    </div>
                @endif
            </div>

            <!-- Columna derecha: Top 5 Canciones -->
            <div class="col-md-6">
                @if (isset($top_tracks) && count($top_tracks) > 0)
                    <div class="top-tracks">
                        <h2>Top 5 Canciones</h2>
                        <ol>
                            @foreach ($top_tracks as $track)
                                <li>
                                    <p><strong>{{ $track['name'] }}</strong></p>
                                    @if(isset($track['preview_url']) && $track['preview_url'])
                                        <audio controls>
                                            <source src="{{ $track['preview_url'] }}" type="audio/mpeg">
                                            Tu navegador no soporta la reproducción de audio.
                                        </audio>
                                    @else
                                        <p class="vista-previa-no-disponible"><br>Vista previa no disponible</p>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
@endsection
