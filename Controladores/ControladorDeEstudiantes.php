<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use SABL\Modelos\Estudiante;
use SABL\Modelos\Plantel;

final readonly class ControladorDeEstudiantes extends Controlador
{
  static function mostrarListado(): void
  {
    $estudiantes = Estudiante::with(['representante'])->get();

    Blade::renderizar(
      'paginas.estudiantes.listado',
      compact('estudiantes')
    );
  }

  static function mostrarFormularioDeRegistro(): void
  {
    Blade::renderizar('paginas.estudiantes.registrar');
  }

  static function registrar(): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/estudiantes/registrar');

    $ultimoId = db()
      ->select('estudiante', 'Id_Est')
      ->orderBy('Id_Est')
      ->limit(1)
      ->column();

    $plantel = Plantel::query()->findOrFail(session()->get('id_plantel'));

    $plantel->estudiantes()->create([
      'Id_Est' => $ultimoId + 1,
      'Ced_Est' => $datos['cedula'],
      'Nom_Est' => str_replace('  ', ' ', mb_convert_case((string) $datos['nombres'], MB_CASE_TITLE)),
      'Apell_Est' => str_replace('  ', ' ', mb_convert_case((string) $datos['apellidos'], MB_CASE_TITLE)),
      'Fec_Nac' => $datos['fechaNacimiento'],
      'Luga_Nac' => str_replace('  ', ' ', mb_convert_case((string) $datos['lugarNacimiento'], MB_CASE_TITLE)),
      'Nacionalidad' => $datos['nacionalidad'],
      'Dir_Exac' => str_replace('  ', ' ', mb_convert_case((string) $datos['direccion'], MB_CASE_TITLE)),
      'Id_Repres' => $datos['idRepresentante']
    ]);

    response()->redirect('/estudiantes');
  }

  static function eliminar(int $id): void
  {
    Estudiante::query()->find($id)->delete();
    response()->redirect('/estudiantes');
  }

  static function mostrarFormularioDeEdicion(int $id): void
  {
    Blade::renderizar(
      'paginas.estudiantes.editar',
      ['estudiante' => Estudiante::query()->find($id)]
    );
  }

  static function actualizar(int $id): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten("/estudiantes/$id/editar");

    $estudiante = Estudiante::query()->find($id);
    $estudiante->Nacionalidad = $datos['nacionalidad'];
    $estudiante->Ced_Est = $datos['cedula'];
    $estudiante->Nom_Est = str_replace('  ', ' ', mb_convert_case((string) $datos['nombres'], MB_CASE_TITLE));
    $estudiante->Apell_Est = str_replace('  ', ' ', mb_convert_case((string) $datos['apellidos'], MB_CASE_TITLE));
    $estudiante->Fec_Nac = $datos['fechaNacimiento'];
    $estudiante->Luga_Nac = str_replace('  ', ' ', mb_convert_case((string) $datos['lugarNacimiento'], MB_CASE_TITLE));
    $estudiante->Dir_Exac = str_replace('  ', ' ', mb_convert_case((string) $datos['direccion'], MB_CASE_TITLE));
    $estudiante->Id_Repres = $datos['idRepresentante'];
    $estudiante->save();
    response()->redirect('/estudiantes');
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
      'idRepresentante' => 'number'
    ]) ?: null;
  }
}
