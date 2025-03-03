<?php

declare(strict_types=1);

namespace SABL\Enums;

enum Rol: string
{
  case DIRECTOR = 'Director';
  case COORDINADOR = 'Coordinador';
  case DOCENTE = 'Docente';
  case SECRETARIO = 'Secretario';
}
