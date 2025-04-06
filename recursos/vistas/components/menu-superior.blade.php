@php

$periodoActual = SABL\Modelos\Periodo::obtenerPeriodoActual();

@endphp

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item d-flex align-items-center">
      <h2 class="h6 font-weight-bold m-0">Período: {{ $periodoActual }}</h2>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="login.php" data-controlsidebar-slide="true" href="./salir" role="button">
        <i class="fas fa-sign-out-alt"> Salir</i>
      </a>
    </li>
  </ul>
</nav>
