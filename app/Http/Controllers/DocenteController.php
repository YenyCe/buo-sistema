<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Carrera;

class DocenteController extends Controller
{
    public function index()
    {
        // Simulación mientras no hay login
        // Después esto vendrá de auth()->user()
        $rol = session('rol', 'admin'); 
        $id_carrera = session('id_carrera');

        if ($rol === 'coordinador') {
            $docentes = Docente::where('id_carrera', $id_carrera)->get();
        } else {
            $docentes = Docente::with('carrera')->get();
        }

        $carreras = Carrera::orderBy('nombre')->get();

        return view('docentes.index', compact('docentes', 'carreras', 'rol'));
    }

    public function guardar(Request $request)
    {
        $accion = $request->accion;

        // Validaciones básicas
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'genero' => 'required|in:H,M',
        ]);

        // Simulación rol
        $rol = session('rol', 'admin');
        $id_carrera_usuario = session('id_carrera');

        $id_carrera = ($rol === 'coordinador')
            ? $id_carrera_usuario
            : $request->id_carrera;

        // Validación duplicado (igual que tu proyecto viejo)
        $query = Docente::whereRaw('LOWER(nombre)=LOWER(?)', [$request->nombre])
            ->whereRaw('LOWER(apellidos)=LOWER(?)', [$request->apellidos]);

        if ($accion === 'editar') {
            $query->where('id', '!=', $request->id_docente);
        }

        if ($query->exists()) {
            return back()->withErrors('Ya existe un docente con ese nombre y apellidos');
        }

        if ($accion === 'agregar') {
            Docente::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'genero' => $request->genero,
                'id_carrera' => $id_carrera
            ]);

            return back()->with('success', 'Docente agregado correctamente');
        }

        if ($accion === 'editar') {
            $docente = Docente::findOrFail($request->id_docente);

            $docente->update([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'genero' => $request->genero,
                'id_carrera' => $id_carrera
            ]);

            return back()->with('success', 'Docente actualizado correctamente');
        }
    }

    public function destroy($id)
    {
        Docente::delete($id);
        return back()->with('success', 'Docente eliminado');
    }
}
