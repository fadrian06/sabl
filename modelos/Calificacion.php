<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Calificacion extends Model
{
  protected $table = 'calificaciones';
  protected $primaryKey = 'Id_Calif';
  public $timestamps = false;

  protected $fillable = [
    'Id_Calif',
    'Calif_obtenid',
    'Fec_Registro',
    'Id_Mat',
    'Id_Boletin',
    'Id_Periodo',
    'Id_usuario'
  ];

  function materia(): BelongsTo
  {
    return $this->belongsTo(Materia::class, 'Id_Mat', 'Id_Mat');
  }

  function boletin(): BelongsTo
  {
    return $this->belongsTo(Boletin::class, 'Id_Boletin', 'Id_Boletin');
  }

  function __toString(): string
  {
    return (string) $this->Calif_obtenid;
  }
}
