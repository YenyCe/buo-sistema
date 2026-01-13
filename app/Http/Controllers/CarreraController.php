<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;

class CarreraController extends Controller
{
    // Mostrar todas las carreras
    public function index()
    {
        $carreras = Carrera::orderBy('id')->get();
        return view('carreras.index', compact('carreras'));
    }

    // Guardar nueva carrera
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'clave' => 'required|string|max:20|unique:carreras,clave',
        ], [
            'clave.unique' => 'La clave ya existe, usa otra diferente.',
        ]);


        Carrera::create($request->only('nombre','clave'));

        return redirect()->route('carreras.index')->with('success', 'Carrera agregada correctamente');
    }

    // Actualizar carrera
    public function update(Request $request, Carrera $carrera)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'clave'  => 'required|string|max:20|unique:carreras,clave,'.$carrera->id,
        ], [
            'clave.unique' => 'La clave ya existe, usa otra diferente.',
        ]);

        $carrera->update($request->only('nombre','clave'));

        return redirect()->route('carreras.index')->with('success', 'Carrera actualizada correctamente');
    }


    // Eliminar carrera
    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return redirect()->route('carreras.index')->with('success', 'Carrera eliminada correctamente');
    }
}
