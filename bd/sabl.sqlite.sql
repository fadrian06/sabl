drop table if exists asignacion;
drop table if exists boletines;
drop table if exists calificaciones;
drop table if exists datos_socioeconómico;
drop table if exists estudiante;
drop table if exists inscripción;
drop table if exists materias;
drop table if exists momento;
drop table if exists profesor;
drop table if exists representante;
drop table if exists sección;
drop table if exists seguridad;
drop table if exists nivel_estudio;
drop table if exists periodo;

CREATE TABLE profesor (
  Id_Prof integer primary key autoincrement,
  Ced_Prof varchar(50) NOT NULL,
  Nom_Prof varchar(50) NOT NULL,
  Apell_Prof varchar(50) NOT NULL,
  Fec_Nac date NOT NULL,
  Codigo_Carg_Prof varchar(50) NOT NULL,
  Codigo_Domina varchar(50) NOT NULL,
  Fec_Incres_T_Minis date NOT NULL,
  Email_Prof varchar(50) NOT NULL,
  Telf_Prof bigint(50) NOT NULL,
  Fec_Registro date NOT NULL
);

CREATE TABLE periodo (
  Id_Periodo integer primary key autoincrement,
  Nom_Periodo varchar(50) NOT NULL,
  Fec_Inicio varchar(50) NOT NULL,
  Fec_fin varchar(50) NOT NULL,
  Número_semanas varchar(50) NOT NULL,
  Estad_Periodo varchar(50) NOT NULL,
  Fec_Creación varchar(50) NOT NULL
);

CREATE TABLE materias (
  Id_Mat integer primary key autoincrement,
  Codigo_Mat varchar(20) NOT NULL,
  Nom_Mat varchar(50) NOT NULL,
  Descripción varchar(50) NOT NULL,
  Estado_Mat varchar(50) NOT NULL,
  Fec_Registro date NOT NULL,
  Id_Periodo integer NOT NULL,

  FOREIGN KEY (Id_Periodo) REFERENCES periodo(Id_Periodo)
);

CREATE TABLE nivel_estudio (
  Id_Nivel_estud integer primary key autoincrement,
  Nom_Nivel_estd varchar(50) NOT NULL
);

CREATE TABLE sección (
  Id_Seccion integer primary key autoincrement,
  Nom_Seccion varchar(50) NOT NULL,
  Estad_Seccion varchar(50) NOT NULL,
  Fec_Creacion date NOT NULL,
  Id_Nivel_estud integer NOT NULL,
  Numero_matriculas varchar(50) NOT NULL,
  Id_Periodo integer NOT NULL,

  FOREIGN KEY (Id_Nivel_estud) REFERENCES nivel_estudio(Id_Nivel_estud),
  FOREIGN KEY (Id_Periodo) REFERENCES periodo(Id_Periodo)
);

CREATE TABLE asignacion (
  Id_asignacion integer primary key autoincrement,
  Id_Prof integer NOT NULL,
  Id_Mat integer NOT NULL,
  Id_Nivel_estud integer NOT NULL,
  Id_Seccion integer NOT NULL,
  Id_Periodo integer NOT NULL,

  FOREIGN KEY (Id_Prof) REFERENCES profesor(Id_Prof),
  FOREIGN KEY (Id_Mat) REFERENCES materias(Id_Mat),
  FOREIGN KEY (Id_Nivel_estud) REFERENCES nivel_estudio(Id_Nivel_estud),
  FOREIGN KEY (Id_Seccion) REFERENCES sección(Id_Seccion),
  FOREIGN KEY (Id_Periodo) REFERENCES periodo(Id_Periodo)
);

CREATE TABLE momento (
  Id_Momento integer primary key autoincrement,
  Mes_inicio integer NOT NULL,
  Dia_inicio integer NOT NULL,
  Numero_Momento integer NOT NULL,
  Id_Periodo integer NOT NULL,

  FOREIGN KEY (Id_Periodo) REFERENCES periodo(Id_Periodo)
);

CREATE TABLE representante (
  Id_Repres integer primary key autoincrement,
  Ced_Repres varchar(50) NOT NULL,
  Apell_Repres varchar(50) NOT NULL,
  Nom_Repres varchar(50) NOT NULL,
  Fec_Nac date NOT NULL,
  Luga_Nac varchar(50) NOT NULL,
  Nacionalidad varchar(50) NOT NULL,
  Dir_Exac varchar(50) NOT NULL,
  Afin_con_Est varchar(50) NOT NULL,
  Email_Repres varchar(50) NOT NULL,
  Telf_Repres bigint(30) NOT NULL
);

CREATE TABLE estudiante (
  Id_Est integer primary key autoincrement,
  Ced_Est varchar(15) NOT NULL,
  Apell_Est varchar(50) NOT NULL,
  Nom_Est varchar(50) NOT NULL,
  Fec_Nac date NOT NULL,
  Luga_Nac varchar(50) NOT NULL,
  Nacionalidad varchar(50) NOT NULL,
  Dir_Exac varchar(50) NOT NULL,
  Id_Repres integer NOT NULL,

  FOREIGN KEY (Id_Repres) REFERENCES representante(Id_Repres)
);

CREATE TABLE boletines (
  Id_Boletin integer primary key autoincrement,
  Id_Momento integer NOT NULL,
  Id_Est integer NOT NULL,
  Id_Periodo integer NOT NULL,

  FOREIGN KEY (Id_Momento) REFERENCES momento(Id_Momento),
  FOREIGN KEY (Id_Est) REFERENCES estudiante(Id_Est),
  FOREIGN KEY (Id_Periodo) REFERENCES periodo(Id_Periodo)
);

CREATE TABLE seguridad (
  id integer primary key autoincrement,
  Cedula varchar(30) NOT NULL,
  Nombres varchar(50) NOT NULL,
  Apellidos varchar(50) NOT NULL,
  Usuario varchar(15) NOT NULL,
  password varchar(100) NOT NULL,
  Privilegio varchar(100) NOT NULL
);

CREATE TABLE calificaciones (
  Id_Calif integer primary key autoincrement,
  Calif_obtenid varchar(50) NOT NULL,
  Fec_Registro varchar(100) NOT NULL,
  Id_Mat integer NOT NULL,
  Id_Boletin integer NOT NULL,
  Id_Periodo integer NOT NULL,
  Id_usuario integer NOT NULL,

  FOREIGN KEY (Id_Mat) REFERENCES materias(Id_Mat),
  FOREIGN KEY (Id_Boletin) REFERENCES boletines(Id_Boletin),
  FOREIGN KEY (Id_Periodo) REFERENCES periodo(Id_Periodo),
  FOREIGN KEY (Id_usuario) REFERENCES seguridad(id)
);

CREATE TABLE datos_socioeconómico (
  Id_Dat_socio integer primary key autoincrement,
  Tipo_de_Vivienta varchar(50) NOT NULL,
  Condición_de_la_Vivienda varchar(50) NOT NULL,
  Condición_de_la_Infraestructura varchar(50) NOT NULL,
  Posee_Beca varchar(10) NOT NULL,
  Tipo_de_Beca varchar(10) NOT NULL,
  Posee_Canaima varchar(10) NOT NULL,
  Id_Est integer NOT NULL,

  FOREIGN KEY (Id_Est) REFERENCES estudiante(Id_Est)
);

CREATE TABLE inscripción (
  Id_Inscrip integer primary key autoincrement,
  Codigo_Inscrip varchar(20) NOT NULL,
  Fec_Inscrip timestamp NOT NULL DEFAULT current_timestamp,
  Id_Est integer NOT NULL,
  Id_Seccion integer NOT NULL,
  Id_Periodo integer NOT NULL,

  FOREIGN KEY (Id_Est) REFERENCES estudiante(Id_Est),
  FOREIGN KEY (Id_Seccion) REFERENCES sección(Id_Seccion),
  FOREIGN KEY (Id_Periodo) REFERENCES periodo(Id_Periodo)
);

insert into periodo (Id_Periodo, Nom_Periodo, Fec_Inicio, Fec_fin, `Número_semanas`, Estad_Periodo, `Fec_Creación`)
  values (1, '2024-2025', '2024-09-16', '2025-07-16', 40, 'activo', '2024-09-16');

insert into nivel_estudio (Id_Nivel_estud, Nom_Nivel_estd)
  values (1, '1° año'), (2, '2° año'), (3, '3° año'), (4, '4° año'), (5, '5° año');

insert into `sección` (Id_Seccion, Nom_Seccion, Estad_Seccion, Fec_Creacion, Id_Nivel_estud, Numero_matriculas, Id_Periodo)
  values
  (1, 'A', 'activo', '2024-09-16', 1, 19, 1),
  (2, 'A', 'activo', '2024-09-16', 2, 19, 1),
  (3, 'A', 'activo', '2024-09-16', 3, 19, 1),
  (4, 'A', 'activo', '2024-09-16', 4, 19, 1),
  (5, 'A', 'activo', '2024-09-16', 5, 19, 1);
