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

alter table vehicle
modify img_path varchar(255);
insert into vehicle(model_vehicle,desc_vehicle,brand_vehicle,price,available,img_path,id_cat) values
("Chevrolet Equinox 2005","Lorem ipsum dolor, sit amet consectetur adipisicing elit.","chevrolet","55.00",1,"https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDMwfHxzcG9ydHMlMjBjYXJ8ZW58MHx8fHwxNjMxNjg3MzQ4&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop",1);

insert into vehicle(model_vehicle,desc_vehicle,brand_vehicle,price,available,img_path,id_cat) values
("Ferrari 458 Spider 2015","Loem ipsum dolor, sit amet consectetur adipisicing elit.","Ferrari","80.00",1,"https://images.unsplash.com/photo-1546768292-fb12f6c92568?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDk5fHxjYXIlMjBjb252ZXJ0aWJsZXxlbnwwfHx8fDE2MzE2ODUxMzA&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop",1);

insert into category(name_cat,desc_cat,img_url) values
("Sedans","Lorem ipsum dolo, sit amet consectetur adipisicing elit.","https://images.unsplash.com/photo-1619767886558-efdc259cde1a?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDMyM3x8c3V2fGVufDB8fHx8MTYzMTY4Njc4Nw&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop");

insert into category(name_cat,desc_cat,img_url) values
("SUVs","Lor ipsum dolo, sit amet consectetur adipisicing elit.","https://images.unsplash.com/photo-1511527844068-006b95d162c2?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDQzfHxjYXIlMjBzdXZ8ZW58MHx8fHwxNjMxNjg0ODkw&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop");

insert into category(name_cat,desc_cat,img_url) values
("Convertibles","Lor ipsum dolo, sit amet consectetur adiping elit.","https://images.unsplash.com/photo-1597210159614-966c9f632c89?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDh8fGNhciUyMGNvbnZlcnRpYmxlfGVufDB8fHx8MTYzMTY4NTExMA&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop");

insert into vehicle(model_vehicle, desc_vehicle, brand_vehicle, price, available, img_path, id_cat) values
("Toyota Camry 2022", "Lorem isum dolor, sit amet consectetur pisicing elit.", "Toyota", "35.00", 1, "https://images.unsplash.com/photo-1597003331982-28a2a2d6a5e6?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDE4fHxzZWRhbnN8ZW58MHx8fHwxNjMxNjg1Njgw&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop", 3);

insert into vehicle(model_vehicle, desc_vehicle, brand_vehicle, price, available, img_path, id_cat) values
("Honda Accord 2021", "Lorem ipsum dolor, sit consecttur adipisicing elit.", "Honda", "32.00", 1, "https://images.unsplash.com/photo-1578472177117-c6df5a2c5c08?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDI5fHxzZWRhbnN8ZW58MHx8fHwxNjMxNjg1NzI0&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop", 3);

insert into vehicle(model_vehicle, desc_vehicle, brand_vehicle, price, available, img_path, id_cat) values
("Jeep Wrangler 2022", "Lorem ipsum dolor, sitet consectetur asicng elit.", "Jeep", "60.00", 1, "https://images.unsplash.com/photo-1610964508973-42527f236c03?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDQ5fHxzdXZzfGVufDB8fHx8MTYzMTY4NTkxMA&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop", 4);

insert into vehicle(model_vehicle, desc_vehicle, brand_vehicle, price, available, img_path, id_cat) values
("Ford Explorer 2023", "Lorem ipsum dolor, sit aet consectetur aisicing elit.", "Ford", "50.00", 1, "https://images.unsplash.com/photo-1613922657544-8ccbedf00f09?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDQ5fHxzdXZzfGVufDB8fHx8MTYzMTY4NTkyMQ&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop", 4);

insert into vehicle(model_vehicle, desc_vehicle, brand_vehicle, price, available, img_path, id_cat) values
("BMW Z4 2023", "Lor ipsum dolor, sit amet consectetur adipising elit.", "BMW", "70.00", 1, "https://images.unsplash.com/photo-1579540583154-9d493b0e8455?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDIwfHxjb252ZXJ0aWJsZXxlbnwwfHx8fDE2MzE2ODYwMzA&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop", 5);

insert into vehicle(model_vehicle, desc_vehicle, brand_vehicle, price, available, img_path, id_cat) values
("Mazda MX-5 Miata 2022", "Lorem ipsum dolor, sit amet consectetur adipisicng elit.", "Mazda", "65.00", 1, "https://images.unsplash.com/photo-1580922404516-dcf09fd24e2e?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDE5fHxjb252ZXJ0aWJsZXxlbnwwfHx8fDE2MzE2ODYwNDU&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=600&h=450&fit=crop", 5);

insert into role(name_role) values("client"),("admin");

insert into rating(value_rating,id_vehicle) values
(3,8),
(5,1),
(3,1),
(4,8),
(5,8),
(5,10);


CREATE VIEW ListeVehicules AS
SELECT 
    v.id_vehicle AS VehicleID,
    v.model_vehicle AS Model,
    v.desc_vehicle AS Description,
    v.brand_vehicle AS Brand,
    v.price AS PricePerDay,
    v.available AS Availability,
    v.img_path AS ImagePath,
    c.name_cat AS Category,
    c.desc_cat AS CategoryDescription,
    AVG(r.value_rating) AS AverageRating,
    COUNT(r.id_rating) AS TotalRatings
FROM 
    vehicle v
LEFT JOIN 
    category c ON v.id_cat = c.id_cat
LEFT JOIN 
    rating r ON v.id_vehicle = r.id_vehicle
GROUP BY 
    v.id_vehicle, v.model_vehicle, v.desc_vehicle, v.brand_vehicle, 
    v.price, v.available, v.img_path, c.name_cat, c.desc_cat;

select * from ListeVehicules;

DELIMITER $$
CREATE PROCEDURE AjouterReservation(
    IN p_date_reservation DATE,
    IN p_id_user INT,
    IN p_id_vehicle INT,
    OUT p_message VARCHAR(255)
)
BEGIN
    DECLARE v_available TINYINT;

    -- Vérifier si le véhicule est disponible
    SELECT available INTO v_available
    FROM vehicle
    WHERE id_vehicle = p_id_vehicle;

    IF v_available = 1 THEN
        INSERT INTO reservations (date_reservation, status, id_user, id_vehicle)
        VALUES (p_date_reservation, 'Pending', p_id_user, p_id_vehicle);

        SET p_message = 'reservation success.';
    ELSE
        SET p_message = 'vehicule not available';
    END IF;
END$$
DELIMITER ;

CALL AjouterReservation('2025-01-10', 1, 3, @message);
SELECT @message;
