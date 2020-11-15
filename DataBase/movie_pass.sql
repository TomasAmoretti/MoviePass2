/*
Database - MoviePass
*/
CREATE DATABASE movie_pass;
USE movie_pass;
#drop database movie_pass;


CREATE TABLE IF NOT EXISTS Users(

    id_user INT auto_increment,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    dni VARCHAR(15) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    role VARCHAR(15) NOT NULL,
    id_facebook varchar(100),

    CONSTRAINT pk_id_users PRIMARY KEY(id_user),
    CONSTRAINT unq_dni UNIQUE(dni),
    CONSTRAINT unq_email UNIQUE(email),
	CONSTRAINT chk_rol CHECK (role = 'admin' OR role = 'client') );

CREATE TABLE IF NOT EXISTS Cinemas(

    id_cinema INT auto_increment,
    cinema_name VARCHAR(50) NOT NULL,
    adress VARCHAR (50) NOT NULL,
    state BOOLEAN NOT NULL,

    CONSTRAINT pk_id_cinemas PRIMARY KEY (id_cinema),
    CONSTRAINT unq_cinema_name UNIQUE (cinema_name));

CREATE TABLE IF NOT EXISTS Rooms(

    id_room INT auto_increment,
    id_cinema INT ,
    room_name VARCHAR(50) NOT NULL,
    capacity INT NOT NULL,
    price INT NOT NULL,
    state BOOLEAN,

    CONSTRAINT pk_id_rooms PRIMARY KEY (id_room),
    CONSTRAINT fk_id_cinema FOREIGN KEY (id_cinema) REFERENCES Cinemas(id_cinema));


CREATE TABLE IF NOT EXISTS Movies(

    id_movie INT auto_increment,
    id_api INT,
    title VARCHAR(100) NOT NULL,
    overview VARCHAR(500) NOT NULL,
    duration INT NOT NULL,
    poster VARCHAR(100),
    background VARCHAR(100),
    score FLOAT,
    release_date date,

    CONSTRAINT pk_id_movies PRIMARY KEY (id_movie),
    CONSTRAINT unq_id_api UNIQUE (id_api));


CREATE TABLE IF NOT EXISTS Genres(

    id_genre INT auto_increment,
    id_api INT,
    name_genre VARCHAR(100) NOT NULL,

    CONSTRAINT pk_id_genres PRIMARY KEY (id_genre),
    CONSTRAINT unq_id_api UNIQUE (id_api));


CREATE TABLE IF NOT EXISTS Genres_for_Movie(

    id_movie INT,
    id_genre INT,

    CONSTRAINT pk_id_genres_for_movie PRIMARY KEY (id_movie, id_genre),
    CONSTRAINT fk_genres_for_movie_movies FOREIGN KEY (id_movie) REFERENCES Movies(id_movie),
    CONSTRAINT fk_genres_for_movie_genres FOREIGN KEY (id_genre) REFERENCES Genres(id_genre));


CREATE TABLE IF NOT EXISTS Shows(

    id_show INT auto_increment,
    id_room INT ,
    id_movie INT,
    day VARCHAR(10),
    hour VARCHAR (10),
    state BOOLEAN,

    CONSTRAINT pk_id_show PRIMARY KEY (id_show),
    CONSTRAINT fk_id_room FOREIGN KEY (id_room) REFERENCES Rooms(id_room));



CREATE TABLE IF NOT EXISTS Purchases(

    id_purchase INT auto_increment,

    id_user INT ,
    id_show INT,
    count_tickets INT ,
    discount INT ,
    date_purchase date ,
    total INT ,

    CONSTRAINT pk_id_purchases PRIMARY KEY (id_purchase),
    CONSTRAINT fk_id_users FOREIGN KEY (id_user) REFERENCES Users(id_user),
    CONSTRAINT fk_id_shows FOREIGN KEY (id_show) REFERENCES Shows(id_show));


CREATE TABLE IF NOT EXISTS Tickets(
    
    id_ticket INT auto_increment,
    id_purchase INT NOT NULL,
    id_show INT NOT NULL,
    numbre_ticket INT NOT NULL,
    qr mediumblob,

    CONSTRAINT pk_id_ticket PRIMARY KEY (id_ticket),
    CONSTRAINT fk_id_purchase FOREIGN KEY (id_purchase) REFERENCES Purchases(id_purchase),
    CONSTRAINT fk_id_show FOREIGN KEY (id_show) REFERENCES Shows(id_show));





/* ------- Stored Procedure ------- */

/* ----- Users ----- */
#DROP procedure IF EXISTS `Users_GetByEmail`;
DELIMITER $$
CREATE PROCEDURE Users_GetByEmail (IN email VARCHAR(100))
BEGIN
	SELECT u.id_user, u.email, u.password, u.firstName, u.lastName, u.dni, u.role
    FROM Users u
    WHERE (u.email = email);
END$$
DELIMITER ;
#call movie_pass.Users_GetByEmail("admin@moviepass.com");

#DROP procedure IF EXISTS Users_Add;
DELIMITER $$
CREATE PROCEDURE Users_Add (IN firstName VARCHAR(50), IN lastName VARCHAR(50), IN dni VARCHAR(15), IN email VARCHAR(100), IN password VARCHAR(100), IN role VARCHAR(20) )
BEGIN
	INSERT INTO Users
        (Users.firstName, Users.lastName, Users.dni, Users.email, Users.password,Users.role)
    VALUES
        (firstName, lastName, dni, email, password, 'client');
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Users_GetAll`;
DELIMITER $$
CREATE PROCEDURE Users_GetAll ()
BEGIN
	SELECT u.id_user, u.email, u.password, u.firstName, u.lastName, u.dni, u.role
    FROM Users u;
END$$
DELIMITER ;


/* ----- Cinema ----- */

#DROP procedure IF EXISTS `Cinemas_Add`;
DELIMITER $$
CREATE PROCEDURE Cinemas_Add (IN cinema_name VARCHAR(50), IN adress VARCHAR(100), IN state BOOLEAN)
BEGIN
	INSERT INTO Cinemas
        (Cinemas.cinema_name, Cinemas.adress, Cinemas.state)
    VALUES
        (cinema_name, adress, state);
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Cinemas_GetAll`;
DELIMITER $$
CREATE PROCEDURE Cinemas_GetAll ()
BEGIN
	SELECT c.id_cinema, c.cinema_name, c.adress, c.state
    FROM Cinemas c
    WHERE (c.state = true);
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Cinemas_GetById`;
DELIMITER $$
CREATE PROCEDURE Cinemas_GetById (IN id INT)
BEGIN
	SELECT c.id_cinema, c.cinema_name, c.adress, c.state
    FROM Cinemas c
    WHERE c.id_cinema = id AND c.state = true;
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Cinemas_Remove`;
DELIMITER $$
CREATE PROCEDURE Cinemas_Remove (IN id INT)
BEGIN
	UPDATE Cinemas as c
    SET c.state = false    WHERE (c.id_cinema = id);
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Cinemas_Update`;
DELIMITER $$
CREATE PROCEDURE Cinemas_Update (IN id_cinema INT ,IN cinema_name VARCHAR(100), IN adress VARCHAR(100))
BEGIN
	UPDATE Cinemas as c
    SET c.cinema_name = cinema_name, c.adress = adress
    WHERE (c.id_cinema = id_cinema);
END$$
DELIMITER ;

/* ----- Rooms ----- */
#DROP procedure IF EXISTS `Rooms_Add`;
DELIMITER $$
CREATE PROCEDURE Rooms_Add ( IN id_cinema INT ,IN room_name VARCHAR(50), IN capacity VARCHAR(100), IN price INT ,IN state BOOLEAN)
BEGIN
	INSERT INTO Rooms
        (Rooms.id_cinema, Rooms.room_name, Rooms.capacity, Rooms.price, Rooms.state)
    VALUES
        (id_cinema, room_name, capacity, price, state);
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Rooms_GetAll`;
DELIMITER $$
CREATE PROCEDURE Rooms_GetAll()
BEGIN
	SELECT c.id_cinema as id_cinema, c.cinema_name, r.id_room, r.room_name , r.capacity , r.price
    FROM Cinemas c
    INNER JOIN Rooms r ON c.id_cinema = r.id_cinema 
    WHERE r.state = true AND c.state = true;
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Rooms_Remove`;
DELIMITER $$
CREATE PROCEDURE Rooms_Remove (IN id_room INT)
BEGIN
	UPDATE Rooms r
    SET r.state = false    WHERE (r.id_room = id_room);
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Rooms_Update`;
DELIMITER $$
CREATE PROCEDURE Rooms_Update (IN id_room INT , IN id_cinema INT ,IN room_name VARCHAR(50), IN capacity VARCHAR(100), IN price INT )
BEGIN
	UPDATE Rooms as r
    SET  r.id_cinema = id_cinema, r.room_name = room_name, r.capacity = capacity , r.price = price
    WHERE (r.id_room = id_room);
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Rooms_GetById`;
DELIMITER $$
CREATE PROCEDURE Rooms_GetById (IN id INT)
BEGIN
	SELECT  r.id_room, r.room_name , r.capacity , r.price, r.state
    FROM Rooms r
    WHERE (r.id_room = id) ;
END$$
DELIMITER ;


/* ----- Shows ----- */

#DROP procedure IF EXISTS `Shows_Add`;
DELIMITER $$
CREATE PROCEDURE Shows_Add (IN id_room INT , IN id_movie INT, IN day DATE, IN hour TIME, IN state BOOLEAN)
BEGIN
	INSERT INTO Shows
        (Shows.id_room, Shows.id_movie, Shows.day, Shows.hour, Shows.state)
    VALUES
        (id_room, id_movie, day, hour, state);
END$$
DELIMITER ;

#call movie_pass.Shows_Add(1,330457, "2020-11-20", "21:30", true);

#DROP procedure IF EXISTS `Shows_GetTable`;
DELIMITER $$
CREATE PROCEDURE Shows_GetTable( )
BEGIN
	SELECT s.id_show, c.cinema_name, r.id_room, r.room_name, id_movie, day, hour
    FROM Shows s
    INNER JOIN Rooms r ON s.id_room = r.id_room
    INNER JOIN Cinemas c ON r.id_cinema = c.id_cinema
    WHERE (s.state = true);
    
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Shows_GetAll`;
DELIMITER $$
CREATE PROCEDURE Shows_GetAll( )
BEGIN
	SELECT s.id_show, s.id_room, s.id_movie, s.day, s.hour
    FROM Shows s
    WHERE (s.state = true);
    
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Shows_GetById`;
DELIMITER $$
CREATE PROCEDURE Shows_GetById (IN id INT)
BEGIN
	SELECT s.id_show, s.id_room, s.id_movie, s.day, s.hour
	FROM Shows s
    WHERE (s.id_show = id) ;
END$$
DELIMITER ;


#DROP procedure IF EXISTS `Shows_Remove`;
DELIMITER $$
CREATE PROCEDURE Shows_Remove (IN id_show INT)
BEGIN
	UPDATE Shows s
    SET s.state = false    WHERE (s.id_show = id_show);
END$$
DELIMITER ;


#DROP procedure IF EXISTS `Shows_GetByDate`;
DELIMITER $$
CREATE PROCEDURE Shows_GetByDate (IN day date)
BEGIN
	SELECT id_room, id_movie, day, hour
    FROM Shows 
    WHERE Shows.day = day;
END$$
DELIMITER ;

/* ----- Purchases ----- */
#DROP procedure IF EXISTS `Purchases_Add`;
DELIMITER $$
CREATE PROCEDURE Purchases_Add ( IN count_tickets INT , IN id_user INT , IN id_show INT , IN date_purchase DATE , IN total INT)
BEGIN
    INSERT INTO Purchases (Purchases.count_tickets, Purchases.id_user, Purchases.id_show, Purchases.date_purchase, Purchases.total)
    VALUES (count_tickets, id_user, id_show, date_purchase, total);
END$$
DELIMITER ;

#DROP procedure IF EXISTS `Purchases_GetAll`;
DELIMITER $$
CREATE PROCEDURE Purchases_GetAll( )
BEGIN
    SELECT c.cinema_name , r.room_name, r.capacity, s.day, s.hour, sum(count_tickets) as count_tickets, p.id_user, p.id_show, p.date_purchase, sum(p.total) as total
    FROM Purchases p 
    INNER JOIN Shows s ON p.id_show = s.id_show
    INNER JOIN Rooms r ON s.id_room = r.id_room
    INNER JOIN Cinemas c ON r.id_cinema = c.id_cinema
   
    GROUP BY(p.id_show);
END$$
DELIMITER ;

#call movie_pass.Purchases_GetAll();

/* ----- Tickets ----- */






/* --- Insert Into --- */
INSERT INTO Users (firstName, lastName, dni, email, password, role)
VALUES  ('Admin','Admin ','123','admin@moviepass.com','admin','admin'),
		('Tomy','Amoretti','38698788','tomy_kpo95@hotmail.com','1234','client'),
        ('Gianni','Ricciardi','40635847','gianni@moviepass.com','1234','client'),
        ('Dante','Grassi','40138417','dante@moviepass.com','1234','client');
        
        
INSERT INTO Cinemas (cinema_name, adress, state)
VALUES  ('Aldrey','Sarmiento 2685', true),('Cines del Paseo', 'Diagonal Pueyrredón 3058',true),
		('Ambassador','Cordoba 1673',true),('Cinema', 'Catamarca 1880',true);

INSERT INTO Rooms (id_cinema, room_name, capacity, price, state)
VALUES (1,'Atmos','100','400', true), (1,'Sala 2D','750','400', true), (2,'Sala 1','800','250', true),
(2,'Sala 2','1500','250', true),(3,'Sala 2D','650','250', true),(4,'Sala 2D','700','300', true);

INSERT INTO Shows (Shows.id_room, Shows.id_movie, Shows.day, Shows.hour, Shows.state)
VALUES (1,330457,"2020-11-6","21:30:00",true), (5,458897,"2020-11-20","23:00:00",true), (2,330457,"2020-11-21","17:30:00",true), (1,359724,"2020-11-22","20:00:00",true);
	
INSERT INTO Purchases (Purchases.count_tickets, Purchases.id_user, Purchases.id_show, Purchases.date_purchase, Purchases.total)
    VALUES (8, 2, 1, "2020-11-20", 3200), (2, 4, 4, "2020-11-20", 800);
        
        
select * from Shows;
select * from Cinemas;
select * from Rooms;
select * from Users;
select * from Purchases;



