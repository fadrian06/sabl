<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use Leaf\Helpers\Password;
use SABL\Modelos\Usuario;

final readonly class ControladorDeUsuarios extends Controlador
{
  static function mostrarSecretarios(): void
  {
    Blade::renderizar('paginas.usuarios.listado');
  }

  static function mostrarFormularioDeRegistro(): void
  {
    Blade::renderizar('paginas.usuarios.registrar');
  }

  static function registrarSecretario(): void
  {
    $datos = form()->validate(request()->body(), [
      'cedula' => 'number|min:1',
      'nombres' => 'names',
      'apellidos' => 'names',
      'usuario' => 'username',
      'clave' => 'password'
    ]);

    self::enviarErroresDeValidacionSiExisten('/usuarios');

    $id = db()->select('seguridad', 'id')->orderBy('id')->limit(1)->column() + 1;

    (new Usuario([
      'id' => $id,
      'Cedula' => $datos['cedula'],
      'Nombres' => str_replace('  ', ' ', mb_convert_case((string) $datos['nombres'], MB_CASE_TITLE)),
      'Apellidos' => str_replace('  ', ' ', mb_convert_case((string) $datos['apellidos'], MB_CASE_TITLE)),
      'Usuario' => $datos['usuario'],
      'password' => Password::hash($datos['clave']),
      'Privilegio' => 'S'
    ]))->save();

    response()->redirect('/usuarios');
  }

  static function eliminarSecretario(int $id): void
  {
    Usuario::query()->find($id)->delete();
    response()->redirect('/usuarios');
  }

  static function mostrarFormularioDeEdicion(int $id): void
  {
    Blade::renderizar(
      'paginas.usuarios.editar',
      ['usuario' => Usuario::query()->find($id)]
    );
  }

  static function actualizarSecretario(int $id): void
  {
    $datos = form()->validate(request()->body(), [
      'cedula' => 'number|min:1',
      'nombres' => 'names',
      'apellidos' => 'names',
      'usuario' => 'username',
      'clave' => 'password'
    ]);

    self::enviarErroresDeValidacionSiExisten("/usuarios/$id/editar");

    $usuario = Usuario::query()->find($id);
    $usuario->Cedula = $datos['cedula'];
    $usuario->Nombres = $datos['nombres'];
    $usuario->Apellidos = $datos['apellidos'];
    $usuario->Usuario = $datos['usuario'];
    $usuario->password = Password::hash($datos['clave']);
    $usuario->save();
    response()->redirect('/usuarios');
  }
}
