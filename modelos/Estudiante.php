<?php

declare(strict_types=1);

namespace SABL\Modelos;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Date\Date;

final class Estudiante extends Model
{
  protected $table = 'estudiante';
  protected $primaryKey = 'Id_Est';
  public $timestamps = false;

  protected $fillable = [
    'Id_Est',
    'Ced_Est',
    'Nom_Est',
    'Apell_Est',
    'Fec_Nac',
    'Luga_Nac',
    'Nacionalidad',
    'Dir_Exac',
    'Id_Repres'
  ];

  function boletines(): HasMany
  {
    return $this->hasMany(Boletin::class, 'Id_Est', 'Id_Est');
  }

  function representante(): BelongsTo
  {
    return $this->belongsTo(Representante::class, 'Id_Repres', 'Id_Repres');
  }

  protected function getFechaNacimientoAttribute(): DateTimeInterface
  {
    return new Date($this->Fec_Nac);
  }

  function __toString(): string
  {
    return mb_convert_case("$this->Nom_Est $this->Apell_Est", MB_CASE_TITLE);
  }
}
