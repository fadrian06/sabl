<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $nombre
 * @property string $inverso
 */
final class Afinidad extends Model
{
  protected $table = 'afinidades';
  protected $fillable = ['nombre', 'inverso'];
  public $timestamps = false;

  function setNombreAttribute(string $nombre): void
  {
    $this->attributes['nombre'] = mb_convert_case($nombre, MB_CASE_TITLE);
  }
}
