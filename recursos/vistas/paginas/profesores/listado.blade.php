<x-plantillas.inicio titulo="Listado de profesores">
  <div class="col-md-12">
    <div class="card card-outline card-primary">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">
          Registra los profesores con sus datos especificos.
        </h3>

        <div class="card-tools">
          <a class="btn btn-info my-2" href="./profesores/registrar">
            <i class="fa fa-plus-square"></i>
            Registrar profesor
          </a>
        </div>
      </div>

      <div class="card-boby">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Cédula</th>
                <th>Nombre completo</th>
                <th>Fecha de nacimiento</th>
                <th>Código de carga</th>
                <th>Código de nómina</th>
                <th>Ingreso al ministerio</th>
                <th>Correo electrónico</th>
                <th>Teléfono</th>
              </tr>
            </thead>
            <tbody>
              @foreach($profesores as $profesor)
              <tr>
                <td>{{ $profesor->Ced_Prof }}</td>
                <td>{{ $profesor }}</td>
                <td>
                  {{ $profesor->fechaNacimiento->format('d \d\e M \d\e\l Y') }}
                </td>
                <td>{{ $profesor->Codigo_Carg_Prof }}</td>
                <td>{{ $profesor->Codigo_Domina }}</td>
                <td>
                  {{ $profesor->fechaIngresoMinisterio->format('d \d\e M \d\e\l Y') }}
                </td>
                <td>
                  <a href="mailto:{{ $profesor->Email_Prof }}">
                    {{ $profesor->Email_Prof }}
                  </a>
                </td>
                <td>
                  <a href="tel:+58{{ $profesor->Telf_Prof }}">
                    0{{ $profesor->Telf_Prof }}
                  </a>
                </td>
                <td class="btn-group">
                  <a
                    href="./profesores/{{ $profesor->Id_Prof }}/editar"
                    class="btn btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <a
                    href="./profesores/{{ $profesor->Id_Prof }}/eliminar"
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
