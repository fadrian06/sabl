@php

$fecha = new Jenssegers\Date\Date;

@endphp

<x-plantillas.inicio titulo="Constancia de estudio">
  <form method="post" target="_blank" class="bg-white px-5 pb-5">
    <header class="row row-cols-2 align-items-center">
      <div class="col-10">
        <img class="img-fluid" src="./imagenes/mppe.png" />
      </div>
      <div class="col-2">
        <img class="img-fluid" src="./imagenes/logo.png" />
      </div>

      <div class="col-12 text-center text-uppercase">
        <p>REPÚBLICA BOLIVARIANA DE VENEZUELA</p>
        <p>MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN</p>
        <p>U.E.B. "SILVESTRE ANTONIO BRAVO LÓPEZ"</p>
        <p>LA CHIQUINQUIRÁ, SUCRE - ZULIA</p>
        <p>CÓDIGO DEA: OD06392320</p>
      </div>
    </header>

    <section>
      <h2 class="text-center text-uppercase font-weight-bold">
        CONSTANCIA DE ESTUDIO
      </h2>

      <p class="d-inline-block">
        Quien suscribe,
      <div class="input-group d-inline-block w-auto">
        <select
          name="subscribe[nivel]"
          class="form-control form-control-border bg-transparent w-auto d-inline-block"
          required>
          <option>Lcdo.</option>
          <option>Lcda.</option>
          <option>Prof.</option>
          <option>T.S.U.</option>
          <option>Ing.</option>
          <option>Mag.</option>
        </select>
        <input
          name="subscribe[nombre]"
          class="form-control form-control-border bg-transparent w-auto d-inline-block"
          required />
      </div>
      , titular de la cédula de identidad:
      <div class="input-group d-inline-block w-auto">
        <select
          name="subscribe[nacionalidad]"
          class="form-control form-control-border bg-transparent w-auto d-inline-block"
          required>
          <option>V</option>
          <option>E</option>
        </select>
        <input
          type="number"
          name="subscribe[cedula]"
          class="form-control form-control-border bg-transparent w-auto d-inline-block"
          required />
      </div>
      , Directora de la U.E.B. "Silvestre Antonio Bravo López", por medio de la presente:
      </p>
    </section>

    <section>
      <h3 class="text-center text-uppercase font-weight-bold">
        HAGO CONSTAR
      </h3>

      <p class="d-inline-block">
        Que el (la) estudiante:
        <select
          name="estudiante[id]"
          class="form-control form-control-border bg-transparent w-auto d-inline-block"
          required>
          <option value=""></option>
          @foreach ($estudiantes as $estudiante)
          <option value="{{ $estudiante->Id_Est }}">
            {{ $estudiante }}
          </option>
          @endforeach
        </select>,
        portador de la cédula de identidad o escolar:
      <div class="input-group d-inline-block w-auto">
        <select
          name="estudiante[nacionalidad]"
          class="form-control form-control-border bg-transparent w-auto d-inline-block"
          required>
          <option>V</option>
          <option>E</option>
        </select>
        <input
          type="number"
          name="estudiante[cedula]"
          class="form-control form-control-border bg-transparent w-auto d-inline-block"
          required />
      </div>
      , natural de
      <select
        name="estudiante[estado_nacimiento]"
        class="form-control form-control-border bg-transparent w-auto d-inline-block"
        required>
        <option value=""></option>
        <option>Amazonas</option>
        <option>Anzoátegui</option>
        <option>Apure</option>
        <option>Aragua</option>
        <option>Barinas</option>
        <option>Bolívar</option>
        <option>Carabobo</option>
        <option>Cojedes</option>
        <option>Delta Amacuro</option>
        <option>Distrito Capital</option>
        <option>Falcón</option>
        <option>Guárico</option>
        <option>Lara</option>
        <option>Mérida</option>
        <option>Miranda</option>
        <option>Monagas</option>
        <option>Nueva Esparta</option>
        <option>Portuguesa</option>
        <option>Sucre</option>
        <option>Táchira</option>
        <option>Trujillo</option>
        <option>Vargas</option>
        <option>Yaracuy</option>
        <option>Zulia</option>
      </select>
      , en fecha:
      <input
        type="date"
        name="fecha"
        required
        value="{{ date('Y-m-d') }}"
        class="form-control form-control-border bg-transparent w-auto d-inline-block" />
      , cursa el
      <select
        name="id_nivel"
        required
        class="form-control form-control-border bg-transparent w-auto d-inline-block">
        <option value=""></option>
        @foreach ($niveles as $nivel)
        <option value="{{ $nivel->Id_Nivel_estud }}">
          {{ $nivel }}
        </option>
        @endforeach
      </select>
      de Educación Media General en Ciencias, durante el año escolar
      <select
        name="id_periodo"
        required
        class="form-control form-control-border bg-transparent w-auto d-inline-block">
        @foreach ($periodos as $periodo)
        <option value="{{ $periodo->Id_Periodo }}">
          {{ $periodo }}
        </option>
        @endforeach
      </select>
      .
      </p>
    </section>
    <p>
      Constancia que se expide en La Chiquinquirá, a los {{ date('d') }} dias
      del mes de {{ $fecha->monthName }} del año {{ date('Y') }}.
    </p>

    <button class="btn btn-primary btn-lg w-100">Generar PDF</button>
  </form>
</x-plantillas.inicio>
