<div id="modalGenerico" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h2 id="tituloModalGenerico">Título</h2>
        <form id="formGenerico" method="POST">
            @csrf
            <div id="camposGenericos"></div>
            <button type="submit">Guardar</button>
        </form>
    </div>
</div>
