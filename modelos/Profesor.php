<?php

declare(strict_types=1);

namespace SABL\Modelos;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

final class Profesor extends Model
{
  protected $table = 'profesor';
  protected $primaryKey = 'Id_Prof';
  public $timestamps = false;

  protected $fillable = [
    'Id_Prof',
    'Ced_Prof',
    'Nom_Prof',
    'Apell_Prof',
    'Fec_Nac',
    'Codigo_Carg_Prof',
    'Codigo_Domina',
    'Fec_Incres_T_Minis',
    'Email_Prof',
    'Telf_Prof',
    'Fec_Registro'
  ];

  protected function getFechaNacimientoAttribute(): DateTimeInterface
  {
    return new Date($this->Fec_Nac);
  }

  protected function getFechaIngresoMinisterioAttribute(): DateTimeInterface
  {
    return new Date($this->Fec_Incres_T_Minis);
  }

  function __toString(): string
  {
    return mb_convert_case(
      "$this->Nom_Prof $this->Apell_Prof",
      MB_CASE_TITLE
    );
  }
}
