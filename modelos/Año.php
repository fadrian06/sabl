<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int $ordinal
 */
final class Año extends Model
{
  protected $table = 'años';
  protected $fillable = ['ordinal'];
  public $timestamps = false;

  function obtenerSeccionesPorPeriodo(Periodo $periodo): Collection
  {
    return $this->belongsToMany(
      Seccion::class,
      'asignacion_secciones',
      'id_año',
      'id_seccion'
    )
      ->wherePivot('id_periodo', $periodo->id)
      ->get();
  }

  function __toString()
  {
    return match ($this->ordinal) {
      1 => 'PRIMER',
      2 => 'SEGUNDO',
      3 => 'TERCER',
      4 => 'CUARTO',
      5 => 'QUINTO',
    } . ' AÑO';
  }
}
