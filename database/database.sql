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
	status VARCHAR
);

DROP TABLE IF EXISTS restaurant;
CREATE TABLE restaurant (
	id INTEGER PRIMARY KEY,
	name VARCHAR,
	idOwner INTEGER REFERENCES user(username),	
	city VARCHAR,
	country VARCHAR,
	category VARCHAR,
	price FLOAT,	
	open TIME,
	close TIME
);

DROP TABLE IF EXISTS owner;
CREATE TABLE owner (
	idOwner INTEGER REFERENCES user(username),	
	idRestaurant INTEGER REFERENCES restaurant(id)
);

DROP TABLE IF EXISTS review;
CREATE TABLE review (
	id INTEGER PRIMARY KEY,
	idReviewer VARCHAR REFERENCES user(username),
	idRestaurant INTEGER REFERENCES restaurant(id),
	rating FLOAT,
	text VARCHAR
);

DROP TABLE IF EXISTS photo;
CREATE TABLE photo (
	id INTEGER PRIMARY KEY,
	idRestaurant INTEGER REFERENCES restaurant(id),
	link VARCHAR
);

DROP TABLE IF EXISTS reply;
CREATE TABLE reply (
	id INTEGER PRIMARY KEY,
	idReview INTEGER REFERENCES review(id),
	idUser VARCHAR REFERENCES user(username),
	content VARCHAR
);


INSERT INTO user VALUES('mgomes', 'Manuel Gomes', 'mg@gmail.com', 'abc123', '1987-04-25', 'Porto', 'Portugal', 'owner');
INSERT INTO user VALUES('joseoliv','José Oliveira', 'joseoliv@hotmail.com', 'abc123', '1994-03-22', 'Porto', 'Portugal', 'reviewer');
INSERT INTO user VALUES('bsantos', 'Bruno Santos', 'bsantos@hotmail.com', 'abc123', '1989-03-19', 'Porto', 'Portugal', 'owner');
INSERT INTO user VALUES('ruibento', 'Rui Bento', 'ruibento@gmail.com', 'abc123', '1983-08-20', 'Braga', 'Portugal', 'reviewer');
INSERT INTO user VALUES('jonhy', 'John Adams', 'adams@yahoo.com', 'abc123', '1973-03-04', 'London', 'United Kingdom', 'reviewer');

INSERT INTO restaurant VALUES(1, 'Flow Restaurant & Bar', 'mgomes', 'Porto', 'Portugal', 'Comtemporâneo', 4.0, '11:00:00', '01:00:00');
INSERT INTO restaurant VALUES(2, 'Ode Porto Wine House', 'bsantos', 'Porto', 'Portugal', 'Mediterrâneo', 5.0,'11:30:00', '00:00:00');
INSERT INTO restaurant VALUES(3, 'Restaurante Filha da Mãe Preta', 'joseoliv', 'Porto', 'Portugal', 'Tradicional', 3.0,'10:30:00', '23:00:00');

INSERT INTO owner VALUES('mgomes', 1);
INSERT INTO owner VALUES('joseoliv', 2);
INSERT INTO owner VALUES('bsantos', 3);

INSERT INTO review VALUES(1, 'joseoliv', 1, 5, 'Muito bom atendimento!');
INSERT INTO review VALUES(2, 'ruibento', 2, 3.5, 'Prato muito bom mas demorado.');
INSERT INTO review VALUES(3, 'jonhy', 2, 4.5, 'Amazing atmosphere with delicious wines to taste!');

INSERT INTO reply VALUES(1, 1, 'mgomes', 'ty');
INSERT INTO reply VALUES(2, 2, 'joseoliv', 'nao se pode ter tudo');
