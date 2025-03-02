<?php

declare(strict_types=1);

?>
@php

$datos = flash()->display('datos');
$afinidades = [
'Madre',
'Padre',
'Tío',
'Tía',
'Abuelo',
'Abuela',
'Hermano',
'Hermana'
];

@endphp

<x-plantillas.inicio titulo="Editar representante">
  <form
    method="post"
    action="./representantes/{{ $representante->Id_Repres }}"
    class="card card-body col-lg-6 mx-auto">
    <label class="input-group">
      <i class="input-group-text bx bx-id-card"></i>
      <select
        name="nacionalidad"
        required
        class="form-control">
        <option value="">Nacionalidad</option>
        @foreach (['venezolano', 'extranjero'] as $nacionalidad)
        <option
          value="{{ $nacionalidad }}"
          class="text-capitalize"
          @selected(
            @$datos['nacionalidad']===$nacionalidad
            || $representante->Nacionalidad === $nacionalidad
          )>
          {{ $nacionalidad }}
        </option>
        @endforeach
      </select>
    </label>
    <label class="input-group">
      <i class="input-group-text bx bx-id-card"></i>
      <input
        type="number"
        name="cedula"
        required
        min="1"
        placeholder="Cédula"
        class="form-control"
        value="{{ $datos['cedula'] ?? $representante->Ced_Repres ?? '' }}" />
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
        value="{{ $datos['nombres'] ?? $representante->Nom_Repres ?? '' }}" />
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
        value="{{ $datos['apellidos'] ?? $representante->Apell_Repres ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-calendar"></i>
      <input
        type="date"
        name="fechaNacimiento"
        required
        placeholder="Fecha de nacimiento"
        class="form-control"
        value="{{ $datos['fechaNacimiento'] ?? $representante->Fec_Nac ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-pin"></i>
      <input
        name="lugarNacimiento"
        required
        placeholder="Lugar de nacimiento"
        class="form-control"
        value="{{ $datos['lugarNacimiento'] ?? $representante->Luga_Nac ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-pin"></i>
      <input
        name="direccion"
        required
        placeholder="Dirección"
        class="form-control"
        value="{{ $datos['direccion'] ?? $representante->Dir_Exac ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-envelope"></i>
      <input
        type="email"
        name="correo"
        required
        placeholder="Correo electrónico"
        class="form-control"
        value="{{ $datos['correo'] ?? $representante->Email_Repres ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-phone"></i>
      <input
        type="tel"
        name="telefono"
        required
        placeholder="Teléfono"
        class="form-control"
        value="{{ $datos['telefono'] ?? "0$representante->Telf_Repres" }}"
        pattern="[0-9]{11,13}"
        title="Ejemplo (04165335826 o 04247542450)" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-id-card"></i>
      <select
        name="afinidadConEstudiante"
        required
        class="form-control">
        <option value="">Afinidad con el estudiante</option>
        @foreach ($afinidades as $afinidad)
        <option
          @selected(
            @$datos['afinidadConEstudiante']===$afinidad
            || $representante->Afin_con_Est === $afinidad
          )>
          {{ $afinidad }}
        </option>
        @endforeach
      </select>
    </label>

    <button class="btn btn-primary">Actualizar representante</button>
  </form>
</x-plantillas.inicio>
<?php 
