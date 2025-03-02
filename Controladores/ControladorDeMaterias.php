<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use SABL\Modelos\Materia;
use SABL\Modelos\Periodo;

final readonly class ControladorDeMaterias extends Controlador
{
  static function mostrarListado(): void
  {
    $materias = Materia::all();

    Blade::renderizar(
      'paginas.materias.listado',
      compact('materias')
    );
  }

  static function mostrarFormularioDeRegistro(): void
  {
    Blade::renderizar('paginas.materias.registrar');
  }

  static function registrar(): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/materias/registrar');

    $ultimoId = db()
      ->select('materias', 'Id_Mat')
      ->orderBy('Id_Mat')
      ->limit(1)
      ->column();

    (new Materia([
      'Id_Mat' => $ultimoId + 1,
      'Codigo_Mat' => $datos['codigo'],
      'Nom_Mat' => str_replace('  ', ' ', mb_convert_case((string) $datos['nombre'], MB_CASE_TITLE)),
      'Descripción' => str_replace('  ', ' ', mb_ucfirst($datos['descripcion'])),
      'Estado_Mat' => '',
      'Fec_Registro' => date('Y-m-d'),
      'Id_Periodo' => Periodo::query()->first()->Id_Periodo
    ]))->save();

    response()->redirect('/materias');
  }

  static function eliminar(int $id): void
  {
    Materia::query()->find($id)->delete();
    response()->redirect('/materias');
  }

  static function mostrarFormularioDeEdicion(int $id): void
  {
    Blade::renderizar(
      'paginas.materias.editar',
      ['materia' => Materia::query()->find($id)]
    );
  }

  static function actualizar(int $id): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten("/materias/$id/editar");

    $materia = Materia::query()->find($id);
    $materia->Codigo_Mat = $datos['codigo'];
    $materia->Nom_Mat = str_replace('  ', ' ', mb_convert_case((string) $datos['nombre'], MB_CASE_TITLE));
    $materia->Descripción = str_replace('  ', ' ', mb_ucfirst($datos['descripcion']));
    $materia->save();
    response()->redirect('/materias');
  }

  private static function obtenerDatosValidados(array $datosSinValidar): ?array
  {
    return form()->validate($datosSinValidar, [
      'codigo' => 'string',
      'nombre' => 'names',
      'descripcion' => 'description'
    ]) ?: null;
  }
}
