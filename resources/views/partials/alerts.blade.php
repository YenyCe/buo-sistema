@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    mostrarMensaje('success', "{{ session('success') }}");
});
</script>
@endif

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        mostrarMensaje('error', "{{ $errors->first() }}");
    });
</script>
@endif

