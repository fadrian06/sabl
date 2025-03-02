<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use SABL\Modelos\Representante;

final readonly class ControladorDeRepresentantes extends Controlador
{
  static function mostrarListado(): void
  {
    $representantes = Representante::with('estudiantes')->get();

    Blade::renderizar(
      'paginas.representantes.listado',
      compact('representantes')
    );
  }

  static function mostrarFormularioDeRegistro(): void
  {
    Blade::renderizar('paginas.representantes.registrar');
  }

  static function registrar(): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/representantes/registrar');

    $ultimoId = db()
      ->select('representante', 'Id_Repres')
      ->orderBy('Id_Repres')
      ->limit(1)
      ->column();

    (new Representante([
      'Id_Repres' => $ultimoId + 1,
      'Ced_Repres' => $datos['cedula'],
      'Nom_Repres' => str_replace('  ', ' ', mb_convert_case((string) $datos['nombres'], MB_CASE_TITLE)),
      'Apell_Est' => str_replace('  ', ' ', mb_convert_case((string) $datos['apellidos'], MB_CASE_TITLE)),
      'Fec_Nac' => $datos['fechaNacimiento'],
      'Luga_Nac' => str_replace('  ', ' ', mb_convert_case((string) $datos['lugarNacimiento'], MB_CASE_TITLE)),
      'Nacionalidad' => $datos['nacionalidad'],
      'Dir_Exac' => str_replace('  ', ' ', mb_convert_case((string) $datos['direccion'], MB_CASE_TITLE)),
      'Afin_con_Est' => str_replace('  ', ' ', mb_convert_case((string) $datos['afinidadConEstudiante'], MB_CASE_TITLE)),
      'Email_Repres' => $datos['correo'],
      'Telf_Repres' => $datos['telefono']
    ]))->save();

    response()->redirect('/representantes');
  }

  static function eliminar(int $id): void
  {
    Representante::query()->find($id)->delete();
    response()->redirect('/representantes');
  }

  static function mostrarFormularioDeEdicion(int $id): void
  {
    Blade::renderizar(
      'paginas.representantes.editar',
      ['representante' => Representante::query()->find($id)]
    );
  }

  static function actualizar(int $id): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten("/representantes/$id/editar");

    $representante = Representante::query()->find($id);
    $representante->Nacionalidad = $datos['nacionalidad'];
    $representante->Ced_Repres = $datos['cedula'];
    $representante->Nom_Repres = str_replace('  ', ' ', mb_convert_case((string) $datos['nombres'], MB_CASE_TITLE));
    $representante->Apell_Repres = str_replace('  ', ' ', mb_convert_case((string) $datos['apellidos'], MB_CASE_TITLE));
    $representante->Fec_Nac = $datos['fechaNacimiento'];
    $representante->Luga_Nac = str_replace('  ', ' ', mb_convert_case((string) $datos['lugarNacimiento'], MB_CASE_TITLE));
    $representante->Dir_Exac = str_replace('  ', ' ', mb_convert_case((string) $datos['direccion'], MB_CASE_TITLE));
    $representante->Afin_con_Est = str_replace('  ', ' ', mb_convert_case((string) $datos['afinidadConEstudiante'], MB_CASE_TITLE));
    $representante->Email_Repres = $datos['correo'];
    $representante->Telf_Repres = $datos['telefono'];
    $representante->save();
    response()->redirect('/representantes');
  }

  private static function obtenerDatosValidados(array $datosSinValidar): ?array
  {
    return form()->validate($datosSinValidar, [
      'cedula' => 'number|min:1',
      'nombres' => 'names',
      'apellidos' => 'names',
      'fechaNacimiento' => 'date',
      'lugarNacimiento' => 'address',
      'nacionalidad' => 'nationality',
      'direccion' => 'address',
      'afinidadConEstudiante' => 'string',
      'correo' => 'email',
      'telefono' => 'phone'
    ]) ?: null;
  }
}
