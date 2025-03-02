@php

if (!function_exists('obtenerFecha')) {
function obtenerFecha(string $rutaArchivo): string {
$rutaArchivo = str_replace(['respaldo-', '.sql'], '', $rutaArchivo);
$fecha = DateTimeImmutable::createFromFormat('Y-m-d-H-i-s', $rutaArchivo);

return (new Jenssegers\Date\Date($fecha))->ago();
}
}

@endphp

<x-plantillas.inicio titulo="Restaurar base de datos">
  <form method="post" enctype="multipart/form-data">
    <label>
      Subir archivo
      <input type="file" name="respaldo" required accept=".sql" />
    </label>
    <button class="btn btn-success">Restaurar</button>
  </form>

  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <th>Fecha</th>
        <th>Ruta de archivo</th>
      </thead>
      <tbody>
        @forelse ($rutasArchivos as $rutaArchivo)
        <tr>
          <td>{{ obtenerFecha($rutaArchivo) }}</td>
          <td>{{ basename($rutaArchivo) }}</td>
          <td>
            <a
              href="./restaurar/{{ basename($rutaArchivo) }}"
              class="btn btn-success">
              Restaurar
            </a>
            <a
              href="./respaldos/{{ basename($rutaArchivo) }}/eliminar"
              class="btn btn-danger">
              Eliminar
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="2">No hay respaldos almacenados</td>
          <td>
            <a
              onclick="location.reload()"
              href="./respaldar" target="_blank" class="btn btn-success">
              Crea uno
            </a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</x-plantillas.inicio>
