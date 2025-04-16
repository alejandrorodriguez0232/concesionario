@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($car) ? 'Editar' : 'Agregar' }} Carro</h1>
    
    <form action="{{ isset($car) ? route('cars.update', $car->id) : route('cars.store') }}" method="POST">
        @csrf
        @if(isset($car))
            @method('PUT')
        @endif
        
        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $car->marca ?? '') }}" required>
        </div>
        
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo', $car->modelo ?? '') }}" required>
        </div>
        
        <div class="form-group">
            <label for="año">Año</label>
            <input type="number" class="form-control" id="año" name="año" value="{{ old('año', $car->año ?? '') }}" required>
        </div>
        
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $car->color ?? '') }}" required>
        </div>
        
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio', $car->precio ?? '') }}" required>
        </div>
        
        <div class="form-group">
            <label for="kilometraje">Kilometraje</label>
            <input type="number" class="form-control" id="kilometraje" name="kilometraje" value="{{ old('kilometraje', $car->kilometraje ?? '') }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection