<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use SABL\Modelos\Profesor;

final readonly class ControladorDeProfesores extends Controlador
{
  static function mostrarListado(): void
  {
    $profesores = Profesor::all();

    Blade::renderizar(
      'paginas.profesores.listado',
      compact('profesores')
    );
  }

  static function mostrarFormularioDeRegistro(): void
  {
    Blade::renderizar('paginas.profesores.registrar');
  }

  static function registrar(): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/profesores/registrar');

    $ultimoId = db()
      ->select('profesor', 'Id_Prof')
      ->orderBy('Id_Prof')
      ->limit(1)
      ->column();

    (new Profesor([
      'Id_Prof' => $ultimoId + 1,
      'Ced_Prof' => $datos['cedula'],
      'Nom_Prof' => str_replace('  ', ' ', mb_convert_case((string) $datos['nombres'], MB_CASE_TITLE)),
      'Apell_Prof' => str_replace('  ', ' ', mb_convert_case((string) $datos['apellidos'], MB_CASE_TITLE)),
      'Codigo_Carg_Prof' => $datos['codigoCarga'],
      'Codigo_Domina' => $datos['codigoNomina'],
      'Fec_Incres_T_Minis' => $datos['fechaIngresoMinisterio'],
      'Fec_Nac' => $datos['fechaNacimiento'],
      'Email_Prof' => $datos['correo'],
      'Telf_Prof' => $datos['telefono'],
      'Fec_Registro' => date('Y-m-d')
    ]))->save();

    response()->redirect('/profesores');
  }

  static function eliminar(int $id): void
  {
    Profesor::query()->find($id)->delete();
    response()->redirect('/profesores');
  }

  static function mostrarFormularioDeEdicion(int $id): void
  {
    Blade::renderizar(
      'paginas.profesores.editar',
      ['profesor' => Profesor::query()->find($id)]
    );
  }

  static function actualizar(int $id): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten("/profesores/$id/editar");

    $profesor = Profesor::query()->find($id);
    $profesor->Ced_Prof = $datos['cedula'];
    $profesor->Nom_Prof = str_replace('  ', ' ', mb_convert_case((string) $datos['nombres'], MB_CASE_TITLE));
    $profesor->Apell_Prof = str_replace('  ', ' ', mb_convert_case((string) $datos['apellidos'], MB_CASE_TITLE));
    $profesor->Fec_Nac = $datos['fechaNacimiento'];
    $profesor->Codigo_Carg_Prof = $datos['codigoCarga'];
    $profesor->Codigo_Domina = $datos['codigoNomina'];
    $profesor->Fec_Incres_T_Minis = $datos['fechaIngresoMinisterio'];
    $profesor->Email_Prof = $datos['correo'];
    $profesor->Telf_Prof = $datos['telefono'];
    $profesor->save();
    response()->redirect('/profesores');
  }

  private static function obtenerDatosValidados(array $datosSinValidar): ?array
  {
    return form()->validate($datosSinValidar, [
      'cedula' => 'number|min:1',
      'nombres' => 'names',
      'apellidos' => 'names',
      'fechaNacimiento' => 'date',
      'codigoCarga' => 'string',
      'codigoNomina' => 'string',
      'fechaIngresoMinisterio' => 'date',
      'correo' => 'email',
      'telefono' => 'phone'
    ]) ?: null;
  }
}
