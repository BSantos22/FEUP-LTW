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
	reviewersRating FLOAT,
	restaurantphoto VARCHAR
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

INSERT INTO user VALUES('admin', 'My Food Advisor', 'geral@myfoodadvisor.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '2016-12-01', 'Porto', 'Portugal', 'admin', 'defaultlogo.png');
INSERT INTO user VALUES('mgomes', 'Manuel Gomes', 'mg@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1987-04-25', 'Porto', 'Portugal', 'owner', 'mgomes.jpeg');
INSERT INTO user VALUES('joseoliv','José Oliveira', 'joseoliv@hotmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1994-03-22', 'Porto', 'Portugal', 'owner', 'joseoliv.jpg');
INSERT INTO user VALUES('bsantos', 'Bruno Santos', 'bsantos@hotmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1989-03-19', 'Porto', 'Portugal', 'owner', 'bsantos.jpg');
INSERT INTO user VALUES('ruibento', 'Rui Bento', 'ruibento@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1983-08-20', 'Braga', 'Portugal', 'reviewer', 'defaultlogo.png');
INSERT INTO user VALUES('jonhy', 'John Adams', 'adams@yahoo.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1973-03-04', 'London', 'United Kingdom', 'reviewer', 'jonhy.jpeg');
INSERT INTO user VALUES('mbrandao', 'Micaela Brandão', 'mdrandao@hotmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1971-03-01', 'Lisboa', 'Portugal', 'reviewer', 'mbrandao.jpeg');
INSERT INTO user VALUES('rfernandes', 'Rita Fernandes', 'rfernandes@hotmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1993-04-04', 'Aveiro', 'Portugal', 'reviewer', 'rfernandes.jpeg');
INSERT INTO user VALUES('raulramos', 'Raul Ramos', 'rramos@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1990-05-21', 'Madrid', 'Espanha', 'reviewer', 'defaultlogo.png');

INSERT INTO restaurant VALUES(1, 'Flow Restaurant & Bar', 'mgomes', 'Rua da Conceição 63', '4050-213', 'Porto', 'Portugal', 'Contemporâneo', 4.0, '11:00', '01:00', 0.0, '18681008_WAP4e.jpeg');
INSERT INTO restaurant VALUES(2, 'Restaurante Filha da Mãe Preta', 'joseoliv', 'Cais da Ribeira 39','4050-510', 'Porto', 'Portugal', 'Tradicional', 3.0,'10:30', '23:00',0.0, 'filhamaepreta.jpg');
INSERT INTO restaurant VALUES(3, 'Ode Porto Wine House', 'bsantos', 'Largo do Terreiro 7', '4050-603','Porto', 'Portugal', 'Mediterrâneo', 5.0,'11:30:00', '00:00', 0.0, '4-ode3.jpg');
INSERT INTO restaurant VALUES(4, 'Eleven', 'mgomes', 'Rua Marquês da Fronteira Jardim Amália Rodrigues', '1070-000', 'Lisboa', 'Portugal', 'Tradicional', 4.0, '12:30', '23:00', 0.0, 'eleven-Lisboa-2.jpg');
INSERT INTO restaurant VALUES(5, 'Restaurante Belcanto', 'joseoliv', 'Largo de São Carlos 10','1200-410', 'Lisboa', 'Portugal', 'Comida saudável', 5.0,'12:30', '23:00',0.0, 'Belcanto-pedro-garcia-1_LOW.jpg');
INSERT INTO restaurant VALUES(6, 'Restaurante Pizzarte', 'bsantos', 'Rua Engenheiro Von Haff 27', '3800-177','Aveiro', 'Portugal', 'Pizza', 4,'12:30', '02:00', 0.0, 'Pizzarte3.jpg');
INSERT INTO restaurant VALUES(7, 'Torre di Pizza', 'mgomes', 'Avenida Cidade de Aveiro Lote 16', '3510-720', 'Viseu', 'Portugal', 'Pizza', 3.0, '11:30', '23:30', 0.0, 'defaultphoto.png');
INSERT INTO restaurant VALUES(8, 'Restaurante Grelhados do Candal', 'joseoliv', 'Alameda Empresa 110','4400-133', 'Vila Nova de Gaia', 'Portugal', 'Grelhados', 3.0,'11:00', '22:30', 0.0, 'defaultphoto.png');
INSERT INTO restaurant VALUES(9, 'Restaurante Centurium', 'bsantos', 'Avenida Central 134', '4710-000','Braga', 'Portugal', 'Mediterrâneo', 4.0,'11:30:00', '00:00', 0.0, 'defaultphoto.png');

INSERT INTO photo_restaurant VALUES (NULL, 1, '18681008_WAP4e.jpeg');
INSERT INTO photo_restaurant VALUES (NULL, 1, '18681011_oemRn.jpeg');
INSERT INTO photo_restaurant VALUES (NULL, 2, 'filhamaepreta.jpg');
INSERT INTO photo_restaurant VALUES (NULL, 3, '4-ode3.jpg');
INSERT INTO photo_restaurant VALUES (NULL, 3, 'ode-wine-house.jpg');
INSERT INTO photo_restaurant VALUES (NULL, 4, 'eleven-Lisboa-2.jpg');
INSERT INTO photo_restaurant VALUES (NULL, 5, 'Belcanto-pedro-garcia-1_LOW.jpg');
INSERT INTO photo_restaurant VALUES (NULL, 6, 'Pizzarte3.jpg');

INSERT INTO review VALUES(1, 'mbrandao', 1, 5, 'Muito bom atendimento!');
INSERT INTO review VALUES(2, 'ruibento', 1, 4.5, 'Pratos com muito boa apresentação');
INSERT INTO review VALUES(3, 'mbrandao', 2, 3, 'Bom atendimento!');
INSERT INTO review VALUES(4, 'ruibento', 2, 3.5, 'Prato muito bom mas demorado.');
INSERT INTO review VALUES(5, 'jonhy', 2, 2, 'Not the quickest service.');
INSERT INTO review VALUES(6, 'jonhy', 3, 4.5, 'Amazing atmosphere with delicious wines to taste!');
INSERT INTO review VALUES(7, 'jonhy', 1, 3.0, 'Good environent.');
INSERT INTO review VALUES(8, 'rfernandes', 1, 3.0, 'Local razoável');
INSERT INTO review VALUES(9, 'rfernandes', 2, 4.0, 'A repetir.');
INSERT INTO review VALUES(10, 'rfernandes', 3, 4.0, 'A repetir.');
INSERT INTO review VALUES(11, 'rfernandes', 4, 4.0, 'A repetir.');
INSERT INTO review VALUES(12, 'rfernandes', 5, 4.0, 'A repetir.');
INSERT INTO review VALUES(13, 'rfernandes', 6, 4.0, 'A repetir.');
INSERT INTO review VALUES(14, 'rfernandes', 7, 4.0, 'A repetir.');
INSERT INTO review VALUES(15, 'rfernandes', 8, 4.0, 'A repetir.');
INSERT INTO review VALUES(16, 'rfernandes', 9, 4.0, 'A repetir.');
INSERT INTO review VALUES(17, 'mbrandao', 3, 4, 'Bom serviço de atendimento!');
INSERT INTO review VALUES(18, 'mbrandao', 4, 4, 'Bom serviço de atendimento!');
INSERT INTO review VALUES(19, 'mbrandao', 5, 4, 'Bom serviço de atendimento!');
INSERT INTO review VALUES(20, 'mbrandao', 6, 4, 'Bom serviço de atendimento!');
INSERT INTO review VALUES(21, 'mbrandao', 7, 4, 'Bom serviço de atendimento!');
INSERT INTO review VALUES(22, 'mbrandao', 8, 4, 'Bom serviço de atendimento!');
INSERT INTO review VALUES(23, 'mbrandao', 9, 4, 'Bom serviço de atendimento!');
INSERT INTO review VALUES(24, 'raulramos', 1, 4, 'Buen restaurante con buena condición!');
INSERT INTO review VALUES(25, 'raulramos', 2, 4, 'Buen restaurante con buena condición!');
INSERT INTO review VALUES(26, 'raulramos', 3, 4, 'Buen restaurante con buena condición!');
INSERT INTO review VALUES(27, 'raulramos', 4, 4, 'Buen restaurante con buena condición!');
INSERT INTO review VALUES(28, 'raulramos', 5, 4, 'Buen restaurante con buena condición!');
INSERT INTO review VALUES(29, 'raulramos', 6, 4, 'Buen restaurante con buena condición!');
INSERT INTO review VALUES(30, 'raulramos', 7, 4, 'Buen restaurante con buena condición!');
INSERT INTO review VALUES(31, 'raulramos', 8, 4, 'Buen restaurante con buena condición!');
INSERT INTO review VALUES(32, 'raulramos', 9, 4, 'Buen restaurante con buena condición!');

INSERT INTO reply VALUES(1, 1, 'mgomes', 'obrigado');
INSERT INTO reply VALUES(2, 2, 'mgomes', 'obrigado');
INSERT INTO reply VALUES(3, 24, 'mgomes', 'obrigado');
INSERT INTO reply VALUES(4, 7, 'mgomes', 'obrigado');
INSERT INTO reply VALUES(5, 3, 'joseoliv', 'nao se pode ter tudo');
INSERT INTO reply VALUES(6, 12, 'joseoliv', 'Cá o esperamos.');
INSERT INTO reply VALUES(7, 20, 'bsantos', 'Muito obrigado. Cumprimentos');
INSERT INTO reply VALUES(8, 32, 'bsantos', 'Gracias');