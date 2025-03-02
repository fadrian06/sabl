@php

$datos = flash()->display('datos');

@endphp

<x-plantillas.inicio titulo="Editar sección">
  <form
    method="post"
    action="./secciones/{{ $seccion->Id_Seccion }}"
    class="card card-body col-lg-6 mx-auto">
    <label class="input-group">
      <i class="input-group-text">Nombre</i>
      <input
        name="nombre"
        required
        minlength="1"
        maxlength="1"
        placeholder="A, B, C, ..."
        class="form-control"
        value="{{ $seccion ?? $datos['nombre'] ?? ''}}" />
    </label>
    <label class="input-group">
      <i class="input-group-text">Matrículas</i>
      <input
        type="number"
        name="matriculas"
        required
        min="1"
        placeholder="Capacidad de estudiantes"
        class="form-control"
        value="{{ $seccion->Numero_matriculas ?? $datos['matriculas'] ?? '' }}" />
    </label>

    <button class="btn btn-primary">Actualizar sección</button>
  </form>
</x-plantillas.inicio>
