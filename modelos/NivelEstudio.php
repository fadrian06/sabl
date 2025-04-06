<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $nombre
 */
final class NivelEstudio extends Model
{
  protected $table = 'niveles_estudio';
  protected $fillable = ['nombre'];
  public $timestamps = false;

  function __toString()
  {
    return $this->nombre;
  }
}
