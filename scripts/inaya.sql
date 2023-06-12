create table if not exists roles (
    id int(10) primary key auto_increment,
    name varchar(255) not null unique
);

insert into roles(name) values ("admin");
insert into roles(name) values ("owner");
insert into roles(name) values ("visitor");
insert into roles(name) values ("employee");

create table if not exists users (
    id int(10) primary key NOT NULL auto_increment,
    dni varchar(9) not null unique,
    name varchar(255) not null,
    username varchar(255) not null,
    photo varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    forgot_password varchar(255) default NULL,
    role_id int(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP,
    constraint FK_rol_user foreign key (role_id) references roles(id)
);

insert into users (dni, name, username, photo, email, password, role_id) 
values ("29628253K", 'Victoria Almeida Calderon', "viky2000", "./views/style1/img/users/default.png", "viky2000.22@gmail.com", "$2y$10$clMqejJUeGBkRQ6jai1y3O/Z4cEpJsgzukaF9uVgrRSShTCSqUG/G", 1);
insert into users (dni, name, username, photo, email, password, role_id) 
values ("51166930A", 'Elia Rodriguez Lorenzo', "EliaRL", "./views/style1/img/users/default.png", "elia.rodriguez.lorenzo@gmail.com", "$2y$10$clMqejJUeGBkRQ6jai1y3O/Z4cEpJsgzukaF9uVgrRSShTCSqUG/G", 2);
insert into users (dni, name, username, photo, email, password, role_id) 
values ("84991641V", 'Izan Torregrosa Fuentes', "IzanTF", "./views/style1/img/users/default.png", "izan.torregrosa.fuentes@gmail.com","$2y$10$clMqejJUeGBkRQ6jai1y3O/Z4cEpJsgzukaF9uVgrRSShTCSqUG/G", 3);

create table categories (
    id int(10) primary key NOT NULL auto_increment,
    name varchar(255) not null unique,
    description varchar(255) not null,
    photo varchar(255) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP
);

insert into categories (id, name, description, photo) 
values (1, "Restaurante", "En esta categoria aparecerán todos los lugares en los que ir a comer", "./views/style1/img/categories/restaurante.png");
insert into categories (id, name, description, photo) 
values (2, "Moda", "En esta categoria aparecerán todos los lugares en los que ir a comprar ropa", "./views/style1/img/categories/moda.png");

create table establishments (
    id int(10) primary key NOT NULL auto_increment,
    name varchar(255) not null unique,
    description varchar(255) not null,
    AboutUs varchar(255) default null,
    category_id int(10) not null,
    owner int (10) not null,
    logo varchar(255) not null,
    tlf varchar(12) not null,
    email varchar(50) not null,
    web_site varchar(255) default null,  
    slug varchar(15) not null,  
    color varchar(255) default 'black',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP,
    constraint FK_category_establishment foreign key (category_id) references categories(id),
    constraint FK_user_establishment foreign key (owner) references users(id)
);

insert into establishments (name, description, AboutUs, category_id, owner, logo, tlf, email, web_site, slug) values
("Galerias abreu",
"📦Pedidos por MD o whatsapp📲628555012 <br> ➡️Envio GRATIS compras superiores a 50€ 📞959321019<br>📍Ayamonte,Huelva📍➡️C/Paseo de la ribera,4",
"Tienda de ropa con mas de 20 años en el sector, ubicado en Ayamonte(Huelva), disponemos de las marcas mas conocidas en zapatos y ropa.",
2,2,"./views/style1/img/establishment/galerias_abreu.jpg", "+34628555012", "galerias_abreu@gmail.com", null, "galerias-abreu");
insert into establishments (name, description, AboutUs, category_id, owner, logo, tlf, email, web_site, slug) values
("LPA the culinary bar",
"📦Reserva en el numero 📲628555012 o en nuestra web <br> 📍Ayamonte,Huelva📍➡️ Plaza la Lota, 10",
"LPA es un restaurante ubicado en plaza de la lota en ayamonte(Huelva), nuestra amplia carta y nuevas tendencias en cocina moderna hace un espectaculo al paladar, acompañado de un entorno agradable funde tus sentidos a un gran nivel de placer.<br> Acompañanos en LPA y satiface tus sentidos",
1,2,"./views/style1/img/establishment/LPA.jpg", "+34633667603", "theculinarybar@gmail.com", "https://lpatheculinarybar.myrestoo.net/en/reservar", "lpa-culinary-bar");


create table if not exists sections(
    id int(10) primary key NOT NULL auto_increment,
    name varchar(255) not null unique,
    file varchar(255) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP             
);

create table if not exists formats (
    id int(10) primary key NOT NULL auto_increment,
    format varchar(255) not null unique,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP
);

insert into formats (format) values ('txt');
insert into formats (format) values ('img');

create table if not exists data (
    id int(10) primary key NOT NULL auto_increment,
    datum varchar(255) not null unique,
    format_id int(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp default CURRENT_TIMESTAMP,
    constraint FK_format_data foreign key (format_id) references formats(id)
);

create table if not exists style_establishment (
    establishments_id int(10),
    data_id int(10),
    sections_id int(10),
    constraint PK_establishment_data_sections primary key (establishments_id,data_id,sections_id),
    constraint FK_establishment_style foreign key (establishments_id) references establishments(id),
    constraint FK_data_style foreign key (data_id) references data(id),
    constraint FK_section_styleEstablishment foreign key (sections_id) references sections(id)
);

create table if not exists style_category (
    section_id int(10),
    category_id int(10),
    constraint PK_category_section primary key (section_id, category_id),
    constraint FK_category_style foreign key (category_id) references categories(id),
    constraint FK_section_styleCategory foreign key (section_id) references sections(id)
);