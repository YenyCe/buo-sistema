@extends('layouts.app')

@section('title', 'Carreras')

@section('content')
<div class="container-form">

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif


    <h2>Carreras</h2>
<button 
    class="btn-agregar" 
    data-title="Agregar Carrera"
    data-action="{{ route('carreras.store') }}"
    data-method="POST"
    data-campos='@json(["nombre"=>"","clave"=>""])'>
    Agregar Carrera
</button>

    <table class="tabla-docentes">
        <thead>
            <tr><th>ID</th><th>Nombre</th><th>Clave</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            @foreach($carreras as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->nombre }}</td>
                <td>{{ $c->clave }}</td>
                <td>
                    <button 
            class="btn-editar"
            data-title="Editar Carrera"
            data-action="{{ route('carreras.update', $c->id) }}"
            data-method="PUT"
            data-campos='@json(["nombre"=>$c->nombre,"clave"=>$c->clave])'>
            Editar
        </button>



                    <form action="{{ route('carreras.destroy', $c->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('partials.modal')
@endsection

@section('scripts')
@include('partials.modal-scripts')
@endsection
