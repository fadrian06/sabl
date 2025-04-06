<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use SABL\Enums\TipoNotificacion;
use SABL\Modelos\Año;
use SABL\Modelos\Periodo;
use SABL\Modelos\Seccion;

final readonly class ControladorDeAños extends Controlador
{
  static function mostrarListado(): void
  {
    Blade::renderizar('paginas.años.listado', [
      'años' => Año::all(),
      'periodos' => Periodo::all()
    ]);
  }

  static function mostrarFormularioDeEdicion(int $id): void
  {
    Blade::renderizar('paginas.años.editar', [
      'año' => Año::query()->findOrFail($id),
      'secciones' => Seccion::all()
    ]);
  }

  static function actualizar(int $id): void
  {
    $datos = request()->body();
    $año = Año::query()->findOrFail($id);
    $periodoActual = Periodo::obtenerPeriodoActual();

    db()
      ->delete('asignacion_secciones')
      ->where('id_año', $año->id)
      ->where('id_periodo', $periodoActual->id)
      ->execute();

    foreach (array_keys($datos['asignaciones'] ?? []) as $idSeccion) {
      db()
        ->insert('asignacion_secciones')
        ->params([
          'id_año' => $año->id,
          'id_seccion' => $idSeccion,
          'id_periodo' => $periodoActual->id
        ])
        ->execute();
    }

    response()
      ->withFlash(TipoNotificacion::EXITO->name, ['Año actualizado con éxito'])
      ->redirect('/años');
  }
}
