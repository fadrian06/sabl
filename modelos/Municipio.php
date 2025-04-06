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
 * @property-read ?Estado $estado
 * @property-read ?Collection<int, Localidad> $localidades
 */
final class Municipio extends Model
{
  protected $table = 'municipios';
  protected $fillable = ['nombre', 'id_estado'];
  public $timestamps = false;

  function setNombreAttribute(string $nombre): void
  {
    $this->attributes['nombre'] = mb_convert_case($nombre, MB_CASE_TITLE);
  }

  function estado(): BelongsTo
  {
    return $this->belongsTo(Estado::class, 'id_estado');
  }

  function localidades(): HasMany
  {
    return $this->hasMany(Localidad::class, 'id_municipio');
  }

  function __toString()
  {
    return $this->nombre;
  }
}
