<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        
    }
    
    public function index()
    {
        $cars = Car::latest()->paginate(10);
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
        
        $validated['user_id'] = Auth::id();
        
        Car::create($validated);
        
        return redirect()->route('cars.index')->with('success', 'Auto agregado correctamente.');
    }
    
    public function show(Car $car)
    {
        if (!$car) {
            abort(404); // O redireccionar con un mensaje de error
        }

        return view('cars.show', compact('car'));
    }
    
    public function edit(Car $car)
    {
        $this->authorize('update', $car);
        return view('cars.edit', compact('car'));
    }
    
    public function update(Request $request, Car $car)
    {
        $this->authorize('update', $car);
        
        $validated = $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'año' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'kilometraje' => 'required|integer|min:0',
        ]);
        
        $car->update($validated);
        
        return redirect()->route('cars.index')->with('success', 'Auto actualizado correctamente.');
    }
    
    public function destroy(Car $car)
    {
        $this->authorize('delete', $car);
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Auto eliminado correctamente.');
    }

    public function search(Request $request)
    {
        $query = Car::query();
        
        if ($request->has('marca') && $request->marca != '') {
            $query->where('marca', 'like', '%' . $request->marca . '%');
        }
        
        if ($request->has('modelo') && $request->modelo != '') {
            $query->where('modelo', 'like', '%' . $request->modelo . '%');
        }
        
        if ($request->has('min_precio') && $request->min_precio != '') {
            $query->where('precio', '>=', $request->min_precio);
        }
        
        if ($request->has('max_precio') && $request->max_precio != '') {
            $query->where('precio', '<=', $request->max_precio);
        }
        
        $cars = $query->paginate(10);
        
        return view('cars.index', compact('cars'));
    }
}