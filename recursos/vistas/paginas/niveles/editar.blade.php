@php

$datos = flash()->display('datos');

@endphp

<x-plantillas.inicio titulo="Editar año">
  <form
    method="post"
    action="./niveles/{{ $nivel->Id_Nivel_estud }}"
    class="card card-body col-lg-6 mx-auto">
    <label class="input-group">
      <i class="input-group-text">N°</i>
      <input
        type="number"
        name="nombre"
        required
        min="{{ $nivel->ordinal ?? $ultimoNivel + 1 }}"
        max="{{ $ultimoNivel + 1 }}"
        placeholder="1, 2, 3, ..."
        class="form-control"
        value="{{ $nivel->ordinal ?? $datos['nombre'] ?? ($ultimoNivel + 1) }}" />
    </label>

    <button class="btn btn-primary">Actualiza año</button>
  </form>
</x-plantillas.inicio>
