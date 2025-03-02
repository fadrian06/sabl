<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use SABL\Modelos\Estudiante;
use SABL\Modelos\NivelEstudio;
use SABL\Modelos\Periodo;

final readonly class ControladorDeReportes extends Controlador
{
  use TieneValidaciones;

  static function mostrarFormularioDeConstanciaDeEstudio(): void
  {
    Blade::renderizar('paginas/reportes/constancia-estudio/formulario', [
      'estudiantes' => Estudiante::all(),
      'niveles' => NivelEstudio::all(),
      'periodos' => Periodo::all()
    ]);
  }

  static function generarConstanciaDeEstudio(): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/reportes/constancia-estudio');
    $estudiante = Estudiante::find($datos['estudiante']['id']);
    $nivel = NivelEstudio::find($datos['id_nivel']);
    $periodo = Periodo::find($datos['id_periodo']);

    Blade::renderizar(
      'paginas/reportes/constancia-estudio/planilla',
      compact('datos', 'estudiante', 'nivel', 'periodo')
    );
  }

  static function mostrarNotasCertificadas(): void
  {
    Blade::renderizar('paginas/reportes/notas-certificadas');
  }

  private static function validaciones(): array
  {
    return [
      'subscribe.nivel' => 'string',
      'subscribe.nombre' => 'names',
      'subscribe.nacionalidad' => 'string|min:1|max:1',
      'subscribe.cedula' => 'number|min:1',
      'estudiante.id' => 'number',
      'estudiante.nacionalidad' => 'string|min:1|max:1',
      'estudiante.cedula' => 'number|min:1',
      'estudiante.estado_nacimiento' => 'names',
      'fecha' => 'date',
      'id_nivel' => 'number',
      'id_periodo' => 'number'
    ];
  }
}
