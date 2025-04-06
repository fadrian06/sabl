<?php

declare(strict_types=1);

namespace SABL\Enums;

enum TipoNotificacion: string
{
  case ERROR = 'error';
  case EXITO = 'success';
  case ADVERTENCIA = 'warning';
}
