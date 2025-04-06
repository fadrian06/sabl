@php

$datos = flash()->display('datos');
$nacionalidades = SABL\Enums\Nacionalidad::cases();
$tiposVivienda = SABL\Enums\TipoVivienda::cases();
$condicionesVivienda = SABL\Enums\CondicionVivienda::cases();
$condicionesInfrastructuraVivienda = SABL\Enums\CondicionInfrastructuraVivienda::cases();

$paises = SABL\Modelos\Pais::with([
'estados',
'estados.municipios',
'estados.municipios.localidades'
])
->get();

@endphp

<x-plantillas.inicio titulo="Inscribir estudiante">
  <form
    method="post"
    target="_blank"
    class="bg-white px-5 pb-5"
    x-data='{
      paises: @json($paises),
      idPaisSeleccionado: `{{ $datos['id_pais'] ?? '' }}`,
      idEstadoSeleccionado: `{{ $datos['id_estado'] ?? '' }}`,
      idMunicipioSeleccionado: `{{ $datos['id_municipio'] ?? '' }}`,
      idLocalidadSeleccionada: `{{ $datos['id_localidad'] ?? '' }}`,

      get paisSeleccionado() {
        return this.paises.find(pais => pais.id == this.idPaisSeleccionado);
      },

      get estadoSeleccionado() {
        return this.paisSeleccionado?.estados.find(estado => estado.id == this.idEstadoSeleccionado);
      },

      get municipioSeleccionado() {
        return this.estadoSeleccionado?.municipios.find(municipio => municipio.id == this.idMunicipioSeleccionado);
      },
    }'>
    <header class="row align-items-center">
      <div class="col-3">
        <img class="img-fluid" src="./imagenes/mppe3.jpg" />
      </div>
      <div class="col-4 offset-1 pl-5 border-left font-weight-bold">
        <div>{{ $plantel->nombre_largo }}</div>
        <div>{{ $plantel->localidad->municipio }} - {{ $plantel->localidad->municipio->estado }}</div>
      </div>
      <div class="col-3 offset-1 text-right">
        <img class="img-fluid w-50" src="./imagenes/zona-educativa-zulia.png" />
      </div>
    </header>

    <h2>Datos del estudiante:</h2>
    Cédula de identidad:
    <input
      type="number"
      min="1"
      name="estudiante[cedula]"
      class="form-control form-control-border bg-transparent w-auto d-inline-block"
      required
      value="{{ $datos['estudiante']['cedula'] ?? '' }}" />
    Apellidos:
    <input
      name="estudiante[apellidos]"
      class="form-control form-control-border bg-transparent w-auto d-inline-block"
      required
      value="{{ $datos['estudiante']['apellidos'] ?? '' }}" />
    Nombres:
    <input
      name="estudiante[nombres]"
      class="form-control form-control-border bg-transparent w-auto d-inline-block"
      required
      value="{{ $datos['estudiante']['nombres'] ?? '' }}" />
    Fecha de nacimiento:
    <input
      type="date"
      name="estudiante[fecha_nacimiento]"
      class="form-control form-control-border bg-transparent w-auto d-inline-block"
      required
      value="{{ $datos['estudiante']['fecha_nacimiento'] ?? '' }}" />
    Lugar de nacimiento:
    <select x-model="idPaisSeleccionado" class="form-control form-control-border bg-transparent w-auto d-inline-block">
      <option value="">País</option>
      <template x-for="pais in paises">
        <option x-text="pais.nombre" :value="pais.id" />
      </template>
    </select>
    <select
      x-model="idEstadoSeleccionado"
      class="form-control form-control-border bg-transparent w-auto d-inline-block">
      <option value="">Estado</option>
      <template x-for="estado in paisSeleccionado?.estados || []">
        <option x-text="estado.nombre" :value="estado.id" />
      </template>
    </select>
    <select
      x-model="idMunicipioSeleccionado"
      name="id_municipio"
      required
      class="form-control form-control-border bg-transparent w-auto d-inline-block">
      <option value="">Municipio</option>
      <template x-for="municipio in estadoSeleccionado?.municipios || []">
        <option x-text="municipio.nombre" :value="municipio.id" />
      </template>
    </select>
    <select
      name="id_localidad"
      x-model="idLocalidadSeleccionada"
      class="form-control form-control-border bg-transparent w-auto d-inline-block">
      <option value="">Seleccionar localidad</option>
      <template x-for="localidad in municipioSeleccionado?.localidades || []">
        <option x-text="localidad.nombre" :value="localidad.id" />
      </template>
    </select>
    <input
      name="localidad"
      :disabled="idLocalidadSeleccionada !== ''"
      :required="idLocalidadSeleccionada === ''"
      class="form-control form-control-border bg-transparent w-auto d-inline-block"
      placeholder="o ingrese una nueva" />
    Nacionalidad:
    <select
      name="estudiante[nacionalidad]"
      class="form-control form-control-border bg-transparent w-auto d-inline-block"
      required>
      <option value=""></option>
      @foreach ($nacionalidades as $nacionalidad)
      <option value="{{ $nacionalidad }}">{{ $nacionalidad }}</option>
      @endforeach
    </select>
    Dirección exacta:
    <input
      name="estudiante[direccion]"
      class="form-control form-control-border bg-transparent w-auto d-inline-block"
      required
      value="{{ $datos['estudiante']['direccion'] ?? '' }}" />
    Tipo de vivienda:
    @foreach ($tiposVivienda as $tipoVivienda)
      <label for="{{ $tipoVivienda }}">{{ $tipoVivienda }}</label>
      <input
        id="{{ $tipoVivienda }}"
        name="estudiante[tipo_vivienda]"
        class="form-control form-control-border bg-transparent w-auto d-inline-block text-center font-weight-bold"
        readonly
       />
    @endforeach
  </form>
</x-plantillas.inicio>
