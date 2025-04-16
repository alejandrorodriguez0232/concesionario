<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::where('user_id', auth()->id())->get();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'año' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'kilometraje' => 'required|integer|min:0',
        ]);

        $validated['user_id'] = auth()->id();
        
        Car::create($validated);

        return redirect()->route('cars.index')->with('success', 'Carro creado exitosamente');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.create', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'año' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'kilometraje' => 'required|integer|min:0',
        ]);

        $car->update($validated);

        return redirect()->route('cars.index')->with('success', 'Carro actualizado exitosamente');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Carro eliminado exitosamente');
    }
}