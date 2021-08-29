CREATE TABLE IDEAS (
	id int not null primary key auto_increment,
	idk varchar(50) unique key,
	id_madre int not null default '0',
	titulo varchar(255) not null default 'Título No asignado',
	descripcion text null,
	contenido text null,
	alta datetime null,
	ultimo timestamp not null default CURRENT_TIMESTAMP,
	id_autor int null
);