@php

$fecha = new Jenssegers\Date\Date;

@endphp

<x-plantillas.reportes titulo="Constancia de estudio">
  <div
    class="px-5 min-vh-100 d-flex flex-column justify-content-center"
    style="font-size: 1.75rem">
    <header class="row row-cols-2 align-items-center">
      <div class="col-10 mb-5">
        <img class="img-fluid" src="./imagenes/mppe.png" />
      </div>
      <div class="col-2 mb-5">
        <img class="img-fluid" src="./imagenes/logo.png" />
      </div>

      <div class="col-12 mb-5 text-center text-uppercase">
        <p>REPÚBLICA BOLIVARIANA DE VENEZUELA</p>
        <p>MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN</p>
        <p>U.E.B. "SILVESTRE ANTONIO BRAVO LÓPEZ"</p>
        <p>LA CHIQUINQUIRÁ, SUCRE - ZULIA</p>
        <p>CÓDIGO DEA: OD06392320</p>
      </div>
    </header>

    <section>
      <h2 class="text-center text-uppercase font-weight-bold mb-5">
        CONSTANCIA DE ESTUDIO
      </h2>

      <p class="d-inline-block text-justify" style="text-indent: 5%">
        Quien suscribe,
        <u>
          {{ $datos['subscribe']['nivel'] }}
          {{ $datos['subscribe']['nombre'] }}
        </u>
        , titular de la cédula de identidad:
        <u>
          {{ $datos['subscribe']['nacionalidad'] }}-{{ $datos['subscribe']['cedula'] }}
        </u>
        , Directora de la U.E.B. "Silvestre Antonio Bravo López", por medio de
        la presente:
      </p>
    </section>

    <section>
      <h3 class="text-center text-uppercase font-weight-bold mb-5">
        HAGO CONSTAR
      </h3>

      <p class="d-inline-block text-justify" style="text-indent: 5%">
        Que el (la) estudiante:
        <u>{{ $estudiante }}</u>
        portador de la cédula de identidad o escolar:
        <u>
          {{ $datos['estudiante']['nacionalidad'] }}
          {{ $datos['estudiante']['cedula'] }}
        </u>
        , natural de
        <u>{{ $datos['estudiante']['estado_nacimiento'] }}</u>
        , en fecha:
        <u>{{ (new DatetimeImmutable($datos['fecha']))->format('d / m / Y') }}</u>
        , cursa el
        <u>{{ $nivel }}</u>
        de Educación Media General en Ciencias, durante el año escolar
        <u>{{ $periodo }}</u>
        .
      </p>
    </section>
    <p class="mb-5 text-justify" style="text-indent: 5%">
      Constancia que se expide en La Chiquinquirá, a los {{ date('d') }} dias
      del mes de {{ $fecha->monthName }} del año {{ date('Y') }}.
    </p>

    <footer class="text-center d-flex flex-column align-items-center">
      <span>{{ str_repeat('_', 30) }}</span>
      <span>{{ $datos['subscribe']['nombre'] }}</span>
      <span>C.I. {{ $datos['subscribe']['cedula'] }}</span>
      <span>Director(a)</span>
    </footer>
  </div>

  <script>print()</script>
</x-plantillas.reportes>
