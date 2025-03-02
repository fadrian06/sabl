<x-plantillas.inicio titulo="Listado de materias">
  <div class="col-md-12">
    <div class="card card-outline card-primary">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">
          Apertura las materias con sus datos especificos.
        </h3>

        <div class="card-tools">
          <a class="btn btn-info my-2" href="./materias/aperturar">
            <i class="fa fa-plus-square"></i>
            Aperturar materia
          </a>
        </div>
      </div>

      <div class="card-boby">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
              </tr>
            </thead>
            <tbody>
              @foreach($materias as $materia)
              <tr>
                <td>{{ $materia->Codigo_Mat }}</td>
                <td>{{ $materia }}</td>
                <td>{{ $materia->Descripción }}</td>
                <td class="btn-group">
                  <a
                    href="./materias/{{ $materia->Id_Mat }}/editar"
                    class="btn btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <a
                    href="./materias/{{ $materia->Id_Mat }}/eliminar"
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
