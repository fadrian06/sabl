@php

$datos = flash()->display('datos');

@endphp

<x-plantillas.inicio titulo="Aperturar año">
  <form
    method="post"
    action="./niveles"
    class="card card-body col-lg-6 mx-auto">
    <label class="input-group">
      <i class="input-group-text">N°</i>
      <input
        type="number"
        name="nombre"
        required
        min="{{ $ultimoNivel + 1 }}"
        max="{{ $ultimoNivel + 1 }}"
        placeholder="1, 2, 3, ..."
        class="form-control"
        value="{{ $datos['nombre'] ?? ($ultimoNivel + 1) }}" />
    </label>

    <button class="btn btn-primary">Aperturar año</button>
  </form>
</x-plantillas.inicio>
