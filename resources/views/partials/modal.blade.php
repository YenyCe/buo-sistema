<div id="modalGenerico" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h2 id="tituloModalGenerico">Agregar</h2>

        <form id="formGenerico" method="POST">
            @csrf
            <input type="hidden" name="id" id="idGenerico">
            <div id="camposGenericos"></div>
            <button type="submit">Guardar</button>
        </form>
    </div>
</div>
