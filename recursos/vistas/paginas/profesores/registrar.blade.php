<?php

declare(strict_types=1);

?>
@php

$datos = flash()->display('datos');

@endphp

<x-plantillas.inicio titulo="Registrar profesor">
  <form
    method="post"
    action="./profesores"
    class="card card-body col-lg-6 mx-auto">
    <label class="input-group">
      <i class="input-group-text bx bx-id-card"></i>
      <input
        type="number"
        name="cedula"
        required
        min="1"
        placeholder="Cédula"
        class="form-control"
        value="{{ $datos['cedula'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-user-circle"></i>
      <input
        name="nombres"
        required
        minlength="3"
        placeholder="Nombres"
        pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,}"
        class="form-control"
        value="{{ $datos['nombres'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-user-circle"></i>
      <input
        name="apellidos"
        required
        minlength="3"
        placeholder="Apellidos"
        pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,}"
        class="form-control"
        value="{{ $datos['apellidos'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text">Fecha de nacimiento</i>
      <input
        type="date"
        name="fechaNacimiento"
        required
        placeholder="Fecha de nacimiento"
        class="form-control"
        value="{{ $datos['fechaNacimiento'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-id-card"></i>
      <input
        name="codigoCarga"
        required
        placeholder="Código de carga"
        class="form-control"
        value="{{ $datos['codigoCarga'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-id-card"></i>
      <input
        name="codigoNomina"
        required
        placeholder="Código de nómina"
        class="form-control"
        value="{{ $datos['codigoNomina'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text">Fecha de ingreso al ministerio</i>
      <input
        type="date"
        name="fechaIngresoMinisterio"
        required
        placeholder="Fecha de ingreso al ministerio"
        class="form-control"
        value="{{ $datos['fechaIngresoMinisterio'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-envelope"></i>
      <input
        type="email"
        name="correo"
        required
        placeholder="Correo electrónico"
        class="form-control"
        value="{{ $datos['correo'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-phone"></i>
      <input
        type="tel"
        name="telefono"
        required
        placeholder="Teléfono"
        class="form-control"
        value="{{ $datos['telefono'] ?? '' }}"
        pattern="[0-9]{11,13}"
        title="Ejemplo (04165335826 o 04247542450)" />
    </label>

    <button class="btn btn-primary">Registrar profesor</button>
  </form>
</x-plantillas.inicio>
<?php 
