create table usuarios(
ci int primary key,
nombre varchar(45),
apellido varchar(45),
fecha_nac date,
estado boolean,
telf int
);

create table autos(
placa int primary key,
marca varchar(45),
modelo varchar(45),
color varchar(45),
estado boolean,
capacidad int
);

create table usuarios_autos(
user_auto_id int primary key,
ci int,
placa int,
foreign key(ci) references usuarios(ci),
foreign key(placa) references autos(placa)
);


create table tiempo(
t_id int,
fecha date
);
create table ruta_programada(
rut_prog_id int primary key,
user_auto_id int,
t_id int,
estado boolean,
calificacion double,
foreign key(user_auto_id) references usuarios_autos(user_auto_id),
foreign key(t_id) references tiempo(t_id)
);

create table ruta_prog_punto(
id_rut_prog_punto int primary key,
id_usuario int,
rut_prog_id int,
foreign key(id_usuario) references usuarios(ci),
foreign key(rut_prog_id) references ruta_programada(rut_prog_id)
);

create table puntos(
punto_id int primary key,
id_ruta int,
lat double,
longi double,
estado boolean,
foreign key(id_ruta) references ruta_prog_punto(id_rut_prog_punto)
);

create table solicitudes(
soli_id int primary key,
sender_id int,
receiver_id int,
rut_prog_id int,
fecha date,
estado boolean,
foreign key(sender_id) references usuarios(ci),
foreign key(receiver_id) references usuarios(ci),
foreign key(rut_prog_id) references ruta_programada(rut_prog_id)
);

create table integrantes(
integrante_id int primary key,
user_id int,
rut_prog_id int,
rol varchar(10),
foreign key(user_id) references usuarioS(ci),
foreign key(rut_prog_id) references ruta_programada(rut_prog_id)
);
create table calif_pasajero_a_conductor(
calif_pac_id int primary key,
rut_prog_id int,
pasajero_id int,
conductor_id int,
calificacion double,
foreign key(rut_prog_id) references ruta_programada(rut_prog_id),
foreign key(conductor_id) references integrantes(integrante_id),
foreign key(pasajero_id) references integrantes(integrante_id)
);
create table calif_conductor_a_pasajero(
calif_pac_id int primary key,
rut_prog_id int,
pasajero_id int,
conductor_id int,
calificacion double,
foreign key(rut_prog_id) references ruta_programada(rut_prog_id),
foreign key(conductor_id) references integrantes(integrante_id),
foreign key(pasajero_id) references integrantes(integrante_id)
);
create table prendas(
prenda_id int primary key,
nombre_prenda varchar(25),
estado boolean,
color varchar(25)
);

create table prenda_integrante(
prenda_integrante_id int primary key,
prenda_id int,
integrante_id int,
foreign key(prenda_id) references prendas(prenda_id),
foreign key(integrante_id) references integrantes(integrante_id)
);

create table punto_temp(
punto_temp_id int primary key,
integrante_id int,
soli_id int,
foreign key(integrante_id) references integrantes(integrante_id),
foreign key(soli_id) references solicitudes(soli_id)
);

create table calif_conductores(
usuario_id int primary key,
calf double
);

create table calif_pasajeros(
usuario_id int primary key,
calf double
);

create table tiempo(
t_id int primary key,
transaccion_id int,
fecha date
);

