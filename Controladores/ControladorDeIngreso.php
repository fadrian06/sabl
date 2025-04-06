<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;

final readonly class ControladorDeIngreso extends Controlador
{
  use TieneValidaciones;

  static function mostrarIngreso(): void
  {
    Blade::renderizar('paginas.ingreso');
  }

  static function comprobarCredenciales(): void
  {
    $credenciales = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/ingreso');

    auth()->login([
      'cedula' => $credenciales['cedula'],
      'clave' => $credenciales['clave']
    ]);

    self::enviarErroresDeAutenticacionSiExisten('/ingreso');

    session()->set('id_plantel', 1);
    response()->redirect('/');
  }

  private static function validaciones(): array {
    return [
      'cedula' => 'number|min:1',
      'clave' => 'password'
    ];
  }
}
