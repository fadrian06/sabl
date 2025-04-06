<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property string $nombre
 * @property-read ?Municipio $municipio
 */
final class Localidad extends Model
{
  protected $table = 'localidades';
  protected $fillable = ['nombre', 'id_municipio'];
  public $timestamps = false;

  function setNombreAttribute(string $nombre): void
  {
    $this->attributes['nombre'] = mb_convert_case($nombre, MB_CASE_TITLE);
  }

  function municipio(): BelongsTo
  {
    return $this->belongsTo(Municipio::class, 'id_municipio');
  }
}
