
-- DROP DATABASE proyecto;
CREATE DATABASE proyecto
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Spanish_Costa Rica.1252'
    LC_CTYPE = 'Spanish_Costa Rica.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;
	
--Database: proyecto;

select * from roles;
create table roles
(
	idRole int primary key GENERATED ALWAYS AS IDENTITY,
	descripcionRole varchar(256),
	--Sección de los permisos
	agregarMiembro int,
	eliminarMiembro int,
	administrarPuntos int,
	administrarAdministrativo int,
	administrarPresidente int,
	proponerPuntos int
);
select * from miembro;
update miembro set rol = 2 where idmiembro = 25;
ALTER TABLE roles ADD COLUMN puntos_Agenda int;
ALTER TABLE roles ADD COLUMN aceptar_Ausencias int;
ALTER TABLE roles ADD COLUMN iniciar_Sesion int;
select * from roles;
update roles set aceptar_ausencias=0 where idrole>0;
update roles set aceptar_ausencias=1 where idrole=1 or idrole=2;
update roles set iniciar_Sesion=0 where idrole>0;
update roles set iniciar_Sesion=1 where idrole=1 or idrole=2;
/*update roles set iniciar_Sesion=0 where idrole>0;
update roles set iniciar_Sesion=1 where idrole=1 or idrole=2;
select * from roles;*/
/*select * from miembro;
delete from miembrosconvocados where idmiembrosconvocados>0;
delete from punto_agenda where id_punto>0;
delete from miembro where idmiembro > 4;
delete from events where id>0;*/
select * from miembro;
create table miembro
(
	idMiembro int primary key GENERATED ALWAYS AS IDENTITY,
	nombreMiembro varchar(50),
	apellido1Miembro varchar(50),
	apellido2Miembro varchar(50),
	correo varchar(200),
	contrasenna varchar(200),
	rol int,
	FOREIGN KEY (rol) REFERENCES roles (idRole)
);
select * from miembro;
insert into correos_registrados (id_miembro, correo) values (1,'manuelitojm28@gmail.com');

-- Añadido
create table correos_registrados
(
	id_correo_registrado int primary key GENERATED ALWAYS AS IDENTITY,
	id_miembro int,
	correo varchar(200),
	FOREIGN KEY (id_miembro) REFERENCES miembro (idmiembro)
);

--Fin añadido

select * from correos_registrados;

create table tipo_sesion
(
	id int,
	nombre varchar(256)
);

create table events
(
	id int primary key GENERATED ALWAYS AS IDENTITY,
	lugar varchar(256),
	hora time,
	fecha date,
	tipo_sesion int,
	FOREIGN KEY (tipo_sesion) REFERENCES tipo_sesion (id)
);
select * from events;
ALTER TABLE events ADD COLUMN punto_activo int;--Siempre inicia en 0
ALTER TABLE events ADD COLUMN estaActivo int;--0 va a ser si no está activo, 1 si lo está y 2 si ya se cerró la sesion
ALTER TABLE events ADD COLUMN direccion_archivo varchar(1024);
ALTER TABLE events ADD COLUMN horainicio time;
ALTER TABLE events ADD COLUMN horafin time;

--select * from events;
select * from miembro;
update miembro set nombremiembro='Estudiante1' where idmiembro=26;
update miembro set nombremiembro='Estudiante2' where idmiembro=27;
update miembro set nombremiembro='Estudiante3' where idmiembro=28;

update miembro set nombremiembro='Profesor1' where idmiembro=29;
update miembro set nombremiembro='Profesor2' where idmiembro=30;
update miembro set nombremiembro='Profesor3' where idmiembro=31;
update events set horainicio = 'NOW()' where id=73;
--update events set estaactivo=0 where id=32;

/*select * from votaciones_por_miembro;
insert into votaciones_por_miembro (id_punto,idmiembro,estado) values (6,1,0),(6,1,1),(6,1,2),(6,1,0),(6,1,1),(6,1,2),
																	(6,1,0),(6,1,1),(6,1,2),(6,1,0),(6,1,1),(6,1,2),
																	(6,1,0),(6,1,1),(6,1,2),(6,1,0),(6,1,1),(6,1,2),
																	(6,1,0),(6,1,1),(6,1,2),(6,1,0),(6,1,1),(6,1,2),
																	(6,1,0),(6,1,1),(6,1,2),(6,1,0),(6,1,1),(6,1,2),
																	(6,1,0),(6,1,1),(6,1,2),(6,1,0),(6,1,1),(6,1,2);
delete from votaciones_por_miembro where id_votaciones_miembro>3;*/
create table votaciones_por_miembro
(
	id_votaciones_miembro int primary key GENERATED ALWAYS AS IDENTITY,
	id_punto int,
	idmiembro int,
	estado int--,-- 0 => favor, 1 => contra, 2 => Abstinencia
	--FOREIGN KEY (id_punto) REFERENCES punto_agenda (id_punto),
	--FOREIGN KEY (idmiembro) REFERENCES miembro (idmiembro)
);
delete from votaciones_por_miembro where id_votaciones_miembro>0;
select * from votaciones_por_miembro;
select * from votaciones_puntos;
delete from votaciones_puntos where idvotacionespuntos>0;

select * from votaciones_puntos;

create table votaciones_puntos--Se va a utilizar para hacer la arquitectura observer
(
	idVotacionesPuntos int primary key GENERATED ALWAYS AS IDENTITY,
	idPunto int,
	estaActivo int,--Si es 0 no está activo, si lo está es un 1
	favor int,
	contra int,
	FOREIGN KEY (idPunto) REFERENCES punto_agenda (id_punto)
);

ALTER TABLE votaciones_puntos ADD COLUMN abstinencia int;
--ALTER TABLE votaciones_puntos drop COLUMN visibilidad;
update votaciones_puntos set visibilidad=1 where idvotacionespuntos>0;
select * from votaciones_puntos;
delete from votaciones_puntos where idvotacionespuntos=5  or idvotacionespuntos=7;




select * from events;
--update events set estaactivo = 0 where id=72;

select *  from punto_agenda;
--update events set punto_Activo=1 where id=32;
CREATE TABLE punto_agenda(
    id_punto integer NOT NULL,
    titulo character varying,
    fecha date,
    miembro character varying,
    considerando text,
    acuerda text
);
select * from punto_agenda;

ALTER TABLE punto_agenda ADD COLUMN estado boolean;
ALTER TABLE punto_agenda ADD COLUMN punto_para_agenda int;
ALTER TABLE punto_agenda ADD CONSTRAINT punto_para FOREIGN KEY (punto_para_agenda)
REFERENCES events (id);
ALTER TABLE punto_agenda ALTER COLUMN miembro TYPE int USING miembro::integer;
ALTER TABLE punto_agenda ADD CONSTRAINT miembro FOREIGN KEY (miembro) REFERENCES miembro (idMiembro);



insert into roles (descripcionRole, agregarMiembro, eliminarMiembro, administrarPuntos, administrarAdministrativo, administrarPresidente, proponerPuntos)
values ('Presidente', 1, 1, 1, 1, 0, 1);
insert into roles (descripcionRole, agregarMiembro, eliminarMiembro, administrarPuntos, administrarAdministrativo, administrarPresidente, proponerPuntos)
values ('Administrativo', 1, 1, 1, 1, 0, 1);
insert into roles (descripcionRole, agregarMiembro, eliminarMiembro, administrarPuntos, administrarAdministrativo, administrarPresidente, proponerPuntos)
values ('Miembro', 0, 0, 0, 0, 0, 1);
insert into roles (descripcionRole, agregarMiembro, eliminarMiembro, administrarPuntos, administrarAdministrativo, administrarPresidente, proponerPuntos)
values ('Miembro2', 0, 0, 0, 0, 2, 1);



create table miembrosConvocados
(
	idMiembrosConvocados int primary key GENERATED ALWAYS AS IDENTITY,
	idEventoConvocado int,
	idMiembroConvocado int,
	convocado int,/*1 si esta convocado, 0 si no*/
	foreign key (idMiembroConvocado) references miembro (idmiembro),
	foreign key (idEventoConvocado) references events (id)
);



select * from miembrosconvocados inner join events on ideventoconvocado=id;


create table adjuntos_punto (
    id_punto int,
    ruta varchar(1024),
    nombre varchar(200),
    tipo varchar(50),
	CONSTRAINT adjuntos_punto_pkey PRIMARY KEY (id_punto, ruta),
	CONSTRAINT adjuntos_punto_id_punto_fkey FOREIGN KEY (id_punto) REFERENCES punto_agenda(id_punto)
);
select * from miembro;

create table reseteo_contrasennas
(
	idreseteo int primary key GENERATED ALWAYS AS IDENTITY,
	correo varchar(200),
	tokenreseteo varchar(300)
);
-- Adicion
create table ausencias
(
	idAusencia int primary key GENERATED ALWAYS AS IDENTITY,
	fechaInicio date,
	fechaFin date,
	motivo varchar(256),
	idMiembro int,
	estado int
);
ALTER TABLE ausencias ADD CONSTRAINT ausenciaPara FOREIGN KEY (idMiembro)
REFERENCES miembro (idMiembro);

create table eventosActivos
(
	idEventosActivos int,
	idEvento int
);


SELECT to_char(NOW(), 'DD/MM/YYYY HH24:MI:SS');
select idbitacora, descripcion, identificadorusuario, to_char( hora, 'day DD/MM/YYYY HH24:MI:SS') from bitacora;
select idbitacora, descripcion, identificadorusuario, hora from bitacora;
create table bitacora
(
	idbitacora int primary key GENERATED ALWAYS AS IDENTITY,
	descripcion varchar(512),
	identificadorusuario int, --No va a tener referencias por que se puede eliminar muchas veces
	hora timestamp
);
select * from asistencia_a_evento;
delete from asistencia_a_evento where id_asistencia_a_evento>0;
create table asistencia_a_evento
(
	id_asistencia_a_evento int primary key GENERATED ALWAYS AS IDENTITY,
	id_usuario int,
	id_evento int,
	estado int --0=> Ausente, 1=> Presente
);
select * from miembro;


/*select * from ausencias;

--update ausencias set estado=false where idausencia>0;



insert into roles (descripcionRole, agregarMiembro, eliminarMiembro,
				   administrar
				   , administrarAdministrativo, administrarPresidente, proponerPuntos)
values ('No Agregar Miembro', 0, 1, 1, 1, 0, 1);
insert into roles (descripcionRole, agregarMiembro, eliminarMiembro,
				   administrarPuntos, administrarAdministrativo, administrarPresidente, proponerPuntos)
values ('No Visualizar Miembro', 1, 0, 1, 1, 0, 1);
insert into roles (descripcionRole, agregarMiembro, eliminarMiembro,
				   administrarPuntos, administrarAdministrativo, administrarPresidente, proponerPuntos)
values ('No Administrar Puntos', 1, 1, 0, 1, 0, 1);
insert into roles (descripcionRole, agregarMiembro, eliminarMiembro,
				   administrarPuntos, administrarAdministrativo, administrarPresidente, proponerPuntos)
values ('No Administrar Administrativos', 1, 1, 1, 0, 0, 1);
insert into roles (descripcionRole, agregarMiembro, eliminarMiembro,
				   administrarPuntos, administrarAdministrativo, administrarPresidente, proponerPuntos)
values ('No Proponer Puntos', 1, 1, 1, 1, 0, 0);

select * from miembro inner join roles on idrole=rol;*/
	/*delete from miembro where idmiembro=22 or idmiembro=21 or idmiembro=12 or idmiembro=11 or idmiembro=10
	 or idmiembro=9 or idmiembro=8 or idmiembro=7 or idmiembro=6 or idmiembro=5 or idmiembro=20
	  or idmiembro=19;
	select * from miembrosconvocados;
	delete from miembrosconvocados where convocado=1 or convocado=0;
	select * from punto_agenda;
	delete from punto_agenda where estado=true;
	select * from roles;
	select * from roles;
update roles set puntos_agenda=0 where idrole>0;
update roles set puntos_agenda=1 where idrole=4;
select * from miembro;
update miembro set correo='manuelitojm28@gmail.com' where idmiembro=1;
update miembro set correo='mlucio.alt@gmail.com' where idmiembro=4;

*/

/*update miembro set rol=5  where idmiembro=1;--No agrega Miembro
update miembro set rol=6  where idmiembro=1;--No visualiza Miembro
update miembro set rol=7  where idmiembro=1;--No administra puntos
update miembro set rol=8  where idmiembro=1;--No administra admin
update miembro set rol=9  where idmiembro=1;--No propone puntos


select * from miembro as m
inner join ausencias as a on m.idmiembro = a.idmiembro;*/

-- Primero se deben seleccionar todas las ausencias que tengan como el día de la reunion
-- El resto se hace 
/*select * from ausencias as a
inner join miembro as m on m.idmiembro = a.idmiembro
where (a.fechainicio<='2019-10-15' and a.fechafin>='2019-10-15');-- or a.fechainicio='2019-10-20' or a.fechafin='2019-10-20';
*/
--select * from miembro;
--insert into 

/*drop table reseteocontrasennas;
drop table password_resets;
select * from users;*/

--select * from punto_agenda;
/*select * from events;
select * from miembrosconvocados;
select * from punto_agenda ;*/
delete from miembrosconvocados where idmiembrosconvocados>0;
delete from punto_agenda where id_punto>0;
delete from miembro where idmiembro>3;


