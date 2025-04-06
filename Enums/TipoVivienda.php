<?php

declare(strict_types=1);

namespace SABL\Enums;

enum TipoVivienda: string
{
  case CASA = 'Casa';
  case APARTAMENTO = 'Apartamento';
  case QUINTA = 'Quinta';
  case RANCHO = 'Rancho';
}
