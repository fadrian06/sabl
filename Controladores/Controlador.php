<?php

declare(strict_types=1);

namespace SABL\Controladores;

abstract readonly class Controlador
{
  /** @return void|never */
  protected static function enviarErroresDeValidacionSiExisten(string $urlParaRedirigir)
  {
    if (form()->errors()) {
      response()
        ->withFlash('errores', form()->errors())
        ->withFlash('datos', request()->body())
        ->redirect($urlParaRedirigir);

      exit;
    }
  }

  /** @return void|never */
  protected static function enviarErroresDeAutenticacionSiExisten(string $urlParaRedirigir)
  {
    if (auth()->errors()) {
      response()
        ->withFlash('errores', auth()->errors())
        ->withFlash('datos', request()->body())
        ->redirect($urlParaRedirigir);

      exit;
    }
  }
}
