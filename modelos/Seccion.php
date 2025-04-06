<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property-read string $letra
 * @property-read ?Collection<int, Inscripcion> $inscripciones
 */
final class Seccion extends Model
{
  protected $table = 'secciones';
  protected $fillable = ['letra'];
  public $timestamps = false;

  function inscripciones(): HasMany
  {
    return $this->hasMany(Inscripcion::class, 'id_seccion');
  }

  function __toString()
  {
    return $this->letra;
  }
}
