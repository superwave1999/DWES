create database nombrebd
  default character set utf8
  collate utf8_general_ci;
  
create user usuariobd@localhost
  identified by 'clavebd';

grant all
  on nombrebd.*
  to usuariobd@localhost;

flush privileges;

create table app_usuario (
    id int not null auto_increment,
    correo varchar(255) not null,
    alias varchar(255) null,
    nombre varchar(255) not null,
    clave varchar(255) not null,
    activo tinyint(1) not null default 0,
    administrador tinyint(1) not null default 0,
    fechaalta timestamp not null default current_timestamp,
    
    CONSTRAINT UC_App_User UNIQUE (correo,alias),
    primary key (id)
) engine = innodb
  character set utf8
  collate utf8_general_ci;