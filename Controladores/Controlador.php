<?php

declare(strict_types=1);

namespace SABL\Controladores;

use SABL\Enums\TipoNotificacion;

abstract readonly class Controlador
{
  /** @return void|never */
  protected static function enviarErroresDeValidacionSiExisten(string $urlParaRedirigir)
  {
    if (form()->errors()) {
      self::enviarErrores(form()->errors(), $urlParaRedirigir);
    }
  }

  /** @return void|never */
  protected static function enviarErroresDeAutenticacionSiExisten(string $urlParaRedirigir)
  {
    if (auth()->errors()) {
      self::enviarErrores(auth()->errors(), $urlParaRedirigir);
    }
  }

  protected static function enviarErrores(
    array $errores,
    string $urlParaRedirigir
  ): never {
    response()
      ->withFlash(TipoNotificacion::ERROR->name, $errores)
      ->withFlash('datos', request()->body())
      ->redirect($urlParaRedirigir);

    exit;
  }
}
