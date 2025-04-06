<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property ?int $definitiva
 * @property null|'A'|'B'|'C'|'D'|'E'|'F' $literal
 * @property int $inasistencias
 * @property-read ?Periodo $periodo
 * @property-read ?Lapso $lapso
 * @property-read ?Estudiante $estudiante
 * @property-read ?Año $año
 * @property-read ?Area $area
 * @property-read ?Plantel $plantel
 */
final class Calificacion extends Model
{
  protected $table = 'calificaciones';

  protected $fillable = [
    'definitiva',
    'literal',
    'inasistencias',
    'id_periodo',
    'id_lapso',
    'id_estudiante',
    'id_año',
    'id_area',
    'id_plantel',
  ];

  public $timestamps = false;

  function periodo(): BelongsTo
  {
    return $this->belongsTo(Periodo::class, 'id_periodo');
  }

  function lapso(): BelongsTo
  {
    return $this->belongsTo(Lapso::class, 'id_lapso');
  }

  function estudiante(): BelongsTo
  {
    return $this->belongsTo(Estudiante::class, 'id_estudiante');
  }

  function año(): BelongsTo
  {
    return $this->belongsTo(Año::class, 'id_año');
  }

  function area(): BelongsTo
  {
    return $this->belongsTo(Area::class, 'id_area');
  }

  function plantel(): BelongsTo
  {
    return $this->belongsTo(Plantel::class, 'id_plantel');
  }
}
