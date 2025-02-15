<?php

namespace SABL\Controladores;

trait TieneValidaciones
{
  final private static function obtenerDatosValidados(array $datosSinValidar): ?array
  {
    return form()->validate($datosSinValidar, self::validaciones()) ?: null;
  }

  abstract private static function validaciones(): array;
}
