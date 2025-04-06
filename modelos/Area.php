<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property string $nombre_corto
 * @property string $nombre_largo
 * @property bool $es_grupo_estable
 * @property-read ?self $categoria
 * @property-read ?Collection<int, self> $areas
 */
final class Area extends Model
{
  protected $table = 'areas';

  protected $fillable = [
    'nombre_corto',
    'nombre_largo',
    'es_grupo_estable',
    'id_categoria'
  ];

  public $timestamps = false;

  function categoria(): BelongsTo
  {
    return $this->belongsTo(self::class, 'id_categoria');
  }

  function areas(): HasMany
  {
    return $this->hasMany(self::class, 'id_categoria');
  }
}
