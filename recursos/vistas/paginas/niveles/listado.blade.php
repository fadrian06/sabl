<x-plantillas.inicio titulo="Listado de niveles">
  <div class="col-md-12">
    <div class="card card-outline card-primary">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">
          Apertura los años con sus datos especificos.
        </h3>

        <div class="card-tools">
          <a class="btn btn-info my-2" href="./niveles/aperturar">
            <i class="fa fa-plus-square"></i>
            Aperturar año
          </a>
        </div>
      </div>

      <div class="card-boby">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Año</th>
                <th>Secciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($niveles as $nivel)
              <tr>
                <td>{{ $nivel }}</td>
                <td>
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Sección</th>
                        <th>Matrículas</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($nivel->secciones as $seccion)
                      <tr>
                        <td>{{ $seccion }}</td>
                        <td>{{ $seccion->Numero_matriculas }}</td>
                        <td class="btn-group">
                          <a
                            href="./secciones/{{ $seccion->Id_Seccion }}/editar"
                            class="btn btn-primary">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a
                            href="./secciones/{{ $seccion->Id_Seccion }}/eliminar"
                            class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="2">
                          <a
                            href="./niveles/{{ $nivel->Id_Nivel_estud }}/secciones/aperturar"
                            class="btn btn-primary w-100">
                            Aperturar sección
                          </a>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                  <ul>
                  </ul>
                </td>
                <td class="btn-group">
                  <a
                    href="./niveles/{{ $nivel->Id_Nivel_estud }}/editar"
                    class="btn btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  @if ($nivel->puedeSerEliminado())
                  <a
                    href="./niveles/{{ $nivel->Id_Nivel_estud }}/eliminar"
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
