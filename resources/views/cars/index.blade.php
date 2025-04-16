@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Carros</h1>
    <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Carro</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Kilometraje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>{{ $car->marca }}</td>
                        <td>{{ $car->modelo }}</td>
                        <td>{{ $car->año }}</td>
                        <td>{{ $car->color }}</td>
                        <td>${{ number_format($car->precio, 2) }}</td>
                        <td>{{ number_format($car->kilometraje) }} km</td>
                        <td>
                            <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection