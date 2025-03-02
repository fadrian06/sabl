<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Momento extends Model
{
  protected $table = 'momento';
  protected $primaryKey = 'Id_Momento';
  public $timestamps = false;

  protected $fillable = [
    'Id_Momento',
    'Mes_inicio',
    'Dia_inicio',
    'Dia_inicio',
    'Numero_Momento',
    'Id_Periodo',
  ];

  function periodo(): BelongsTo
  {
    return $this->belongsTo(Periodo::class, 'Id_Periodo', 'Id_Periodo');
  }
}
