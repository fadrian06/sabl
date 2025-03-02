<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use Leaf\Helpers\Password;

final readonly class ControladorDePerfil extends Controlador
{
  static function mostrarFormularioDeEdicion(): void
  {
    Blade::renderizar(
      'paginas.perfil.editar',
      ['usuario' => auth()->user()]
    );
  }

  static function actualizarPerfil(): void
  {
    $datos = form()->validate(request()->body(), [
      'cedula' => 'number|min:1',
      'nombres' => 'names',
      'apellidos' => 'names',
      'usuario' => 'username',
      'clave' => 'password'
    ]);

    self::enviarErroresDeValidacionSiExisten('/');

    auth()->update([
      'Cedula' => $datos['cedula'],
      'Nombres' => str_replace('  ', ' ', mb_convert_case((string) $datos['nombres'], MB_CASE_TITLE)),
      'Apellidos' => str_replace('  ', ' ', mb_convert_case((string) $datos['apellidos'], MB_CASE_TITLE)),
      'Usuario' => $datos['usuario'],
      'password' => Password::hash($datos['clave']),
    ]);

    self::enviarErroresDeAutenticacionSiExisten('/');

    response()->redirect('/');
  }
}
