<?php

declare(strict_types=1);

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;

final class Materia extends Model
{
  protected $primaryKey = 'Id_Mat';
  public $timestamps = false;

  protected $fillable = [
    'Id_Mat',
    'Codigo_Mat',
    'Nom_Mat',
    'Descripción',
    'Estado_Mat',
    'Fec_Registro',
    'Id_Periodo'
  ];

  function __toString(): string
  {
    return (string) $this->Nom_Mat;
  }
}
