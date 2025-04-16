@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Automóviles</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @auth
    <div class="mb-3">
        <a href="{{ route('cars.create') }}" class="btn btn-primary">Agregar Nuevo Auto</a>
    </div>
    @endauth
    
    <div class="row">
        @foreach($cars as $car)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->marca }} {{ $car->modelo }}</h5>
                    <p class="card-text">
                        Año: {{ $car->año }}<br>
                        Color: {{ $car->color }}<br>
                        Precio: ${{ number_format($car->precio, 2) }}<br>
                        Kilometraje: {{ number_format($car->kilometraje) }} km
                    </p>
                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                    
                    @auth
                    @if(Auth::id() == $car->user_id)
                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    {{ $cars->links() }}
</div>
@endsection