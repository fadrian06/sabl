<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property string $nombre
 * @property-read bool $tiene_zona_educativa
 * @property-read ?Pais $pais
 * @property-read ?Collection<int, Municipio> $municipios
 */
final class Estado extends Model
{
  protected $table = 'estados';
  protected $fillable = ['nombre', 'tiene_zona_educativa', 'id_pais'];
  public $timestamps = false;

  protected $attributes = [
    'tiene_zona_educativa' => false,
  ];

  function setNombreAttribute(string $nombre): void
  {
    $this->attributes['nombre'] = mb_convert_case($nombre, MB_CASE_TITLE);
  }

  function pais(): BelongsTo
  {
    return $this->belongsTo(Pais::class, 'id_pais');
  }

  function municipios(): HasMany
  {
    return $this->hasMany(Municipio::class, 'id_estado');
  }

  function __toString()
  {
    return $this->nombre;
  }
}
