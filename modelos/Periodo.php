<?php

declare(strict_types=1);

namespace SABL\Modelos;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

final class Periodo extends Model
{
  protected $table = 'periodo';
  protected $primaryKey = 'Id_Periodo';
  public $timestamps = false;

  protected $fillable = [
    'Id_Periodo',
    'Nom_Periodo',
    'Fec_Inicio',
    'Fec_fin',
    'Número_semanas',
    'Estad_Periodo',
    'Fec_Creación',
  ];

  protected function getInicioAttribute(): DateTimeInterface
  {
    return new Date($this->Fec_Inicio);
  }

  protected function getFinAttribute(): DateTimeInterface
  {
    return new Date($this->Fec_Inicio);
  }

  function __toString(): string
  {
    return (string) $this->Nom_Periodo;
  }
}
