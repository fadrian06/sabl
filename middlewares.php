<?php

declare(strict_types=1);

use SABL\Modelos\Usuario;

auth()->middleware('auth.required', static function (): void {
  if (!auth()->user()) {
    response()->redirect('/ingreso');
  }
});

auth()->middleware('auth.guest', static function (): void {
  if (auth()->user()) {
    response()->redirect('/');
  }
});

app()->registerMiddleware('admin.only-one', static function (): void {
  if (Usuario::cantidadDeAdministradores() > 0) {
    response()
      ->withFlash('errores', ['Ya existe un administrador, no puedes crear otro'])
      ->redirect('/ingreso');
  }
});

app()->registerMiddleware('only-admins', static function (): void {
  if (auth()->user()?->Privilegio !== 'A') {
    response()
      ->withFlash('errores', ['Acceso denegado, debes ser administrador para continuar'])
      ->redirect('/');
  }
});
