<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property 'V'|'E' $nacionalidad
 * @property int $cedula
 * @property string $fecha_nacimiento
 * @property string $nombres
 * @property string $apellidos
 * @property string $direccion_exacta
 * @property 'Casa'|'Quinta'|'Apartamento'|'Rancho' $tipo_vivienda
 * @property 'Propia'|'Alquilada'|'Al cuido' $condicion_vivienda
 * @property 'Buena'|'Regular'|'Mala' $condicion_infrastructura_vivienda
 * @property ?string $tipo_beca
 * @property bool $posee_canaima
 * @property-read ?Localidad $localidadNacimiento
 * @property-read ?Representante $representante
 * @property-read ?Afinidad $afinidadRepresentante
 * @property-read ?Collection<int, Plantel> $plantelesCursados
 * @property-read ?Collection<int, Inscripcion> $inscripciones
 * @property-read ?Collection<int, Calificacion> $calificaciones
 */
final class Estudiante extends Model
{
  protected $table = 'estudiantes';

  protected $fillable = [
    'nacionalidad',
    'cedula',
    'fecha_nacimiento',
    'nombres',
    'apellidos',
    'direccion_exacta',
    'tipo_vivienda',
    'condicion_vivienda',
    'condicion_infrastructura_vivienda',
    'tipo_beca',
    'posee_canaima',
    'id_localidad_nacimiento',
    'id_representante',
    'id_afinidad_representante',
  ];

  public $timestamps = false;

  function localidadNacimiento(): BelongsTo
  {
    return $this->belongsTo(Localidad::class, 'id_localidad_nacimiento');
  }

  function representante(): BelongsTo
  {
    return $this->belongsTo(Representante::class, 'id_representante');
  }

  function afinidadRepresentante(): BelongsTo
  {
    return $this->belongsTo(Afinidad::class, 'id_afinidad_representante');
  }

  function plantelesCursados(): BelongsToMany
  {
    return $this->belongsToMany(
      Plantel::class,
      'planteles_cursados',
      'id_estudiante',
      'id_plantel'
    );
  }

  function inscripciones(): HasMany
  {
    return $this->hasMany(Inscripcion::class, 'id_estudiante');
  }

  function calificaciones(): HasMany
  {
    return $this->hasMany(Calificacion::class, 'id_estudiante');
  }
}
