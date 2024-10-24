@extends('layouts.shop')

@section('content')
<body class="spotify-view">
    <div class="container">
        <div class="row">
            <!-- Columna izquierda: Información del artista -->
            <div class="col-md-6">
                <h1 class="spotify-title">Buscar Artista</h1>

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

            <!-- Columna derecha: Información de la canción -->
            <div class="col-md-6">
                <h1 class="spotify-title">Buscar Canción</h1>

                <form method="POST" action="{{ route('buscar.cancion') }}">
                    @csrf
                    <label for="song_name">Nombre de la Canción:</label>
                    <input type="text" id="song_name" name="song_name" placeholder="Ingrese el nombre de la canción" required>
                    <button type="submit">Buscar</button>
                </form>

                @if (isset($track_data))
                    <div class="track-info">
                        <h2>Información de la Canción</h2>
                        <p><strong>Nombre:</strong> {{ $track_data['name'] }}</p>
                        <p><strong>Artista(s):</strong> {{ $track_data['artists'] }}</p>
                        <p><strong>Álbum:</strong> {{ $track_data['album'] }}</p>
                        <p><strong>Fecha de Lanzamiento:</strong> {{ $track_data['release_date'] }}</p>
                        @if ($track_data['image'])
                            <img src="{{ $track_data['image'] }}" alt="Imagen del álbum" class="artist-image">
                        @endif
                        @if ($track_data['preview_url'])
                            <audio controls>
                                <source src="{{ $track_data['preview_url'] }}" type="audio/mpeg">
                                Tu navegador no soporta la reproducción de audio.
                            </audio>
                        @else
                            <p class="vista-previa-no-disponible"><br>Vista previa no disponible</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
