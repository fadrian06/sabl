<?php

declare(strict_types=1);

namespace SABL\Enums;

enum CondicionVivienda: string
{
  case PROPIA = 'Propia';
  case ALQUILADA = 'Alquilada';
  case AL_CUIDO = 'Al cuido';
}
