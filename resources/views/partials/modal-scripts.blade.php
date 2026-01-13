<script>
document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById('modalGenerico');
    const form = document.getElementById('formGenerico');
    const camposDiv = document.getElementById('camposGenericos');
    const tituloModal = document.getElementById('tituloModalGenerico');

    // Abrir modal
    document.querySelectorAll(".btn-agregar, .btn-editar").forEach(btn => {
        btn.addEventListener("click", () => {
            const title = btn.dataset.title;
            const action = btn.dataset.action;
            const method = btn.dataset.method;
            const campos = JSON.parse(btn.dataset.campos);

            tituloModal.innerText = title;
            form.action = action;

            // Método PUT
            let hiddenMethod = form.querySelector("input[name='_method']");
            if (hiddenMethod) hiddenMethod.remove();

            if (method !== "POST") {
                hiddenMethod = document.createElement("input");
                hiddenMethod.type = "hidden";
                hiddenMethod.name = "_method";
                hiddenMethod.value = method;
                form.appendChild(hiddenMethod);
            }

            // Generar campos
            camposDiv.innerHTML = "";
            for (const key in campos) {
                const label = document.createElement("label");
                label.innerText = key.toUpperCase();

                const input = document.createElement("input");
                input.type = "text";
                input.name = key;
                input.value = campos[key] ?? "";
                input.required = true;

                camposDiv.appendChild(label);
                camposDiv.appendChild(input);
            }

            modal.style.display = "block";
        });
    });

    // Cerrar modal
    document.querySelector(".cerrar").addEventListener("click", () => {
        modal.style.display = "none";
    });

    window.addEventListener("click", e => {
        if (e.target === modal) modal.style.display = "none";
    });

});
</script>
