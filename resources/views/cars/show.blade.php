@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Detalles del Automóvil</h1>
        <a href="{{ route('cars.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Volver al listado
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="md:flex">
            <!-- Sección de imagen (puedes agregar una imagen real más tarde) -->
            <div class="md:w-1/3 bg-gray-200 flex items-center justify-center p-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
            
            <!-- Sección de detalles -->
            <div class="md:w-2/3 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $car->marca }} {{ $car->modelo }}</h2>
                <p class="text-lg text-blue-600 font-semibold mb-6">${{ number_format($car->precio, 2) }}</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Año</h3>
                        <p class="text-lg font-semibold text-gray-800">{{ $car->año }}</p>
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Color</h3>
                        <div class="flex items-center mt-1">
                            <span class="inline-block w-4 h-4 rounded-full mr-2" style="background-color: {{ $car->color }}"></span>
                            <p class="text-lg font-semibold text-gray-800 capitalize">{{ $car->color }}</p>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Kilometraje</h3>
                        <p class="text-lg font-semibold text-gray-800">{{ number_format($car->kilometraje) }} km</p>
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Estado</h3>
                        <p class="text-lg font-semibold text-gray-800">
                            @if($car->kilometraje < 10000)
                                <span class="text-green-600">Nuevo</span>
                            @elseif($car->kilometraje < 50000)
                                <span class="text-yellow-600">Semi-nuevo</span>
                            @else
                                <span class="text-gray-600">Usado</span>
                            @endif
                        </p>
                    </div>
                </div>
                
                <!-- Acciones -->
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('cars.edit', $car->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Editar Automóvil
                    </a>
                    
                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este automóvil?')" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Eliminar Automóvil
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection