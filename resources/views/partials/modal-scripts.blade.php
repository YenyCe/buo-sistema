<script>
let modalActual = 'modalGenerico';

function abrirModalGen(titulo, action, method='POST', campos={}) {
    const modal = document.getElementById(modalActual);
    const form = document.getElementById('formGenerico');
    const camposDiv = document.getElementById('camposGenericos');

    modal.style.display = 'block';
    document.getElementById('tituloModalGenerico').innerText = titulo;
    form.action = action;
    form.method = 'POST';
    camposDiv.innerHTML = '';

    const oldMethod = form.querySelector('input[name="_method"]');
    if(oldMethod) oldMethod.remove();

    if(method.toUpperCase() !== 'POST') {
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = method.toUpperCase();
        form.appendChild(methodInput);
    }

    for(const key in campos){
        const label = document.createElement('label');
        label.innerText = key.charAt(0).toUpperCase() + key.slice(1);
        const input = document.createElement('input');
        input.type = 'text';
        input.name = key;
        input.value = campos[key] ?? '';
        input.required = true;

        camposDiv.appendChild(label);
        camposDiv.appendChild(input);
    }
}

function cerrarModal() {
    document.getElementById(modalActual).style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById(modalActual);
    if(event.target == modal) cerrarModal();
}
</script>
