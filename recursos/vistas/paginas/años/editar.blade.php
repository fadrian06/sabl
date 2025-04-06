@php

use SABL\Modelos\Periodo;

$datos = flash()->display('datos');

$periodoActual = Periodo::obtenerPeriodoActual();
$seccionesAsignadas = $año->obtenerSeccionesPorPeriodo($periodoActual);

@endphp

<x-plantillas.inicio titulo="Actualizar año">
  <form
    method="post"
    action="./años/{{ $año->id }}"
    class="card card-body col-lg-6 mx-auto">

    <label class="input-group">
      <i class="input-group-text bx bx-code"></i>
      <input
        disabled
        required
        class="form-control"
        value="{{ $año }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text">Período</i>
      <input
        disabled
        required
        class="form-control"
        value="{{ $periodoActual }}" />
    </label>

    <h4>Secciones asignadas</h4>
    @foreach ($secciones as $seccion)
    <div class="form-check">
      <input
        id="{{ $seccion }}"
        type="checkbox"
        class="form-check-input"
        name="asignaciones[{{ $seccion->id }}]"
        @checked($seccionesAsignadas->contains('id', $seccion->id)) />
      <label for="{{ $seccion }}">{{ $seccion }}</label>
    </div>
    @endforeach

    <button class="btn btn-primary">Actualizar año</button>
  </form>
</x-plantillas.inicio>
