create table theme(
	id_theme int not null auto_increment primary key,
    name varchar(50) not null unique
);
create table image(
	id_img int not null primary key,
	image_data blob not null,
    id_user int not null,
    created_at TIMESTAMP default current_timestamp,
    updated_at TIMESTAMP default current_timestamp,
	foreign key (id_user) references user(id_user)
);
create table article(
	id_article int not null auto_increment primary key,
    title varchar(20) not null ,
    content text not null,
    status ENUM("Approved","Disapproved","Pending") default "pending",
    id_user int,
    id_img int,
    id_theme int,
    foreign key (id_user) references user(id_user),
    foreign key (id_img) references image(id_img),
    foreign key (id_theme) references theme(id_theme)
);

create table comment(
	id_comment int not null auto_increment primary key,
    content text not null,
	date TIMESTAMP default current_timestamp,
    id_article int ,
    foreign key (id_article) references article(id_article)
);

create table tag(
	id_tag int not null auto_increment primary key,
    name varchar(10) not null
);


create table tag_article(
	id_article int,
    id_tag int,
	foreign key (id_article) references article(id_article),
    foreign key (id_tag) references tag(id_tag)
);