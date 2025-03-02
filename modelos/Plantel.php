<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Plantel extends Model
{
  protected $table = 'planteles';

  function estudiantes(): BelongsToMany
  {
    return $this->belongsToMany(
      Estudiante::class,
      'planteles_cursados',
      'id_plantel',
      'id_estudiante'
    );
  }
}
