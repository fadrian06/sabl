@php

$factorCrecimientoImagen = 1;

@endphp

<x-plantillas.inicio titulo="Notas certificadas">
  <style>
    th,
    td {
      border-color: black !important;
      vertical-align: middle !important;
    }
  </style>

  <form
    x-data='{
      estudiantes: @json($estudiantes),
      estudianteSeleccionado: {},
      cedulaSeleccionada: ``
    }'
    x-effect="estudianteSeleccionado = estudiantes.find(estudiante => estudiante.Nacionalidad[0] + '-' + estudiante.Ced_Est === cedulaSeleccionada) || {}"
    method="post"
    class="px-5 bg-white"
    style="display: grid; place-content: center">
    <table class="table table-sm table-bordered align-middle">
      <tr>
        <td rowspan="4" class="text-center align-middle">
          <img
            src="./imagenes/mppe2.png"
            height="{{ 80 * $factorCrecimientoImagen }}"
            width="{{ 180 * $factorCrecimientoImagen }}" />
        </td>
      </tr>
      <tr class="text-center">
        <td colspan="2">
          <u class="font-weight-bold">CERTIFICACIÓN DE CALIFICACIONES EMG</u>
        </td>
      </tr>
      <tr class="text-center">
        <td>
          <strong>I. Plan de Estudio:</strong>
          <u>EDUCACIÓN MEDIA GENERAL</u>
        </td>
        <td class="font-weight-bold">Código 31059</td>
      </tr>
      <tr class="text-center">
        <td>Lugar y Fecha de Expedición:</td>
        <td>
          {{ mb_convert_case($plantel->localidad, MB_CASE_TITLE) }} - {{ date('d/m/Y') }}
        </td>
      </tr>
    </table>
    <table class="table table-sm table-bordered align-middle">
      <tr>
        <th colspan="4" class="text-left">
          II. Datos del Plantel o Zona Educativa que Emite la Certificación:
        </th>
      </tr>
      <tr>
        <td>Código:</td>
        <td>
          <u class="text-uppercase">{{ $plantel->codigo }}</u>
        </td>
        <td>Nombre:</td>
        <td>
          <u class="text-uppercase">{{ $plantel->nombre_largo }}</u>
        </td>
      </tr>
      <tr>
        <td>Dirección:</td>
        <td class="text-capitalize">
          <u>{{ mb_convert_case($plantel->direccion, MB_CASE_TITLE) }}</u>
        </td>
        <td>Teléfono:</td>
        <td>
          <u>{{ $plantel->telefono }}</u>
        </td>
      </tr>
    </table>
    <table class="table table-sm table-bordered align-middle">
      <tr>
        <td>
          Municipio:
          <u>{{ mb_convert_case($plantel->municipio, MB_CASE_TITLE) }}</u>
        </td>
        <td>
          Entidad federal:
          <u>{{ mb_convert_case($plantel->entidad_federal, MB_CASE_TITLE) }}</u>
        </td>
        <td>
          Zona educativa:
          <u>{{ mb_convert_case($plantel->zona_educativa, MB_CASE_TITLE) }}</u>
        </td>
      </tr>
    </table>
    <table class="table table-sm table-bordered align-middle">
      <tr>
        <th colspan="4">III. Datos de Identificación del Estudiante:</th>
      </tr>
      <tr>
        <td>Cédula de identidad:</td>
        <td class="text-uppercase">
          <select class="form-control" x-effect="console.log(estudiantes)" x-model="cedulaSeleccionada">
            <option value="">Cédula</option>
            <template x-for="estudiante in estudiantes">
              <option x-text="estudiante.Nacionalidad[0] + '-' + estudiante.Ced_Est" />
            </template>
          </select>
        </td>
        <td>Fecha de nacimiento:</td>
        <td class="text-uppercase">
          <u x-text="estudianteSeleccionado?.Fec_Nac && new Date(estudianteSeleccionado?.Fec_Nac).toLocaleDateString('es', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
          })" />
        </td>
      </tr>
      <tr>
        <td>Apellidos:</td>
        <td class="text-uppercase">
          <u x-text="estudianteSeleccionado?.Apell_Est?.toUpperCase()" />
        </td>
        <td>Nombres:</td>
        <td class="text-uppercase">
          <u x-text="estudianteSeleccionado?.Nom_Est?.toUpperCase()" />
        </td>
      </tr>
    </table>
    <table class="table table-sm table-bordered align-middle">
      <td>Lugar de nacimiento:</td>
      <td>País:</td>
      <td class="text-uppercase">
        <u></u>
      </td>
      <td>Estado:</td>
      <td class="text-uppercase">
        <u></u>
      </td>
      <td>Municipio:</td>
      <td class="text-uppercase">
        <u></u>
      </td>
    </table>
    <div class="row row-cols-2">
      <div class="col">
        <table class="table table-sm table-bordered align-middle">
          <thead class="text-capitalize">
            <tr>
              <th colspan="4">IV. Planteles donde Cursó Estudios</th>
            </tr>
            <tr class="text-center">
              <th>N°</th>
              <th>Nombre del plantel</th>
              <th>Localidad</th>
              <th>E.F.</th>
            </tr>
          </thead>
          <tbody class="text-uppercase text-center">
            <template x-for="indicePlantel in Object.keys({0: 0, 1: 1})">
              <tr>
                <th x-text="indicePlantel + 1" />
                <td x-text="estudianteSeleccionado?.planteles?.[indicePlantel]?.nombre_corto?.toUpperCase()" />
                <td x-text="estudianteSeleccionado?.planteles?.[indicePlantel]?.localidad?.toUpperCase()" />
                <td x-text="estudianteSeleccionado?.planteles?.[indicePlantel]?.entidad_federal?.toUpperCase()" />
              </tr>
            </template>
          </tbody>
        </table>
      </div>
      <div class="col">
        <table class="table table-sm table-bordered align-middle">
          <thead class="text-capitalize">
            <tr class="text-center">
              <th>N°</th>
              <th>Nombre del plantel</th>
              <th>Localidad</th>
              <th>E.F.</th>
            </tr>
          </thead>
          <tbody class="text-uppercase text-center">
            <template x-for="indicePlantel in Object.keys({2: 2, 3: 0, 4: 0})">
              <tr>
                <th x-text="indicePlantel + 1" />
                <td x-text="estudianteSeleccionado?.planteles?.[indicePlantel]?.nombre_corto?.toUpperCase()" />
                <td x-text="estudianteSeleccionado?.planteles?.[indicePlantel]?.localidad?.toUpperCase()" />
                <td x-text="estudianteSeleccionado?.planteles?.[indicePlantel]?.entidad_federal?.toUpperCase()" />
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
    <strong>V. Plan de Estudio:</strong>
    <div class="row row-cols-2">
      <div class="col">
        <table class="table table-sm table-bordered">
          <thead class="text-capitalize text-center">
            <tr>
              <th colspan="7">PRIMER AÑO</th>
            </tr>
            <tr>
              <th rowspan="3">ÁREAS DE FORMACIÓN</th>
            </tr>
            <tr>
              <th colspan="2">CALIFICACIÓN</th>
              <th rowspan="2" class="text-nowrap">T-E</th>
              <th colspan="2">FECHA</th>
              <th rowspan="2" style="rotate: -90deg">PLANTEL</th>
            </tr>
            <tr>
              <th>N°</th>
              <th>LETRAS</th>
              <th>Mes</th>
              <th>Año</th>
            </tr>
          </thead>
          <tbody class="text-uppercase text-center">
            <tr>
              <td class="text-capitalize text-left">
                Castellano
              </td>
              <td>18</td>
              <td>DIECIOCHO</td>
              <td>F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Inglés y otras Lenguas Extrajeras
              </td>
              <td>19</td>
              <td class="text-uppercase">DIECINUEVE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Matemáticas
              </td>
              <td>17</td>
              <td class="text-uppercase">DIECISIETE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Educación Física
              </td>
              <td>17</td>
              <td class="text-uppercase">DIECISIETE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Arte y Patrimonio
              </td>
              <td>20</td>
              <td class="text-uppercase">VEINTE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Ciencias Naturales
              </td>
              <td>19</td>
              <td class="text-uppercase">DIECINUEVE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Geografía, Historia y Ciudadanía
              </td>
              <td>20</td>
              <td class="text-uppercase">VEINTE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col">
        <table class="table table-sm table-bordered">
          <thead class="text-capitalize text-center">
            <tr>
              <th colspan="7">SEGUNDO AÑO</th>
            </tr>
            <tr>
              <th rowspan="3">ÁREAS DE FORMACIÓN</th>
            </tr>
            <tr>
              <th colspan="2">CALIFICACIÓN</th>
              <th rowspan="2" class="text-nowrap">T-E</th>
              <th colspan="2">FECHA</th>
              <th rowspan="2" style="rotate: -90deg">PLANTEL</th>
            </tr>
            <tr>
              <th>N°</th>
              <th>LETRAS</th>
              <th>Mes</th>
              <th>Año</th>
            </tr>
          </thead>
          <tbody class="text-uppercase text-center">
            <tr>
              <td class="text-capitalize text-left">
                Castellano
              </td>
              <td>18</td>
              <td>DIECIOCHO</td>
              <td>F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Inglés y otras Lenguas Extrajeras
              </td>
              <td>19</td>
              <td class="text-uppercase">DIECINUEVE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Matemáticas
              </td>
              <td>17</td>
              <td class="text-uppercase">DIECISIETE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Educación Física
              </td>
              <td>17</td>
              <td class="text-uppercase">DIECISIETE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Arte y Patrimonio
              </td>
              <td>20</td>
              <td class="text-uppercase">VEINTE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Ciencias Naturales
              </td>
              <td>19</td>
              <td class="text-uppercase">DIECINUEVE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Geografía, Historia y Ciudadanía
              </td>
              <td>20</td>
              <td class="text-uppercase">VEINTE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col">
        <table class="table table-sm table-bordered">
          <thead class="text-capitalize text-center">
            <tr>
              <th colspan="7">TERCER AÑO</th>
            </tr>
            <tr>
              <th rowspan="3">ÁREAS DE FORMACIÓN</th>
            </tr>
            <tr>
              <th colspan="2">CALIFICACIÓN</th>
              <th rowspan="2" class="text-nowrap">T-E</th>
              <th colspan="2">FECHA</th>
              <th rowspan="2" style="rotate: -90deg">PLANTEL</th>
            </tr>
            <tr>
              <th>N°</th>
              <th>LETRAS</th>
              <th>Mes</th>
              <th>Año</th>
            </tr>
          </thead>
          <tbody class="text-uppercase text-center">
            <tr>
              <td class="text-capitalize text-left">
                Castellano
              </td>
              <td>18</td>
              <td>DIECIOCHO</td>
              <td>F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Inglés y otras Lenguas Extrajeras
              </td>
              <td>19</td>
              <td class="text-uppercase">DIECINUEVE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Matemáticas
              </td>
              <td>17</td>
              <td class="text-uppercase">DIECISIETE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Educación Física
              </td>
              <td>17</td>
              <td class="text-uppercase">DIECISIETE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Arte y Patrimonio
              </td>
              <td>20</td>
              <td class="text-uppercase">VEINTE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Ciencias Naturales
              </td>
              <td>19</td>
              <td class="text-uppercase">DIECINUEVE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Geografía, Historia y Ciudadanía
              </td>
              <td>20</td>
              <td class="text-uppercase">VEINTE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col">
        <table class="table table-sm table-bordered">
          <thead class="text-capitalize text-center">
            <tr>
              <th colspan="7">CUARTO AÑO</th>
            </tr>
            <tr>
              <th rowspan="3">ÁREAS DE FORMACIÓN</th>
            </tr>
            <tr>
              <th colspan="2">CALIFICACIÓN</th>
              <th rowspan="2" class="text-nowrap">T-E</th>
              <th colspan="2">FECHA</th>
              <th rowspan="2" style="rotate: -90deg">PLANTEL</th>
            </tr>
            <tr>
              <th>N°</th>
              <th>LETRAS</th>
              <th>Mes</th>
              <th>Año</th>
            </tr>
          </thead>
          <tbody class="text-uppercase text-center">
            <tr>
              <td class="text-capitalize text-left">
                Castellano
              </td>
              <td>18</td>
              <td>DIECIOCHO</td>
              <td>F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Inglés y otras Lenguas Extrajeras
              </td>
              <td>19</td>
              <td class="text-uppercase">DIECINUEVE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Matemáticas
              </td>
              <td>17</td>
              <td class="text-uppercase">DIECISIETE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Educación Física
              </td>
              <td>17</td>
              <td class="text-uppercase">DIECISIETE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Arte y Patrimonio
              </td>
              <td>20</td>
              <td class="text-uppercase">VEINTE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Ciencias Naturales
              </td>
              <td>19</td>
              <td class="text-uppercase">DIECINUEVE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Geografía, Historia y Ciudadanía
              </td>
              <td>20</td>
              <td class="text-uppercase">VEINTE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col">
        <table class="table table-sm table-bordered">
          <thead class="text-capitalize text-center">
            <tr>
              <th colspan="7">QUINTO AÑO</th>
            </tr>
            <tr>
              <th rowspan="3">ÁREAS DE FORMACIÓN</th>
            </tr>
            <tr>
              <th colspan="2">CALIFICACIÓN</th>
              <th rowspan="2" class="text-nowrap">T-E</th>
              <th colspan="2">FECHA</th>
              <th rowspan="2" style="rotate: -90deg">PLANTEL</th>
            </tr>
            <tr>
              <th>N°</th>
              <th>LETRAS</th>
              <th>Mes</th>
              <th>Año</th>
            </tr>
          </thead>
          <tbody class="text-uppercase text-center">
            <tr>
              <td class="text-capitalize text-left">
                Castellano
              </td>
              <td>18</td>
              <td>DIECIOCHO</td>
              <td>F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Inglés y otras Lenguas Extrajeras
              </td>
              <td>19</td>
              <td class="text-uppercase">DIECINUEVE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Matemáticas
              </td>
              <td>17</td>
              <td class="text-uppercase">DIECISIETE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Educación Física
              </td>
              <td>17</td>
              <td class="text-uppercase">DIECISIETE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Arte y Patrimonio
              </td>
              <td>20</td>
              <td class="text-uppercase">VEINTE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Ciencias Naturales
              </td>
              <td>19</td>
              <td class="text-uppercase">DIECINUEVE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="text-capitalize text-left">
                Geografía, Historia y Ciudadanía
              </td>
              <td>20</td>
              <td class="text-uppercase">VEINTE</td>
              <td class="text-uppercase">F</td>
              <td>07</td>
              <td>2020</td>
              <td>1</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col">
        <table class="table table-sm table-bordered text-capitalize text-center">
          <thead>
            <th>ÁREA DE FORMACIÓN</th>
            <th>AÑO</th>
            <th colspan="2">LITERAL</th>
          </thead>
          <tbody>
            <tr>
              <td rowspan="5">ORIENTACIÓN Y CONVIVENCIA</td>
              <td>1°</td>
              <td colspan="2">B</td>
            </tr>
            <tr>
              <td>2°</td>
              <td colspan="2">A</td>
            </tr>
            <tr>
              <td>3°</td>
              <td colspan="2">A</td>
            </tr>
            <tr>
              <td>4°</td>
              <td colspan="2">A</td>
            </tr>
            <tr>
              <td>5°</td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <th>ÁREA DE FORMACIÓN</th>
              <th>AÑO</th>
              <th>GRUPO</th>
              <th>LITERAL</th>
            </tr>
            <tr>
              <td rowspan="5">
                PARTICIPACIÓN EN GRUPOS DE CREACIÓN, RECREACIÓN Y PRODUCCIÓN
              </td>
              <td>1°</td>
              <td>BELLEZA Y ESTÉTICA</td>
              <td>B</td>
            </tr>
            <tr>
              <td>2°</td>
              <td>TEATRO</td>
              <td>A</td>
            </tr>
            <tr>
              <td>3°</td>
              <td>DEPORTE Y SALUD</td>
              <td></td>
            </tr>
            <tr>
              <td>4°</td>
              <td>MANUALIDADES</td>
              <td>B</td>
            </tr>
            <tr>
              <td>5°</td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row row-cols-2">
      <div class="col">
        <table class="table table-sm table-bordered">
          <tr>
            <th colspan="2">VII. Plantel</th>
          </tr>
          <tr class="text-center">
            <th>Director(a)</th>
            <td rowspan="7">SELLO DEL PLANTEL</td>
          </tr>
          <tr class="text-capitalize">
            <th>Apellidos y Nombres:</th>
          </tr>
          <tr class="text-uppercase">
            <td>BARRIOS R.EGLIS J.</td>
          </tr>
          <tr class="text-capitalize">
            <th>Cédula de identidad:</th>
          </tr>
          <tr class="text-uppercase">
            <td>V-15435983</td>
          </tr>
          <tr class="text-capitalize">
            <th>Firma:</th>
          </tr>
          <tr>
            <td>Para efectos de su Validez Nacional</td>
          </tr>
        </table>
      </div>
      <div class="col">
        <table class="table table-sm table-bordered">
          <tr>
            <th colspan="2">VIII. Zona Educativa</th>
          </tr>
          <tr class="text-center">
            <th>Director(a)</th>
            <td rowspan="7">SELLO DEL PLANTEL</td>
          </tr>
          <tr class="text-capitalize">
            <th>Apellidos y Nombres:</th>
          </tr>
          <tr class="text-uppercase">
            <td>&nbsp;</td>
          </tr>
          <tr class="text-capitalize">
            <th>Cédula de identidad:</th>
          </tr>
          <tr class="text-uppercase">
            <td>&nbsp;</td>
          </tr>
          <tr class="text-capitalize">
            <th>Firma:</th>
          </tr>
          <tr>
            <td>Para efectos de su Validez Nacional</td>
          </tr>
        </table>
      </div>
    </div>
    <button class="btn btn-success btn-lg w-100 my-5">Generar</button>
  </form>
</x-plantillas.reportes>
