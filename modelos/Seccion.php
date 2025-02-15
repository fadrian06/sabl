<?php

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Seccion extends Model
{
  protected $table = 'sección';
  protected $primaryKey = 'Id_Seccion';
  public $timestamps = false;

  protected $fillable = [
    'Nom_Seccion',
    'Estad_Seccion',
    'Fec_Creacion',
    'Numero_matriculas',
    'Id_Periodo'
  ];

  function __toString(): string
  {
    return $this->Nom_Seccion;
  }
}
