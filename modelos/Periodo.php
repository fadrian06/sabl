<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property int $año_inicio
 * @property-read ?Collection<int, Inscripcion> $inscripciones
 */
final class Periodo extends Model
{
  protected $table = 'periodos';
  protected $fillable = ['año_inicio'];
  public $timestamps = false;

  function inscripciones(): HasMany
  {
    return $this->hasMany(Inscripcion::class, 'id_periodo');
  }

  static function obtenerPeriodoActual(): ?self
  {
    return self::query()->where('año_inicio', date('Y'))->first();
  }

  function __toString()
  {
    return $this->año_inicio . '-' . ($this->año_inicio + 1);
  }
}
