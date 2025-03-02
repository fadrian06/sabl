@php

$datos = flash()->display('datos');

@endphp

<x-plantillas.ingreso titulo="Crear cuenta">
  <div class="container-form">
    <div class="information">
      <div class="info-childs">
        <h2>Bienvenido</h2>
        <img src="imagenes/logo.png" width="100%" />
      </div>
    </div>

    <div class="form-information">
      <div class="form-information-childs">
        <h1>Crear cuenta</h1>
        <p>U.E.B."Silvestre A. Bravo L."</p>
        <div style="margin-block: 1rem">
          ¿Ya tienes cuenta?
          <a href="./ingreso">Ingresa aquí</a>
        </div>

        <form class="form" method="post">
          <label>
            <i class="bx bx-id-card"></i>
            <input
              type="number"
              name="cedula"
              required
              min="1"
              placeholder="Cédula"
              value="{{ $datos['cedula'] ?? '' }}" />
          </label>

          <label>
            <i class="bx bx-user-circle"></i>
            <input
              name="nombres"
              required
              minlength="3"
              placeholder="Nombres"
              pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,}"
              value="{{ $datos['nombres'] ?? '' }}" />
          </label>

          <label>
            <i class="bx bx-user-circle"></i>
            <input
              name="apellidos"
              required
              minlength="3"
              placeholder="Apellidos"
              pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,}"
              value="{{ $datos['apellidos'] ?? '' }}" />
          </label>

          <label>
            <i class="bx bx-user-circle"></i>
            <input
              name="usuario"
              required
              placeholder="Usuario"
              value="{{ $datos['usuario'] ?? '' }}" />
          </label>

          <label>
            <i class="bx bx-lock"></i>
            <input
              type="password"
              name="clave"
              required
              placeholder="Contraseña"
              minlength="8"
              pattern="(?=.*\d)(?=.*[A-ZÑ])(?=.*[a-zñ])(?=.*\W).{8,}"
              title="Al menos 8 caracteres (mínimo un dígito, una mayúscula, una minúscula y un símbolo)"
              value="{{ $datos['clave'] ?? '' }}" />
          </label>

          <input type="submit" value="Crear cuenta" />
        </form>
      </div>
    </div>
  </div>
</x-plantillas.ingreso>
