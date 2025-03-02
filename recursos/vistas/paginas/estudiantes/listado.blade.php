<x-plantillas.inicio titulo="Listado de estudiantes">
  <div class="col-md-12">
    <div class="card card-outline card-primary">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">
          Registra los estudiantes con sus datos especificos.
        </h3>

        <div class="card-tools">
          <a class="btn btn-info my-2" href="./estudiantes/registrar">
            <i class="fa fa-plus-square"></i>
            Registrar estudiante
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
                <th>Representante</th>
              </tr>
            </thead>
            <tbody>
              @foreach($estudiantes as $estudiante)
              <tr>
                <td>
                  {{ $estudiante->Nacionalidad === 'venezolano' ? 'V' : 'E' }}
                  -
                  {{ $estudiante->Ced_Est }}
                </td>
                <td>{{ $estudiante }}</td>
                <td>
                  {{ $estudiante->fechaNacimiento->format('d \d\e M \d\e\l Y') }}
                </td>
                <td class="text-capitalize">{{ $estudiante->Luga_Nac }}</td>
                <td class="text-capitalize">{{ $estudiante->Dir_Exac }}</td>
                <td>
                  {{ $estudiante->representante }}
                  <sup class="badge badge-primary text-capitalize">
                    {{ $estudiante->representante->Afin_con_Est }}
                  </sup>
                </td>
                <td class="btn-group">
                  <a
                    href="./estudiantes/{{ $estudiante->Id_Est }}/editar"
                    class="btn btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <a
                    href="./estudiantes/{{ $estudiante->Id_Est }}/eliminar"
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
