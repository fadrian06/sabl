<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Boletin extends Model
{
  protected $table = 'boletines';
  protected $primaryKey = 'Id_Boletin';
  public $timestamps = false;

  protected $fillable = [
    'Id_Boletin',
    'Id_Momento',
    'Id_Est',
    'Id_Periodo'
  ];

  function momento(): BelongsTo
  {
    return $this->belongsTo(Momento::class, 'Id_Momento', 'Id_Momento');
  }

  function estudiante(): BelongsTo
  {
    return $this->belongsTo(Estudiante::class, 'Id_Est', 'Id_Est');
  }
}
