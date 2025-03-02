@php

$datos = flash()->display('datos');

@endphp

<x-plantillas.inicio titulo="Aperturar período">
  <form
    method="post"
    action="./periodos"
    class="card card-body col-lg-6 mx-auto">

    <label class="input-group">
      <i class="input-group-text">Fecha de inicio</i>
      <input
        type="date"
        name="inicio"
        required
        placeholder="Inicia"
        class="form-control"
        value="{{ $datos['inicio'] ?? '' }}" />
    </label>

    <label class="input-group">
      <i class="input-group-text">Fecha de fin</i>
      <input
        type="date"
        name="fin"
        required
        placeholder="Termina"
        class="form-control"
        value="{{ $datos['fin'] ?? '' }}" />
    </label>

    <button class="btn btn-primary">Aperturar período</button>
  </form>
</x-plantillas.inicio>
