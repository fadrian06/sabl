<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read int $id
 * @property string $codigo
 * @property string $nombre_corto
 * @property string $nombre_largo
 * @property string $direccion_exacta
 * @property string $telefono
 * @property bool $es_principal
 * @property int $año_fundacion
 * @property-read ?PlanEstudio $planEstudio
 * @property-read ?Localidad $localidad
 * @property-read ?Collection<int, Estudiante> $estudiantes
 */
final class Plantel extends Model
{
  protected $table = 'planteles';

  protected $fillable = [
    'codigo',
    'nombre_corto',
    'nombre_largo',
    'direccion_exacta',
    'telefono',
    'es_principal',
    'año_fundacion',
    'id_localidad',
    'id_plan_estudio'
  ];

  public $timestamps = false;

  function setCodigoAttribute(string $codigo): void
  {
    $this->attributes['codigo'] = mb_strtoupper(str_replace(' ', '', $codigo));
  }

  function setNombreCortoAttribute(string $nombreCorto): void
  {
    $nombreCorto = str_replace(' ', '', $nombreCorto);

    $this->attributes['nombre_corto'] = mb_strtoupper($nombreCorto);
  }

  function setNombreLargoAttribute(string $nombreLargo): void
  {
    $nombreLargo = str_replace(' ', '', $nombreLargo);

    $this->attributes['nombre_largo'] = mb_strtoupper($nombreLargo);
  }

  function setDireccionExactaAttribute(string $direccionExacta): void
  {
    $direccionExacta = str_replace('  ', ' ', $direccionExacta);
    $direccionExacta = mb_convert_case($direccionExacta, MB_CASE_TITLE);

    $this->attributes['direccion_exacta'] = $direccionExacta;
  }

  function planEstudio(): BelongsTo
  {
    return $this->belongsTo(PlanEstudio::class, 'id_plan_estudio');
  }

  function localidad(): BelongsTo
  {
    return $this->belongsTo(Localidad::class, 'id_localidad');
  }

  function estudiantes(): BelongsToMany
  {
    return $this->belongsToMany(
      Estudiante::class,
      'planteles_cursados',
      'id_plantel',
      'id_estudiante'
    );
  }

  static function obtenerPlantelPrincipal(): ?self
  {
    return self::query()->where('es_principal', true)->first();
  }
}
