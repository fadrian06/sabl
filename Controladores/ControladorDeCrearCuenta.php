<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use Exception;
use SABL\Enums\Nacionalidad;
use SABL\Enums\Rol;
use SABL\Enums\TipoNotificacion;
use SABL\Modelos\NivelEstudio;

final readonly class ControladorDeCrearCuenta extends Controlador
{
  use TieneValidaciones;

  static function mostrarFormulario(): void
  {
    Blade::renderizar('paginas.crear-cuenta', [
      'nivelesEstudio' => NivelEstudio::all()
    ]);
  }

  static function guardarCuentaDeAdministrador(): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/crear-cuenta');

    $nivelEstudio = NivelEstudio::query()->findOrFail($datos['nivel_estudio']);

    try {
      auth()->register([
        'nacionalidad' => Nacionalidad::from($datos['nacionalidad'])->value,
        'cedula' => $datos['cedula'],
        'nombres' => str_replace('  ', ' ', mb_convert_case((string) $datos['nombres'], MB_CASE_TITLE)),
        'apellidos' => str_replace('  ', ' ', mb_convert_case((string) $datos['apellidos'], MB_CASE_TITLE)),
        'clave' => $datos['clave'],
        'rol' => Rol::DIRECTOR->value,
        'activado' => true,
        'id_nivel_estudio' => $nivelEstudio->id
      ]);
    } catch (Exception $error) {
      self::enviarErrores([match (true) {
        str_contains($error->getMessage(), 'usuarios.nombres, usuarios.apellidos') => "Ya existe un usuario llamado {$datos['nombres']} {$datos['apellidos']}",
        default => $error->getMessage()
      }], '/crear-cuenta');
    }

    auth()->login([
      'cedula' => $datos['cedula'],
      'clave' => $datos['clave']
    ]);

    session()->set('id_plantel', 1);

    response()
      ->withFlash(
        TipoNotificacion::EXITO->name,
        ['Cuenta de director registrada exitósamente']
      )
      ->redirect('/');
  }

  private static function validaciones(): array
  {
    return [
      'cedula' => 'number|min:1',
      'nombres' => 'names',
      'apellidos' => 'names',
      'clave' => 'password',
      'nacionalidad' => 'nationality',
      'nivel_estudio' => 'number'
    ];
  }
}
