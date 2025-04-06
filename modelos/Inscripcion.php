<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property string $fecha
 * @property-read ?Estudiante $estudiante
 * @property-read ?Seccion $seccion
 * @property-read ?Periodo $periodo
 */
final class Inscripcion extends Model
{
  protected $table = 'inscripciones';

  protected $fillable = [
    'fecha',
    'id_estudiante',
    'id_seccion',
    'id_periodo'
  ];

  public $timestamps = false;

  function estudiante(): BelongsTo
  {
    return $this->belongsTo(Estudiante::class, 'id_estudiante');
  }

  function seccion(): BelongsTo
  {
    return $this->belongsTo(Seccion::class, 'id_seccion');
  }

  function periodo(): BelongsTo
  {
    return $this->belongsTo(Periodo::class, 'id_periodo');
  }
}
