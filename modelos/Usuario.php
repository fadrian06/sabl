<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;
use SABL\Enums\Rol;

/**
 * @property-read int $id
 * @property 'Director'|'Secretario'|'Coordinador'|'Docente' $rol
 * @property 'V'|'E' $nacionalidad
 * @property int $cedula
 * @property string $nombres
 * @property string $apellidos
 * @property bool $activado
 * @property-read ?NivelEstudio $nivelEstudio
 */
final class Usuario extends Model
{
  protected $table = 'usuarios';

  protected $fillable = [
    'rol',
    'nacionalidad',
    'cedula',
    'nombres',
    'apellidos',
    'clave',
    'activado',
    'id_nivel_estudio'
  ];

  public $timestamps = false;
  protected $hidden = ['clave'];

  static function hayDirectores(): bool
  {
    return self::query()->where('rol', Rol::DIRECTOR)->get()->count() >= 1;
  }

  function nivelEstudio()
  {
    return $this->belongsTo(NivelEstudio::class, 'id_nivel_estudio');
  }

  function getNombreCompletoAttribute(): string
  {
    return "{$this->nombres} {$this->apellidos}";
  }
}
