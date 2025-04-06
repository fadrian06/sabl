<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use SABL\Modelos\Año;
use SABL\Modelos\Estudiante;
use SABL\Modelos\Periodo;
use SABL\Modelos\Plantel;

final readonly class ControladorDeReportes extends Controlador
{
  use TieneValidaciones;

  static function mostrarFormularioDeConstanciaDeEstudio(): void
  {
    Blade::renderizar('paginas/reportes/constancia-estudio/formulario', [
      'estudiantes' => Estudiante::with('localidadNacimiento')->get(),
      'años' => Año::all(),
      'periodos' => Periodo::all()
    ]);
  }

  static function generarConstanciaDeEstudio(): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/reportes/constancia-estudio');
    $estudiante = Estudiante::find($datos['estudiante']['id']);
    $año = Año::find($datos['id_año']);
    $periodo = Periodo::find($datos['id_periodo']);

    Blade::renderizar(
      'paginas/reportes/constancia-estudio/planilla',
      compact('datos', 'estudiante', 'año', 'periodo')
    );
  }

  static function mostrarFormularioDeNotasCertificadas(): void
  {
    Blade::renderizar('paginas/reportes/notas-certificadas/formulario', [
      'plantel' => Plantel::query()->findOrFail(session()->get('id_plantel')),
      'estudiantes' => Estudiante::with('planteles')->get()
    ]);
  }

  static function generarNotasCertificadas(): void {
    Blade::renderizar('paginas/reportes/notas-certificadas/planilla', [
      'plantel' => Plantel::query()->findOrFail(session()->get('id_plantel'))
    ]);
  }

  private static function validaciones(): array
  {
    return [
      'estudiante.id' => 'number',
      'fecha' => 'date',
      'id_nivel' => 'number',
      'id_periodo' => 'number'
    ];
  }
}
