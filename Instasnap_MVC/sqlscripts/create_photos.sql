create table app_photo (
    id int not null auto_increment,
    
    userid int not null,
    
    or_filename varchar(255) not null,
    
    sto_filename varchar(255) not null,
    
    description varchar(255) null,
    
    mime_type varchar(255) not null,
    
    visible tinyint(1) not null default 0,
    
    pinned tinyint(1) not null default 0,
    
    uploadtime timestamp not null default current_timestamp,
    
    
    CONSTRAINT UC_App_Photo UNIQUE (id,sto_filename),
    primary key (id),
    FOREIGN KEY (userid) REFERENCES app_usuario(id),
    
    ON UPDATE CASCADE ON DELETE CASCADE
    
) engine = innodb
  character set utf8
  collate utf8_general_ci;