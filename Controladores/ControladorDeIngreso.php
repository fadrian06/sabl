<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;

final readonly class ControladorDeIngreso extends Controlador
{
  static function mostrarIngreso(): void
  {
    Blade::renderizar('paginas.ingreso');
  }

  static function comprobarCredenciales(): void
  {
    $credenciales = form()->validate(request()->body(), [
      'usuario' => 'username',
      'clave' => 'password'
    ]);

    self::enviarErroresDeValidacionSiExisten('/ingreso');

    auth()->login([
      'usuario' => $credenciales['usuario'],
      'password' => $credenciales['clave']
    ]);

    self::enviarErroresDeAutenticacionSiExisten('/ingreso');
    response()->redirect('/');
  }
}
