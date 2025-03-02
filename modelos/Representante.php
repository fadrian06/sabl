<?php

declare(strict_types=1);

namespace SABL\Modelos;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Date\Date;

final class Representante extends Model
{
  protected $table = 'representante';
  protected $primaryKey = 'Id_Repres';
  public $timestamps = false;

  protected $fillable = [
    'Id_Repres',
    'Ced_Repres',
    'Apell_Repres',
    'Nom_Repres',
    'Fec_Nac',
    'Luga_Nac',
    'Nacionalidad',
    'Dir_Exac',
    'Afin_con_Est',
    'Email_Repres',
    'Telf_Repres'
  ];

  function estudiantes(): HasMany
  {
    return $this->hasMany(Estudiante::class, 'Id_Repres', 'Id_Repres');
  }

  function puedeSerEliminado(): bool
  {
    return $this->estudiantes()->get()->count() === 0;
  }

  protected function getFechaNacimientoAttribute(): DateTimeInterface
  {
    return new Date($this->Fec_Nac);
  }

  function __toString(): string
  {
    return mb_convert_case(
      "$this->Nom_Repres $this->Apell_Repres",
      MB_CASE_TITLE
    );
  }
}
