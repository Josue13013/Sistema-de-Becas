DROP DATABASE IF EXISTS finanzas;
CREATE DATABASE IF NOT EXISTS finanzas;
USE finanzas;
create table universidad
(
idUniversidad int  AUTO_INCREMENT PRIMARY KEY,
nombre varchar (50) not null
) ENGINE = InnoDB;

create table facultad
(
idFacultad int  AUTO_INCREMENT PRIMARY KEY,
idUniversidad int not null,
nombre varchar (100) not null,
foreign key (idUniversidad) references universidad(idUniversidad) 
) ENGINE = InnoDB;

create table carrera
(
idCarrera int  AUTO_INCREMENT PRIMARY KEY,
idFacultad int not null,
nombre varchar (80) not null,
foreign key (idFacultad) references facultad(idFacultad)
) ENGINE = InnoDB;

create table estudiante
(
idEstudiante int  AUTO_INCREMENT PRIMARY KEY,
primerNombre varchar (50) not null,
segundoNombre varchar (50),
apellidoPaterno varchar (50) not null,
apellidoMaterno varchar (50) ,
ci varchar(20),
fechaNacimiento date not null,
genero Enum('Masculino','Femenino')
) ENGINE = InnoDB;

create table contrato
(
idContrato int AUTO_INCREMENT PRIMARY KEY,
idCarrera int (50) not null,
idEstudiante int(50) not null,
montoTotal float  not null,
saldoTotal float  not null,
foreign key (idCarrera) references carrera(idCarrera),
foreign key (idEstudiante) references estudiante(idEstudiante)
)ENGINE = InnoDB;

create table saldoContrato
(
idSaldoContrato int AUTO_INCREMENT PRIMARY KEY,
idContrato int (50) not null,
fechaPago DATE not null,
montoPago float  not null,
tipoPago varchar (50) not null,
foreign key (idContrato) references contrato(idContrato)
)ENGINE = InnoDB;