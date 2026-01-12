@extends('layouts.app')

@section('title', 'Carreras')

@section('content')
<div class="container-form">
    <h2>Carreras</h2>

    <!-- Botón Agregar -->
    <button class="btn-agregar" onclick="abrirModalCarrera()">Agregar Carrera</button>

    <!-- Tabla de carreras -->
    <table class="tabla-docentes">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Clave</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carreras as $c)
            <tr data-id="{{ $c->id }}" data-nombre="{{ $c->nombre }}" data-clave="{{ $c->clave }}">
                <td>{{ $c->id }}</td>
                <td>{{ $c->nombre }}</td>
                <td>{{ $c->clave }}</td>
                <td class="acciones">
                    <button class="btn-editar" onclick="abrirModalCarrera(this.closest('tr').dataset.id)">Editar</button>


                    <form action="{{ route('carreras.destroy', $c->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar" onclick="return confirm('¿Eliminar esta carrera?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Carrera -->
<div id="modalCarrera" class="modal">
    <div class="modal-content">
        <span class="cerrar" onclick="cerrarModal('modalCarrera')">&times;</span>
        <h2 id="tituloModalCarrera">Agregar Carrera</h2>

        <form id="formCarrera" action="{{ route('carreras.store') }}" method="POST">
    @csrf
    <span id="methodField"></span> <!-- Aquí agregaremos PUT si es editar -->
    <input type="hidden" name="id" id="id_carrera">
    <label>Nombre</label>
    <input type="text" name="nombre" id="nombreCarrera" required>
    <label>Clave</label>
    <input type="text" name="clave" id="claveCarrera" required>
    <button type="submit">Guardar</button>
</form>

    </div>
</div>
@endsection

@section('scripts')
<script>
function abrirModalCarrera(id = null) {
    const modal = document.getElementById('modalCarrera');
    modal.style.display = 'block';

    const form = document.getElementById('formCarrera');
    const methodField = document.getElementById('methodField');
    if (id) {
        // Editar
        const row = document.querySelector(`tr[data-id='${id}']`);
        document.getElementById('tituloModalCarrera').innerText = 'Editar Carrera';
        document.getElementById('id_carrera').value = id;
        document.getElementById('nombreCarrera').value = row.dataset.nombre;
        document.getElementById('claveCarrera').value = row.dataset.clave;

        form.action = `/carreras/${id}`; // ruta update
        methodField.innerHTML = '@method("PUT")'; // agrega PUT dinámicamente
    } else {
        // Agregar
        document.getElementById('tituloModalCarrera').innerText = 'Agregar Carrera';
        document.getElementById('id_carrera').value = '';
        document.getElementById('nombreCarrera').value = '';
        document.getElementById('claveCarrera').value = '';

        form.action = "{{ route('carreras.store') }}";
        methodField.innerHTML = ''; // elimina PUT si estaba
    }
}


function cerrarModal(id) {
    document.getElementById(id).style.display = 'none';
}

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    const modal = document.getElementById('modalCarrera');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
@endsection
