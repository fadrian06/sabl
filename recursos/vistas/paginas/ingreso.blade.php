<?php

declare(strict_types=1);

?>
<x-plantillas.ingreso titulo="Ingreso">
  <div class="container-form">
    <div class="information">
      <div class="info-childs">
        <h2>Bienvenido</h2>
        <img src="imagenes/logo.png" width="100%" />
      </div>
    </div>

    <div class="form-information">
      <div class="form-information-childs">
        <h1>Iniciar sesión</h1>
        <p>U.E.B."Silvestre A. Bravo L."</p>

        @if (SABL\Modelos\Usuario::cantidadDeAdministradores() === 0)
          <div style="margin-block: 1rem">
            ¿No tienes cuenta?
            <a href="./crear-cuenta">Crea una</a>
          </div>
        @endif

        <form class="form" method="post">
          <label>
            <i class="bx bx-user-circle"></i>
            <input
              name="usuario"
              placeholder="Usuario"
              required
              value="{{ flash()->display('datos')['usuario'] ?? '' }}" />
          </label>

          <label>
            <i class="bx bx-lock"></i>
            <input
              type="password"
              name="clave"
              placeholder="Contraseña"
              required />
          </label>

          <input type="submit" value="Ingresar" />
        </form>
      </div>
    </div>
  </div>
</x-plantillas.ingreso>
<?php 
