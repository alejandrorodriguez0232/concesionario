@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Carro</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $car->marca }} {{ $car->modelo }}</h5>
            <p class="card-text">
                <strong>Año:</strong> {{ $car->año }}<br>
                <strong>Color:</strong> {{ $car->color }}<br>
                <strong>Precio:</strong> ${{ number_format($car->precio, 2) }}<br>
                <strong>Kilometraje:</strong> {{ number_format($car->kilometraje) }} km
            </p>
            
            <div class="d-flex">
                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning mr-2">Editar</a>
                <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
    
    <a href="{{ route('cars.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
</div>
@endsection