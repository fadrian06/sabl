@php

$datos = flash()->display('datos');

@endphp

<x-plantillas.inicio titulo="Registrar secretario">
  <form method="post" action="./usuarios" class="card card-body col-lg-6 mx-auto">
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
      <i class="input-group-text bx bx-user-circle"></i>
      <input
        name="usuario"
        required
        placeholder="Usuario"
        class="form-control"
        value="{{ $datos['usuario'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text bx bx-lock"></i>
      <input
        type="password"
        name="clave"
        required
        placeholder="Contraseña"
        minlength="8"
        pattern="(?=.*\d)(?=.*[A-ZÑ])(?=.*[a-zñ])(?=.*\W).{8,}"
        title="Al menos 8 caracteres (mínimo un dígito, una mayúscula, una minúscula y un símbolo)"
        class="form-control"
        value="{{ $datos['clave'] ?? '' }}" />
    </label>

    <button class="btn btn-primary">Registrar secretario</button>
  </form>
</x-plantillas.inicio>
