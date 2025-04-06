<x-plantillas.inicio titulo="Listado de períodos">
  <div class="col-md-12">
    <div class="card card-outline card-primary">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">
          Apertura los períodos con sus datos especificos.
        </h3>

        <div class="card-tools">
          <a class="btn btn-info my-2" href="./periodos/aperturar">
            <i class="fa fa-plus-square"></i>
            Aperturar período
          </a>
        </div>
      </div>

      <div class="card-boby">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th></th>
                <th>Período</th>
              </tr>
            </thead>
            <tbody>
              @foreach($periodos as $periodo)
              <tr>
                <td>
                  @if ($periodo->esActual)
                  <span class="badge badge-success">Actual</span>
                  @endif
                </td>
                <td>{{ $periodo }}</td>
                <td class="btn-group">
                  <a
                    href="./periodos/{{ $periodo->id }}/editar"
                    class="btn btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <a
                    href="./periodos/{{ $periodo->id }}/eliminar"
                    class="btn btn-danger">
                    <i class="fa fa-trash"></i>
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
