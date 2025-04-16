@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">
            {{ isset($car) ? 'Editar Automóvil' : 'Agregar Nuevo Automóvil' }}
        </h1>
        
        <form action="{{ isset($car) ? route('cars.update', $car->id) : route('cars.store') }}" method="POST" class="space-y-6">
            @csrf
            @if(isset($car))
                @method('PUT')
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Marca -->
                <div>
                    <label for="marca" class="block text-sm font-medium text-gray-700 mb-1">Marca</label>
                    <input type="text" id="marca" name="marca" value="{{ old('marca', $car->marca ?? '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('marca')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Modelo -->
                <div>
                    <label for="modelo" class="block text-sm font-medium text-gray-700 mb-1">Modelo</label>
                    <input type="text" id="modelo" name="modelo" value="{{ old('modelo', $car->modelo ?? '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('modelo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Año -->
                <div>
                    <label for="año" class="block text-sm font-medium text-gray-700 mb-1">Año</label>
                    <input type="number" id="año" name="año" value="{{ old('año', $car->año ?? '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           min="1900" max="{{ date('Y') + 1 }}" required>
                    @error('año')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Color -->
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                    <input type="text" id="color" name="color" value="{{ old('color', $car->color ?? '') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Precio -->
                <div>
                    <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">Precio ($)</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" step="0.01" id="precio" name="precio" value="{{ old('precio', $car->precio ?? '') }}"
                               class="block w-full pl-7 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>
                    @error('precio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Kilometraje -->
                <div>
                    <label for="kilometraje" class="block text-sm font-medium text-gray-700 mb-1">Kilometraje (km)</label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="number" id="kilometraje" name="kilometraje" value="{{ old('kilometraje', $car->kilometraje ?? '') }}"
                               class="block w-full pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                               min="0" required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">km</span>
                        </div>
                    </div>
                    @error('kilometraje')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a href="{{ route('cars.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancelar
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    {{ isset($car) ? 'Actualizar Automóvil' : 'Guardar Automóvil' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection