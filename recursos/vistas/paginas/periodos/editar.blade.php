@php

$datos = flash()->display('datos');

@endphp

<x-plantillas.inicio titulo="Editar período">
  <form
    method="post"
    action="./periodos/{{ $periodo->id }}"
    class="card card-body col-lg-6 mx-auto">
    <label class="input-group">
      <i class="input-group-text">Año de inicio</i>
      <input
        type="number"
        class="form-control"
        name="año_inicio"
        required
        placeholder=""
        value="{{ $datos['año_inicio'] ?? $periodo->año_inicio }}" />
    </label>

    <button class="btn btn-primary">Actualizar período</button>
  </form>
</x-plantillas.inicio>
