@php

$datos = flash()->display('datos');

@endphp

<x-plantillas.inicio titulo="Actualizar materia">
  <form
    method="post"
    action="./materias/{{ $materia->Id_Mat }}"
    class="card card-body col-lg-6 mx-auto">

    <label class="input-group">
      <i class="input-group-text bx bx-code"></i>
      <input
        name="codigo"
        required
        placeholder="Código"
        class="form-control"
        value="{{ $datos['codigo'] ?? $materia->Codigo_Mat }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-text"></i>
      <input
        name="nombre"
        required
        minlength="3"
        placeholder="Nombre"
        pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,}"
        class="form-control"
        value="{{ $datos['nombre'] ?? $materia }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-text"></i>
      <textarea
        name="descripcion"
        required
        minlength="3"
        placeholder="Descripción"
        pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,}"
        class="form-control">{{ $datos['descripcion'] ?? $materia->Descripción }}</textarea>
    </label>

    <button class="btn btn-primary">Actualizar materia</button>
  </form>
</x-plantillas.inicio>
