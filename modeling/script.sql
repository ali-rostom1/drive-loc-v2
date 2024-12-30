create database drive_loc;
use drive_loc;

create table category(
	id_cat int not null auto_increment Primary key,
    name_cat varchar(50) not null unique,
	desc_cat varchar(255) not null unique
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


