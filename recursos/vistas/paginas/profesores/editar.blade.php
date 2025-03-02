@php

$datos = flash()->display('datos');

@endphp

<x-plantillas.inicio titulo="Editar profesor">
  <form
    method="post"
    action="./profesores/{{ $profesor->Id_Prof }}"
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
        value="{{ $datos['cedula'] ?? $profesor->Ced_Prof ?? '' }}" />
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
        value="{{ $datos['nombres'] ?? $profesor->Nom_Prof ?? '' }}" />
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
        value="{{ $datos['apellidos'] ?? $profesor->Apell_Prof ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text">Fecha de nacimiento</i>
      <input
        type="date"
        name="fechaNacimiento"
        required
        placeholder="Fecha de nacimiento"
        class="form-control"
        value="{{ $datos['fechaNacimiento'] ?? $profesor->Fec_Nac ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-id-card"></i>
      <input
        name="codigoCarga"
        required
        placeholder="Código de carga"
        class="form-control"
        value="{{ $datos['codigoCarga'] ?? $profesor->Codigo_Carg_Prof ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-id-card"></i>
      <input
        name="codigoNomina"
        required
        placeholder="Código de nómina"
        class="form-control"
        value="{{ $datos['codigoNomina'] ?? $profesor->Codigo_Domina ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text">Fecha de ingreso al ministerio</i>
      <input
        type="date"
        name="fechaIngresoMinisterio"
        required
        placeholder="Fecha de ingreso al ministerio"
        class="form-control"
        value="{{ $datos['fechaIngresoMinisterio'] ?? $profesor->Fec_Incres_T_Minis ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-envelope"></i>
      <input
        type="email"
        name="correo"
        required
        placeholder="Correo electrónico"
        class="form-control"
        value="{{ $datos['correo'] ?? $profesor->Email_Prof ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-phone"></i>
      <input
        type="tel"
        name="telefono"
        required
        placeholder="Teléfono"
        class="form-control"
        value="{{ $datos['telefono'] ?? $profesor->Telf_Prof ?? '' }}"
        pattern="[0-9]{11,13}"
        title="Ejemplo (04165335826 o 04247542450)" />
    </label>

    <button class="btn btn-primary">Actualizar profesor</button>
  </form>
</x-plantillas.inicio>
