<x-plantillas.inicio titulo="Listado de representantes">
  <div class="col-md-12">
    <div class="card card-outline card-primary">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">
          Registra los representantes con sus datos especificos.
        </h3>

        <div class="card-tools">
          <a class="btn btn-info my-2" href="./representantes/registrar">
            <i class="fa fa-plus-square"></i>
            Registrar representante
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
                <th>Lugar de nacimiento</th>
                <th>Dirección</th>
                <th>Correo electrónico</th>
                <th>Teléfono</th>
                <th>Estudiantes</th>
              </tr>
            </thead>
            <tbody>
              @foreach($representantes as $representante)
              <tr>
                <td>
                  {{ $representante->Nacionalidad === 'venezolano' ? 'V' : 'E' }}
                  -
                  {{ $representante->Ced_Repres }}
                </td>
                <td>{{ $representante }}</td>
                <td>
                  {{ $representante->fechaNacimiento->format('d \d\e M \d\e\l Y') }}
                </td>
                <td class="text-capitalize">{{ $representante->Luga_Nac }}</td>
                <td class="text-capitalize">{{ $representante->Dir_Exac }}</td>
                <td>
                  <a href="mailto:{{ $representante->Email_Repres }}">
                    {{ $representante->Email_Repres }}
                  </a>
                </td>
                <td>
                  <a href="tel:+58{{ $representante->Telf_Repres }}">
                    0{{ $representante->Telf_Repres }}
                  </a>
                </td>
                <td>
                  <ul>
                    @foreach ($representante->estudiantes as $estudiante)
                    <li>{{ $estudiante }}</li>
                    @endforeach
                  </ul>
                </td>
                <td class="btn-group">
                  <a
                    href="./representantes/{{ $representante->Id_Repres }}/editar"
                    class="btn btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  @if ($representante->puedeSerEliminado())
                  <a
                    href="./representantes/{{ $representante->Id_Repres }}/eliminar"
                    class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                  </a>
                  @endif
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
