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
                <th>Período</th>
                <th>Inicia</th>
                <th>Termina</th>
                <th># de semanas</th>
              </tr>
            </thead>
            <tbody>
              @foreach($periodos as $periodo)
              <tr>
                <td>{{ $periodo }}</td>
                <td>{{ $periodo->inicio->format('d \d\e M \d\e\l Y') }}</td>
                <td>{{ $periodo->fin->format('d \d\e M \d\e\l Y') }}</td>
                <td>{{ $periodo->Número_semanas }}</td>
                <td class="btn-group">
                  <a
                    href="./periodos/{{ $periodo->Id_Periodo }}/editar"
                    class="btn btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <a
                    href="./periodos/{{ $periodo->Id_Periodo }}/eliminar"
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
