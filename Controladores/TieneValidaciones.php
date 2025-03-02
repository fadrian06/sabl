<?php

declare(strict_types=1);

namespace SABL\Controladores;

trait TieneValidaciones
{
  private static function obtenerDatosValidados(array $datosSinValidar): ?array
  {
    return form()->validate($datosSinValidar, self::validaciones()) ?: null;
  }

  abstract private static function validaciones(): array;
}
