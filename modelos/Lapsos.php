<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int $ordinal
 */
final class Lapso extends Model
{
  protected $table = 'lapsos';
  protected $fillable = ['ordinal'];
  public $timestamps = false;
}
