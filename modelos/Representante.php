<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property 'V'|'E' $nacionalidad
 * @property int $cedula
 * @property string $fecha_nacimiento
 * @property string $nombres
 * @property string $apellidos
 * @property string $direccion_exacta
 * @property string $correo
 * @property string $telefono_movil
 * @property string $telefono_casa
 * @property string $telefono_trabajo
 * @property-read ?Localidad $localidadNacimiento
 * @property-read ?Collection<int, Estudiante> $estudiantes
 */
final class Representante extends Model
{
  protected $table = 'representantes';

  protected $fillable = [
    'nacionalidad',
    'cedula',
    'fecha_nacimiento',
    'nombres',
    'apellidos',
    'direccion_exacta',
    'correo',
    'telefono_movil',
    'telefono_casa',
    'telefono_trabajo',
    'id_localidad_nacimiento'
  ];

  public $timestamps = false;

  function setNombresAttribute(string $nombres): void
  {
    $this->attributes['nombres'] = mb_convert_case($nombres, MB_CASE_TITLE);
  }

  function setApellidosAttribute(string $apellidos): void
  {
    $this->attributes['apellidos'] = mb_convert_case($apellidos, MB_CASE_TITLE);
  }

  function localidadNacimiento(): BelongsTo
  {
    return $this->belongsTo(Localidad::class, 'id_localidad_nacimiento');
  }

  function estudiantes(): HasMany
  {
    return $this->hasMany(Estudiante::class, 'id_representante');
  }
}
