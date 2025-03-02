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

<x-plantillas.inicio titulo="Registrar representante">
  <form
    method="post"
    action="./representantes"
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
          @selected(@$datos['nacionalidad']===$nacionalidad)>
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
      <i class="input-group-text bx bx-calendar"></i>
      <input
        type="date"
        name="fechaNacimiento"
        required
        placeholder="Fecha de nacimiento"
        class="form-control"
        value="{{ $datos['fechaNacimiento'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-pin"></i>
      <input
        name="lugarNacimiento"
        required
        placeholder="Lugar de nacimiento"
        class="form-control"
        value="{{ $datos['lugarNacimiento'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-pin"></i>
      <input
        name="direccion"
        required
        placeholder="Dirección"
        class="form-control"
        value="{{ $datos['direccion'] ?? '' }}" />
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

    <label class="input-group">
      <i class="input-group-text bx bx-id-card"></i>
      <select
        name="afinidadConEstudiante"
        required
        class="form-control">
        <option value="">Afinidad con el estudiante</option>
        @foreach ($afinidades as $afinidad)
        <option
          @selected(@$datos['afinidadConEstudiante']===$afinidad)>
          {{ $afinidad }}
        </option>
        @endforeach
      </select>
    </label>

    <button class="btn btn-primary">Registrar representante</button>
  </form>
</x-plantillas.inicio>
