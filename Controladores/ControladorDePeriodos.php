<?php

declare(strict_types=1);

namespace SABL\Controladores;

use Blade;
use DateTimeImmutable;
use SABL\Modelos\Periodo;

final readonly class ControladorDePeriodos extends Controlador
{
  static function mostrarListado(): void
  {
    $periodos = Periodo::all();

    Blade::renderizar(
      'paginas.periodos.listado',
      compact('periodos')
    );
  }

  static function mostrarFormularioDeRegistro(): void
  {
    Blade::renderizar('paginas.periodos.registrar');
  }

  static function registrar(): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten('/periodos/aperturar');

    $ultimoId = db()
      ->select('periodo', 'Id_Periodo')
      ->orderBy('Id_Periodo')
      ->limit(1)
      ->column();

    (new Periodo([
      'Id_Periodo' => $ultimoId + 1,
      'Nom_Periodo' => (new DateTimeImmutable($datos['inicio']))->format('Y') . '-' . (new DateTimeImmutable($datos['fin']))->format('Y'),
      'Fec_Inicio' => $datos['inicio'],
      'Fec_fin' => $datos['fin'],
      'Número_semanas' => intdiv((new DateTimeImmutable($datos['inicio']))
        ->diff(new DateTimeImmutable($datos['fin']))
        ->format('%a'), 7),
      'Estad_Periodo' => '',
      'Fec_Creación' => date('Y-m-d')
    ]))->save();

    response()->redirect('/periodos');
  }

  static function eliminar(int $id): void
  {
    Periodo::query()->find($id)->delete();
    response()->redirect('/periodos');
  }

  static function mostrarFormularioDeEdicion(int $id): void
  {
    Blade::renderizar(
      'paginas.periodos.editar',
      ['periodo' => Periodo::query()->find($id)]
    );
  }

  static function actualizar(int $id): void
  {
    $datos = self::obtenerDatosValidados(request()->body());
    self::enviarErroresDeValidacionSiExisten("/periodos/$id/editar");

    $periodo = Periodo::query()->find($id);
    $periodo->Nom_Periodo = (new DateTimeImmutable($datos['inicio']))->format('Y') . '-' . (new DateTimeImmutable($datos['fin']))->format('Y');
    $periodo->Fec_Inicio = $datos['inicio'];
    $periodo->Fec_fin = $datos['fin'];
    $periodo->Número_semanas = intdiv((new DateTimeImmutable($datos['inicio']))
      ->diff(new DateTimeImmutable($datos['fin']))
      ->format('%a'), 7);
    $periodo->save();
    response()->redirect('/periodos');
  }

  private static function obtenerDatosValidados(array $datosSinValidar): ?array
  {
    $datosSinValidar = form()->validate($datosSinValidar, [
      'inicio' => 'date',
      'fin' => 'date'
    ]) ?: null;

    if (@$datosSinValidar['inicio'] >= @$datosSinValidar['fin']) {
      form()->addError('fin', 'La fecha de fin debe ser posterior a la fecha de inicio.');
    }

    return $datosSinValidar;
  }
}
