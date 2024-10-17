@extends('my-layouts.vapor')

@section('content')
    <section class="hero-section">
        <div class="overlay"></div>
        <div class="content">
            <h1>SonicWave</h1>
            <p>Feel the Pulse, Ride the Wave</p>

            <div class="description">
                <p>Ofrecemos sintetizadores y cajas de ritmos de vanguardia, combinando tecnología avanzada con sonidos clásicos para brindarte una experiencia musical única. Desde los modelos más icónicos hasta los más innovadores, cada equipo te transportará a los ritmos envolventes de los años 80, despertando tu creatividad y llevándola a un nuevo nivel sonoro.</p>
            </div>

            <a href="/categorias" class="productos-btn">Explorar Productos</a>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </section>
@endsection
