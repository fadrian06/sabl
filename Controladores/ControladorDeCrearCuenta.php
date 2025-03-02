<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;

final readonly class ControladorDeCrearCuenta extends Controlador
{
  use TieneValidaciones;

  static function mostrarFormulario(): void
  {
    Blade::renderizar('paginas.crear-cuenta');
  }

  static function guardarCuentaDeAdministrador(): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/crear-cuenta');

    auth()->register([
      'Cedula' => $datos['cedula'],
      'Nombres' => str_replace('  ', ' ', mb_convert_case((string) $datos['nombres'], MB_CASE_TITLE)),
      'Apellidos' => str_replace('  ', ' ', mb_convert_case((string) $datos['apellidos'], MB_CASE_TITLE)),
      'Usuario' => $datos['usuario'],
      'password' => $datos['clave'],
      'Privilegio' => 'A'
    ]);

    auth()->login([
      'Usuario' => $datos['usuario'],
      'password' => $datos['clave']
    ]);

    session()->set('id_plantel', 1);

    response()->redirect('/');
  }

  private static function validaciones(): array
  {
    return [
      'cedula' => 'number|min:1',
      'nombres' => 'names',
      'apellidos' => 'names',
      'usuario' => 'username',
      'clave' => 'password'
    ];
  }
}
