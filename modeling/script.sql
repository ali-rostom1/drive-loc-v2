create database drive_loc;
use drive_loc;

create table category(
	id_cat int not null auto_increment Primary key,
    name_cat varchar(50) not null unique,
	desc_cat varchar(255) not null unique,
    img_url varchar(255) not null
);

create table vehicle(
	id_vehicle int not null auto_increment primary key,
    model_vehicle varchar(50) not null unique,
    desc_vehicle varchar(255) not null unique,
	brand_vehicle varchar(10) not null ,
    price decimal(10,2) not null ,
    available tinyint(1) not null default 0,
    img_path varchar(50) default("assets/images/vehicle_placeholder.png"),
    id_cat int,
    foreign key (id_cat) references category(id_cat) on delete cascade
);

create table role(
	id_role int not null auto_increment primary key,
    name_role varchar(50) not null unique
);

create table user(
	id_user int not null auto_increment primary key,
    name_user varchar(50) not null unique,
    email_user varchar(50) not null unique,
    password_user varchar(255) not null,
    id_role int,
    foreign key (id_role) references role(id_role) on delete cascade
);

create table reservations(
	id_reservation int not null auto_increment primary key,
    date_reservation date not null,
    status enum("Accepted","Declined","Pending"),
    id_user int,
    id_vehicle int,
    foreign key (id_user) references user(id_user),
    foreign key (id_vehicle) references vehicle(id_vehicle)
);

create table rating(
	id_rating int not null auto_increment primary key,
    value_rating tinyint default 0,
    id_vehicle int,
    foreign key (id_vehicle) references vehicle(id_vehicle),
    check(value_rating between 0 and 5)
);

create table rating_user_relation(
	rating_id int,
    user_id int,
    foreign key (rating_id) references rating(id_rating) on delete cascade,
    foreign key (user_id) references user(id_user)on delete cascade
);


insert into category(name_cat,desc_cat,img_url) values
("Sports Cars","Lorem ipsum dolor, sit amet consectetur adipisicing elit.","https://images.unsplash.com/photo-1619767886558-efdc259cde1a?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDMyM3x8c3V2fGVufDB8fHx8MTYzMTY4Njc4Nw&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop");

insert into vehicle(model_vehicle,desc_vehicle,brand_vehicle,price,available,img_path,id_cat) values
("Chevrolet Equinox 2005","Lorem ipsum dolor, sit amet consectetur adipisicing elit.","chevrolet","55.00","https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDMwfHxzcG9ydHMlMjBjYXJ8ZW58MHx8fHwxNjMxNjg3MzQ4&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop",1);