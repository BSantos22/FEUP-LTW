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

DROP TABLE IF EXISTS review;
CREATE TABLE review (
	id INTEGER PRIMARY KEY,
	idReviewer VARCHAR REFERENCES user(username),
	idRestaurant INTEGER REFERENCES restaurant(id),
	rating FLOAT,
	text VARCHAR
);

INSERT INTO user VALUES('mgomes', 'Manuel Gomes', 'mg@gmail.com', 'abc123', '1987-04-25', 'Porto', 'Portugal', 'owner');
INSERT INTO user VALUES('joseoliv','José Oliveira', 'joseoliv@hotmail.com', 'abc123', '1994-03-22', 'Porto', 'Portugal', 'reviewer');
INSERT INTO user VALUES('bsantos', 'Bruno Santos', 'bsantos@hotmail.com', 'abc123', '1989-03-19', 'Porto', 'Portugal', 'owner');
INSERT INTO user VALUES('ruibento', 'Rui Bento', 'ruibento@gmail.com', 'abc123', '1983-08-20', 'Braga', 'Portugal', 'reviewer');
INSERT INTO user VALUES('jonhy', 'John Adams', 'adams@yahoo.com', 'abc123', '1973-03-04', 'Aveiro', 'Portugal', 'reviewer');					

INSERT INTO restaurant VALUES(NULL, 'Flow Restaurant & Bar', 'mgomes', 'Porto', 'Portugal', 4.5, 'Comtemporâneo', '11:00:00', '01:00:00');
INSERT INTO restaurant VALUES(NULL, 'Ode Porto Wine House', 'bsantos', 'Porto', 'Portugal', 4.5, 'Mediterrâneo','11:30:00', '00:00:00');

INSERT INTO review VALUES(NULL, 'joseoliv', 1, 5, 'Muito bom atendimento!');
INSERT INTO review VALUES(NULL, 'ruibento', 2, 3.5, 'Prato muito bom mas demorado.');
INSERT INTO review VALUES(NULL, 'jonhy', 2, 4.5, 'Amazing atmosphere with delicious wines to taste!');