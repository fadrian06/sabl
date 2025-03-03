drop table if exists calificaciones;
drop table if exists inscripciones;
drop table if exists asignacion_guias;
drop table if exists usuarios;
drop table if exists asignacion_areas;
drop table if exists asignacion_lapsos;
drop table if exists lapsos;
drop table if exists periodos;
drop table if exists areas;
drop table if exists secciones;
drop table if exists `años`;
drop table if exists planteles_cursados;
drop table if exists estudiantes;
drop table if exists afinidades;
drop table if exists representantes;
drop table if exists planteles;
drop table if exists localidades;
drop table if exists municipios;
drop table if exists estados;
drop table if exists paises;
drop table if exists planes_estudio;

create table planes_estudio (
  id integer primary key autoincrement,
  nombre varchar(255) not null unique check (length(nombre) > 0)
);

create table paises (
  id integer primary key autoincrement,
  nombre varchar(255) not null unique check (length(nombre) > 0)
);

create table estados (
  id integer primary key autoincrement,
  nombre varchar(255) not null unique check (length(nombre) > 0),
  tiene_zona_educativa boolean not null default false,
  id_pais integer not null,

  unique (nombre, id_pais),
  foreign key (id_pais) references paises(id)
);

create table municipios (
  id integer primary key autoincrement,
  nombre varchar(255) not null unique check (length(nombre) > 0),
  id_estado integer not null,

  unique (nombre, id_estado),
  foreign key (id_estado) references estados(id)
);

create table localidades (
  id integer primary key autoincrement,
  nombre varchar(255) not null unique check (length(nombre) > 0),
  id_municipio integer not null,

  unique (nombre, id_municipio),
  foreign key (id_municipio) references municipios(id)
);

create table planteles (
  id integer primary key autoincrement,
  codigo varchar(255) not null unique check (length(codigo) > 0),
  nombre_corto varchar(255) unique check (length(nombre_corto) > 0),
  nombre_largo varchar(255) not null unique check (length(nombre_largo) > 0),
  direccion_exacta varchar(255) not null unique check (length(direccion_exacta) > 0),
  telefono varchar(255) not null unique check (telefono like '+% %-%'),
  es_principal boolean not null default false,
  `año_fundacion` integer not null check (`año_fundacion` > 0),
  id_plan_estudio integer not null,
  id_localidad integer not null,

  foreign key (id_plan_estudio) references planes_estudio(id),
  foreign key (id_localidad) references localidades(id)

  /* si es_principal = true entonces id_plan_estudio debe ser 1 (Educación Media General) */
  /* convertir el nombre_corto y nombre_largo a mayúsculas */
  /* capitalizar direccion_exacta */
  /* sólo permitir 1 plantel principal */
);

create table representantes (
  id integer primary key autoincrement,
  nacionalidad varchar(255) not null check (nacionalidad in ('V', 'E')),
  cedula integer not null unique check (cedula > 0),
  fecha_nacimiento date not null,
  nombres varchar(255) not null check (length(nombres) > 0),
  apellidos varchar(255) not null check (length(apellidos) > 0),
  direccion_exacta varchar(255) not null check (length(direccion_exacta) > 0),
  correo varchar(255) not null check (correo like '%@%'),
  telefono_movil varchar(255) not null check (telefono_movil like '+% %-%'),
  telefono_casa varchar(255) not null default telefono_movil check (telefono_casa like '+% %-%'),
  telefono_trabajo varchar(255) not null default telefono_movil check (telefono_trabajo like '+% %-%'),
  id_localidad_nacimiento integer not null,

  unique (nombres, apellidos),
  foreign key (id_localidad_nacimiento) references localidades(id)
);

create table afinidades (
  id integer primary key autoincrement,
  nombre varchar(255) not null unique check (length(nombre) > 0),
  inverso varchar(255) not null unique check (length(inverso) > 0),

  check (nombre != inverso)
);

create table estudiantes (
  id integer primary key autoincrement,
  nacionalidad varchar(255) not null check (nacionalidad in ('V', 'E')),
  cedula integer not null unique check (cedula > 0),
  fecha_nacimiento date not null,
  nombres varchar(255) not null check (length(nombres) > 0),
  apellidos varchar(255) not null check (length(apellidos) > 0),
  direccion_exacta varchar(255) not null check (length(direccion_exacta) > 0),
  tipo_vivienda varchar(255) not null check (tipo_vivienda in ('Casa', 'Quinta', 'Apartamento', 'Rancho')),
  condicion_vivienda varchar(255) not null check (condicion_vivienda in ('Propia', 'Alquilada', 'Al cuido')),
  condicion_infrastructura_vivienda varchar(255) not null check (condicion_infrastructura_vivienda in ('Buena', 'Regular', 'Mala')),
  tipo_beca varchar(255) check (length(tipo_beca) > 0),
  posee_canaima boolean not null default false,
  id_localidad_nacimiento integer not null,
  id_representante integer not null,
  id_afinidad_representante integer not null,

  unique (nombres, apellidos),
  foreign key (id_localidad_nacimiento) references localidades(id),
  foreign key (id_representante) references representantes(id),
  foreign key (id_afinidad_representante) references afinidades(id)
);

create table planteles_cursados (
  id_estudiante integer not null,
  id_plantel integer not null,

  primary key (id_estudiante, id_plantel)
);

create table `años` (
  id integer primary key autoincrement,
  ordinal integer not null unique check (ordinal > 0)
);

create table secciones (
  id integer primary key autoincrement,
  letra varchar(1) not null unique check (length(letra) = 1)
);

create table areas (
  id integer primary key autoincrement,
  nombre_corto varchar(255) not null unique check (length(nombre_corto) > 0),
  nombre_largo varchar(255) unique default nombre_corto check (length(nombre_largo) > 0),
  es_grupo_estable boolean not null default false,
  id_categoria integer,

  foreign key (id_categoria) references areas(id)
);

create table periodos (
  id integer primary key autoincrement,
  `año_inicio` integer not null unique

  /* validar que el año_inicio sea mayor o igual al año_fundacion del plantel principal  */
);

create table lapsos (
  id integer primary key autoincrement,
  ordinal integer not null unique check (ordinal > 0)
);

create table asignacion_lapsos (
  id_periodo integer not null,
  id_lapso integer not null,

  primary key (id_periodo, id_lapso),
  foreign key (id_lapso) references lapsos(id),
  foreign key (id_periodo) references periodos(id)
);

create table asignacion_areas (
  id_periodo integer not null,
  `id_año` integer not null,
  id_area integer not null,

  primary key (id_periodo, `id_año`, id_area),
  foreign key (id_periodo) references periodos(id),
  foreign key (`id_año`) references `años`(id),
  foreign key (id_area) references areas(id)
);

create table usuarios (
  id integer primary key autoincrement,
  rol varchar(255) not null check (rol in ('Director', 'Secretario', 'Coordinador', 'Docente')),
  nacionalidad varchar(255) not null check (nacionalidad in ('V', 'E')),
  cedula integer not null unique check (cedula > 0),
  nombres varchar(255) not null check (length(nombres) > 0),
  apellidos varchar(255) not null check (length(apellidos) > 0),
  clave varchar(255) not null unique check (length(clave) > 0),
  activado boolean not null,

  unique (nombres, apellidos)

  /* si rol = 'Docente' entonces activado por defecto será false */
);

create table asignacion_guias (
  id_seccion integer not null,
  id_docente integer not null,
  id_periodo integer not null,

  primary key (id_seccion, id_docente, id_periodo),
  foreign key (id_seccion) references secciones(id),
  foreign key (id_docente) references usuarios(id),
  foreign key (id_periodo) references periodos(id)
);

create table inscripciones (
  id integer primary key autoincrement,
  fecha date not null,
  id_estudiante integer not null,
  id_seccion integer not null,
  id_periodo integer not null,

  foreign key (id_estudiante) references estudiantes(id),
  foreign key (id_seccion) references secciones(id)
);

create table calificaciones (
  id integer primary key autoincrement,
  numero integer check (numero >= 0 and numero <= 20),
  literal varchar(1) check (literal in ('A', 'B', 'C', 'D', 'E', 'F')),
  inasistencias integer not null check (inasistencias >= 0),
  id_periodo integer not null,
  id_lapso integer not null,
  id_estudiante integer not null,
  `id_año` integer not null,
  id_area integer not null,
  id_plantel integer not null,

  foreign key (id_lapso) references lapsos(id),
  foreign key (id_estudiante) references estudiantes(id),
  foreign key (id_area) references areas(id),
  foreign key (id_periodo) references periodos(id),
  foreign key (`id_año`) references `años`(id),
  foreign key (id_plantel) references planteles(id)

  /* no permitir un id_area que tenga otras áreas asignadas (área de tipo categoría) */
);

insert into planes_estudio (id, nombre)
values (1, 'Educación Media General');

insert into paises (id, nombre)
values (1, 'Venezuela');

insert into estados (id, nombre, tiene_zona_educativa, id_pais) values
(1, 'Zulia', true, 1),
(2, 'Mérida', true, 1);

insert into municipios (id, nombre, id_estado) values
(1, 'Sucre', 1),
(2, 'Caracciolo Parra Olmedo', 2);

insert into localidades (id, nombre, id_municipio) values
(1, 'La Chiquinquirá', 1),
(2, 'Caja Seca', 1),
(3, 'Tucaní', 2);

insert into planteles (id, codigo, nombre_corto, nombre_largo, direccion_exacta, telefono, es_principal, `año_fundacion`, id_plan_estudio, id_localidad) values
(1, 'OD06392320', 'U.E.BOL. SILVESTRE BRAVO', 'U.E.N. BOLIV. "SILVESTRE ANTONIO BRAVO LÓPEZ"', 'Carretera Principal Vía A Santa María', '+58 424-7255781', true, 1976, 1, 1);

insert into afinidades (id, nombre, inverso) values
(1, 'Madre', 'Hijo');

insert into `años` (id, ordinal) values
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

insert into secciones (id, letra) values
(1, 'U'),
(2, 'A'),
(3, 'B');

insert into areas (id, nombre_corto, nombre_largo, es_grupo_estable, id_categoria) values
(1, 'Castellano', null, false, null),
(2, 'Inglés', 'Inglés y otras lenguas extranjeras', false, null),
(3, 'Matemáticas', null, false, null),
(4, 'Educación física', null, false, null),
(5, 'Arte y patrimonio', null, false, null),
(6, 'Ciencias naturales', null, false, null),
(7, 'Geografía, historia y ciudadanía', null, false, null),
(8, 'Física', null, false, null),
(9, 'Química', null, false, null),
(10, 'Biología', null, false, null),
(11, 'Formación para la soberanía nacional', null, false, null),
(12, 'Ciencias de la tierra', null, false, null),
(13, 'Orientación y convivencia', null, true, null),
(14, 'Participación en grupos de creación, recreación y producción', null, true, null),
(15, 'Belleza y estética', null, true, 14),
(16, 'Teatro', null, true, 14),
(17, 'Deporte y salud', null, true, 14),
(18, 'Manualidades', null, true, 14);

insert into periodos (id, `año_inicio`) values
(1, 2025);

insert into lapsos (id, ordinal) values
(1, 1),
(2, 2),
(3, 3);

insert into asignacion_lapsos (id_periodo, id_lapso) values
(1, 1),
(1, 2),
(1, 3);

insert into asignacion_areas (id_periodo, `id_año`, id_area) values
(1, 1, 1),
(1, 1, 2),
(1, 1, 3),
(1, 1, 4),
(1, 1, 5),
(1, 1, 6),
(1, 1, 7),
(1, 2, 1),
(1, 2, 2),
(1, 2, 3),
(1, 2, 4),
(1, 2, 5),
(1, 2, 6),
(1, 2, 7),
(1, 3, 1),
(1, 3, 2),
(1, 3, 3),
(1, 3, 4),
(1, 3, 8),
(1, 3, 9),
(1, 3, 10),
(1, 3, 7),
(1, 4, 1),
(1, 4, 2),
(1, 4, 3),
(1, 4, 4),
(1, 4, 8),
(1, 4, 9),
(1, 4, 10),
(1, 4, 7),
(1, 4, 11),
(1, 5, 1),
(1, 5, 2),
(1, 5, 3),
(1, 5, 4),
(1, 5, 8),
(1, 5, 9),
(1, 5, 10),
(1, 5, 12),
(1, 5, 7),
(1, 5, 11),
(1, 1, 13),
(1, 2, 13),
(1, 3, 13),
(1, 4, 13),
(1, 1, 15),
(1, 2, 16),
(1, 3, 17),
(1, 4, 18);
