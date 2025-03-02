<?php

declare(strict_types=1);

?>
@php

$datos = flash()->display('datos');

@endphp

<x-plantillas.inicio titulo="Aperturar sección">
  <form
    method="post"
    action="./niveles/{{ $nivel->Id_Nivel_estud }}/secciones"
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
        value="{{ $datos['nombre'] ?? ''}}" />
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
        value="{{ $datos['matriculas'] ?? '' }}" />
    </label>

    <button class="btn btn-primary">Aperturar sección</button>
  </form>
</x-plantillas.inicio>
<?php 
