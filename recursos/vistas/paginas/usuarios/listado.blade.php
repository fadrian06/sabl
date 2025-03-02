<x-plantillas.inicio titulo="Listado de usuarios">
  <div class="col-md-12 table-responsive">
    <div class="card card-outline card-primary">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">
          Este módulo permite a el administrador crear cuentas de acceso.
        </h3>

        <div class="card-tools">
          <a class="btn btn-info my-2" href="./usuarios/registrar">
            <i class="fa fa-plus-square"></i>
            Registrar secretario
          </a>
        </div>
      </div>

      <div class="card-boby ">
        <div class="table-responsive">
          <table class="table table-bordered table-hover  ">
            <thead>
              <tr>
                <th>ID</th>
                <th>Cédula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Usuario</th>
                <th>Privilegio</th>
              </tr>
            </thead>
            <tbody>
              @foreach(SABL\Modelos\Usuario::all() as $usuario)
              @continue($usuario->id === auth()->id())
              <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->Cedula }}</td>
                <td>{{ $usuario->Nombres }}</td>
                <td>{{ $usuario->Apellidos }}</td>
                <td>{{ $usuario->Usuario }}</td>
                <td>{{ $usuario->Privilegio === 'A' ? 'Administrador' : 'Secretario' }}</td>
                <td class="btn-group">
                  <a
                    href="./usuarios/{{ $usuario->id }}/editar"
                    class="btn btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <a
                    href="./usuarios/{{ $usuario->id }}/eliminar"
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
