<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use SABL\Modelos\NivelEstudio;
use SABL\Modelos\Seccion;

final readonly class ControladorDeNiveles extends Controlador
{
  use TieneValidaciones;

  static function mostrarListado(): void
  {
    $niveles = NivelEstudio::with('secciones')->get();

    Blade::renderizar('paginas/niveles/listado', compact('niveles'));
  }

  static function mostrarFormularioDeRegistro(): void
  {
    $ultimoNivel = self::obtenerUltimoNivel();

    Blade::renderizar('paginas/niveles/registrar', compact('ultimoNivel'));
  }

  static function registrar(): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/niveles/registrar');

    (new NivelEstudio(['Nom_Nivel_estd' => "{$datos['nombre']}° año"]))->save();

    response()->redirect('/niveles');
  }

  static function eliminar(int $id): void
  {
    NivelEstudio::query()->where('Id_Nivel_estud', $id)?->delete();
    response()->redirect('/niveles');
  }

  static function mostrarFormularioDeEdicion(int $id): void
  {
    $nivel = NivelEstudio::find($id);
    $ultimoNivel = self::obtenerUltimoNivel();

    Blade::renderizar('paginas/niveles/editar', compact('nivel', 'ultimoNivel'));
  }

  static function actualizar(int $id): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten("/niveles/$id/editar");

    $nivel = NivelEstudio::find($id);
    $nivel->Nom_Nivel_estd = "{$datos['nombre']}° año";
    $nivel->save();

    response()->redirect('/niveles');
  }

  static function mostrarFormularioDeRegistroDeSeccion(int $id): void
  {
    $nivel = NivelEstudio::find($id);

    Blade::renderizar('paginas/secciones/registrar', compact('nivel'));
  }

  static function registrarSeccion(int $id): void
  {
    $datos = form()->validate(request()->body(), [
      'nombre' => 'string|min:1|max:1',
      'matriculas' => 'number|min:1'
    ]);

    self::enviarErroresDeValidacionSiExisten("/niveles/$id/secciones/aperturar");

    $nivel = NivelEstudio::with('secciones')->find($id);

    $nivel->secciones()->create([
      'Nom_Seccion' => strtoupper((string) $datos['nombre']),
      'Estad_Seccion' => 'activo',
      'Fec_Creacion' => date('Y-m-d-H-i-s'),
      'Numero_matriculas' => (int) $datos['matriculas'],
      'Id_Periodo' => 1
    ]);

    response()->redirect('/niveles');
  }

  static function mostrarFormularioDeEdicionDeSeccion(int $id): void
  {
    $seccion = Seccion::find($id);

    Blade::renderizar('paginas/secciones/editar', compact('seccion'));
  }

  static function actualizarSeccion(int $id): void
  {
    $datos = form()->validate(request()->body(), [
      'nombre' => 'string|min:1|max:1',
      'matriculas' => 'number|min:1'
    ]);

    self::enviarErroresDeValidacionSiExisten("/secciones/$id/editar");

    $seccion = Seccion::find($id);
    $seccion->Nom_Seccion = strtoupper((string) $datos['nombre']);
    $seccion->Numero_matriculas = (int) $datos['matriculas'];
    $seccion->save();

    response()->redirect('/niveles');
  }

  static function eliminarSeccion(int $id): void
  {
    Seccion::query()->where('Id_Seccion', $id)?->delete();
    response()->redirect('/niveles');
  }

  private static function obtenerUltimoNivel(): int
  {
    return NivelEstudio::query()->latest('Id_Nivel_estud')->first()?->ordinal ?? 0;
  }

  private static function validaciones(): array
  {
    return [
      'nombre' => 'number|min:1|max:' . (self::obtenerUltimoNivel() + 1)
    ];
  }
}
