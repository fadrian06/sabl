<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use DateTimeImmutable;
use SABL\Modelos\Periodo;

final readonly class ControladorDePeriodos extends Controlador
{
  use TieneValidaciones;

  static function mostrarListado(): void
  {
    $periodos = Periodo::with('lapsos')->get();

    Blade::renderizar(
      'paginas.periodos.listado',
      compact('periodos')
    );
  }

  static function mostrarFormularioDeRegistro(): void
  {
    Blade::renderizar('paginas.periodos.registrar');
  }

  static function registrar(): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/periodos/aperturar');

    $ultimoId = db()
      ->select('periodo', 'Id_Periodo')
      ->orderBy('Id_Periodo')
      ->limit(1)
      ->column();

    (new Periodo([
      'Id_Periodo' => $ultimoId + 1,
      'Nom_Periodo' => (new DateTimeImmutable($datos['inicio']))->format('Y') . '-' . (new DateTimeImmutable($datos['fin']))->format('Y'),
      'Fec_Inicio' => $datos['inicio'],
      'Fec_fin' => $datos['fin'],
      'Estad_Periodo' => '',
      'Fec_Creación' => date('Y-m-d')
    ]))->save();

    response()->redirect('/periodos');
  }

  static function eliminar(int $id): void
  {
    Periodo::query()->find($id)->delete();
    response()->redirect('/periodos');
  }

  static function mostrarFormularioDeEdicion(int $id): void
  {
    Blade::renderizar(
      'paginas.periodos.editar',
      ['periodo' => Periodo::query()->find($id)]
    );
  }

  static function actualizar(int $id): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten("/periodos/$id/editar");

    $periodo = Periodo::query()->findOrFail($id);
    $periodo->año_inicio = $datos['año_inicio'];
    $periodo->save();

    response()->redirect('/periodos');
  }

  private static function validaciones(): array {
    return [
      'año_inicio' => 'number|min:1'
    ];
  }
}
