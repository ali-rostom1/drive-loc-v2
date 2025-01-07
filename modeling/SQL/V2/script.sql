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
    foreign key (id_article) references article(id_article) ON DELETE CASCADE
);

create table tag(
	id_tag int not null auto_increment primary key,
    name varchar(10) not null
);


create table tag_article(
	id_article int,
    id_tag int,
	foreign key (id_article) references article(id_article) ON DELETE CASCADE,
    foreign key (id_tag) references tag(id_tag) ON DELETE CASCADE
);
create table favorite(
	id_fav int not null primary key,
    id_user int,
    id_article int
);

alter table theme add column description varchar(255);


insert into theme(name,description) values
("Maintenance and Repair","Articles about car maintenance, repair, and troubleshooting."),
("Car Reviews and Comparisons","Articles that review and compare different car models, their features, and performance.
"),
("Driving Tips and Safety","Articles that provide tips and advice on safe driving practices, road safety, and defensive driving."),
("Car Culture and Lifestyle","Articles about car-related culture, lifestyle, and community, such as car shows, racing, and car ownership experiences."),
("Technology and Innovation","Articles about the latest car technologies, innovations, and advancements in the automotive industry.");


alter table tag modify column name varchar(50);

INSERT INTO tag (name)
VALUES 
('Car News'),
('Car Reviews'),
('Car Shows'),
('Sedans'),
('SUVs'),
('Trucks'),
('Electric/Hybrid'),
('Racing Cars'),
('DIY Maintenance'),
('Car Troubleshooting'),
('Mechanic Recommendations'),
('Parts and Accessories'),
('Tuning and Performance'),
('Engine Modifications'),
('Suspension and Brakes'),
('Exterior and Interior Upgrades'),
('Used Car Market'),
('Car Buying Tips'),
('Car Selling Advice'),
('Trade-In and Financing'),
('Roadside Assistance'),
('Car Safety Features'),
('Accident Prevention'),
('Emergency Procedures'),
('Personal Stories'),
('Car Culture and History'),
('Travel and Adventure');



