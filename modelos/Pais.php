<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property string $nombre
 * @property-read ?Collection<int, Estado> $estados
 */
final class Pais extends Model
{
  protected $table = 'paises';
  protected $fillable = ['nombre'];
  public $timestamps = false;

  function setNombreAttribute(string $nombre): void
  {
    $this->attributes['nombre'] = mb_convert_case($nombre, MB_CASE_TITLE);
  }

  function estados(): HasMany
  {
    return $this->hasMany(Estado::class, 'id_pais');
  }
}
