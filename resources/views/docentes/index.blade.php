@extends('layouts.app')

@section('title', 'Docentes')

@section('content')
<div class="container-form">

<div id="alertGenerico" class="alert" style="display:none;"></div>

<h2>Docentes</h2>
@if($rol === 'admin')
    <div style="margin-bottom:15px;">
        <label>Filtrar por carrera:</label>
        <select id="filtroCarrera">
            <option value="">Todas</option>
            @foreach($carreras as $c)
                <option value="{{ $c->id }}">{{ $c->nombre }}</option>
            @endforeach
        </select>
    </div>
@endif
<button
    class="btn-agregar"
    data-title="Agregar Docente"
    data-action="{{ route('docentes.store') }}"
    data-method="POST"
    data-campos='{"nombre":"","apellidos":"","correo":"","telefono":"","genero":"","id_carrera":""}'>
    Agregar Docente
</button>

<table class="tabla-docentes">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($docentes as $d)
        <tr data-id_carrera="{{ $d->id_carrera }}">
            <td>{{ $d->id }}</td>
            <td>{{ $d->nombre }} {{ $d->apellidos }}</td>
            <td>{{ $d->correo }}</td>
            <td>{{ $d->telefono }}</td>
            <td>{{ $d->genero === 'M' ? 'Mujer' : 'Hombre' }}</td>

            @if($rol === 'admin')
                <td>{{ $d->carrera->nombre ?? '-' }}</td>
            @endif

            <td>
                <button class="btn-editar"
                    data-title="Editar Docente"
                    data-action="{{ route('docentes.update', $d->id) }}"
                    data-method="PUT"
                    data-campos='{{ json_encode([
                        "nombre" => $d->nombre,
                        "apellidos" => $d->apellidos,
                        "correo" => $d->correo,
                        "telefono" => $d->telefono,
                        "genero" => $d->genero
                    ]) }}'>
                    Editar
                </button>


                <form action="{{ route('docentes.destroy', $d->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn-eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

<script>
document.getElementById('filtroCarrera')?.addEventListener('change', function () {
    let filtro = this.value;
    document.querySelectorAll("tbody tr").forEach(row => {
        if (filtro === "" || row.dataset.id_carrera === filtro) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
</script>

@include('partials.modal')
@endsection

@section('scripts')
@include('partials.modal-scripts')
@endsection

