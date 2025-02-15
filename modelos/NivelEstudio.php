<?php

namespace SABL\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class NivelEstudio extends Model
{
  protected $table = 'nivel_estudio';
  protected $primaryKey = 'Id_Nivel_estud';
  public $timestamps = false;

  protected $fillable = ['Nom_Nivel_estd'];

  function secciones(): HasMany
  {
    return $this->hasMany(Seccion::class, 'Id_Nivel_estud', 'Id_Nivel_estud');
  }

  function puedeSerEliminado(): bool
  {
    return $this->secciones()->get()->count() === 0;
  }

  function getOrdinalAttribute(): int
  {
    return (int) $this->Nom_Nivel_estd;
  }

  function __toString(): string
  {
    return $this->Nom_Nivel_estd;
  }
}
