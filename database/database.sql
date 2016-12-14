PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS user;
CREATE TABLE user (
	username VARCHAR PRIMARY KEY,
	name VARCHAR,
	email VARCHAR UNIQUE,
	password VARCHAR,
	birthday DATE,
	city VARCHAR,
	country VARCHAR,
	status VARCHAR,
	photopath VARCHAR
);

DROP TABLE IF EXISTS restaurant;
CREATE TABLE restaurant (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	name VARCHAR,
	idOwner VARCHAR REFERENCES user(username),
	street VARCHAR,
	zipcode VARCHAR,
	city VARCHAR,
	country VARCHAR,
	category VARCHAR,
	price FLOAT,	
	open TIME,
	close TIME,
	reviewersRating FLOAT
);

DROP TABLE IF EXISTS owner;
CREATE TABLE owner (
	idOwner VARCHAR REFERENCES user(username),
	idRestaurant INTEGER REFERENCES restaurant(id)
);

DROP TABLE IF EXISTS review;
CREATE TABLE review (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	idReviewer VARCHAR REFERENCES user(username),
	idRestaurant INTEGER REFERENCES restaurant(id),
	rating FLOAT,
	text VARCHAR
);

DROP TABLE IF EXISTS photo_restaurant;
CREATE TABLE photo_restaurant (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	idRestaurant INTEGER REFERENCES restaurant(id),
	name VARCHAR
);

DROP TABLE IF EXISTS reply;
CREATE TABLE reply (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	idReview INTEGER REFERENCES review(id),
	idUser VARCHAR REFERENCES user(username),
	content VARCHAR
);

CREATE TRIGGER updaterating AFTER INSERT ON review
BEGIN
	UPDATE restaurant SET reviewersRating = (
		SELECT AVG(rating) FROM restaurant
		JOIN review ON (restaurant.id = NEW.idRestaurant)
		GROUP BY (idRestaurant)
		HAVING (idRestaurant = NEW.idRestaurant)
	)
	WHERE (restaurant.id = NEW.idRestaurant);
END;

INSERT INTO user VALUES('mgomes', 'Manuel Gomes', 'mg@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1987-04-25', 'Porto', 'Portugal', 'owner', 'defaultlogo.png');
INSERT INTO user VALUES('joseoliv','José Oliveira', 'joseoliv@hotmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1994-03-22', 'Porto', 'Portugal', 'owner', 'defaultlogo.png');
INSERT INTO user VALUES('bsantos', 'Bruno Santos', 'bsantos@hotmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1989-03-19', 'Porto', 'Portugal', 'owner', 'defaultlogo.png');
INSERT INTO user VALUES('ruibento', 'Rui Bento', 'ruibento@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1983-08-20', 'Braga', 'Portugal', 'reviewer', 'defaultlogo.png');
INSERT INTO user VALUES('jonhy', 'John Adams', 'adams@yahoo.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1973-03-04', 'London', 'United Kingdom', 'reviewer', 'defaultlogo.png');

INSERT INTO restaurant VALUES(1, 'Flow Restaurant & Bar', 'mgomes', 'Rua da Conceição 63', '4050-213', 'Porto', 'Portugal', 'Contemporâneo', 4.0, '11:00:00', '01:00:00', 5.0);
INSERT INTO restaurant VALUES(2, 'Restaurante Filha da Mãe Preta', 'joseoliv', 'Cais da Ribeira 39','4050-510', 'Porto', 'Portugal', 'Tradicional', 3.0,'10:30:00', '23:00:00', 5.0);
INSERT INTO restaurant VALUES(3, 'Ode Porto Wine House', 'bsantos', 'Largo do Terreiro 7', '4050-603','Porto', 'Portugal', 'Mediterrâneo', 5.0,'11:30:00', '00:00:00', 5.0);

INSERT INTO owner VALUES('mgomes', 1);
INSERT INTO owner VALUES('joseoliv', 2);
INSERT INTO owner VALUES('bsantos', 3);

INSERT INTO review VALUES(1, 'joseoliv', 1, 5, 'Muito bom atendimento!');
INSERT INTO review VALUES(2, 'ruibento', 1, 4.5, 'Pratos com muito boa apresentação');
INSERT INTO review VALUES(3, 'joseoliv', 2, 3, 'Bom atendimento!');
INSERT INTO review VALUES(4, 'ruibento', 2, 3.5, 'Prato muito bom mas demorado.');
INSERT INTO review VALUES(5, 'jonhy', 2, 2, 'Not the quickest service.');
INSERT INTO review VALUES(6, 'jonhy', 3, 4.5, 'Amazing atmosphere with delicious wines to taste!');

INSERT INTO reply VALUES(1, 1, 'mgomes', 'ty');
INSERT INTO reply VALUES(2, 2, 'joseoliv', 'nao se pode ter tudo');