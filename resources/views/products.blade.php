@extends('layouts.shop')

@section('title', "Productos de {{ $categoria->nombre }}")

@section('content')
<div class="categoria-fondo" style="background-image: url('{{ asset($categoria->imagen_fondo) }}'); height: 100vh; background-size: cover; background-position: center;">
    <h1>{{ $categoria->nombre }}</h1>
</div>
@endsection
