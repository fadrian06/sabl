@php

use SABL\Modelos\Periodo;

$periodoSeleccionado = @$_GET['id_periodo']
? Periodo::find($_GET['id_periodo'])
: Periodo::obtenerPeriodoActual();

@endphp

<x-plantillas.inicio titulo="Listado de años">
  <div class="col-md-12">
    <div class="card card-outline card-primary">
      <div class="card-boby">
        <form class="p-3">
          <h3>Seleccionar período</h3>
          <div class="input-group">
            <select name="id_periodo" class="form-control d-inline-block w-auto">
              @foreach ($periodos as $periodo)
              <option
                @selected($periodo->id === $periodoSeleccionado->id)
                value="{{ $periodo->id }}">
                {{ $periodo }}
              </option>
              @endforeach
            </select>
            <button class="input-group-append btn btn-primary">Consultar</button>
          </div>
        </form>

        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th></th>
                <th>Secciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($años as $año)
              <tr>
                <td>{{ $año }}</td>
                <td>
                  {{
                    $año->obtenerSeccionesPorPeriodo($periodoSeleccionado)
                      ->map(static fn(SABL\Modelos\Seccion $seccion): string => $seccion)
                      ->join(', ')
                  }}
                </td>
                <td class="btn-group">
                  <a
                    href="./años/{{ $año->id }}/editar"
                    class="btn btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-plantillas.inicio>
