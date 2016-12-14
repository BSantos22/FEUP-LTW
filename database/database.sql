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

DROP TABLE IF EXISTS country;
CREATE TABLE country (
  name VARCHAR
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
INSERT INTO user VALUES('mgomes', 'Manuel Gomes', 'mg@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1987-04-25', 'Porto', 'Portugal', 'owner', 'defaultlogo.png');
INSERT INTO user VALUES('joseoliv','José Oliveira', 'joseoliv@hotmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1994-03-22', 'Porto', 'Portugal', 'owner', 'defaultlogo.png');
INSERT INTO user VALUES('bsantos', 'Bruno Santos', 'bsantos@hotmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1989-03-19', 'Porto', 'Portugal', 'owner', 'defaultlogo.png');
INSERT INTO user VALUES('ruibento', 'Rui Bento', 'ruibento@gmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1983-08-20', 'Braga', 'Portugal', 'reviewer', 'defaultlogo.png');
INSERT INTO user VALUES('jonhy', 'John Adams', 'adams@yahoo.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1973-03-04', 'London', 'United Kingdom', 'reviewer', 'defaultlogo.png');
INSERT INTO user VALUES('mbrandao', 'Miguel Brandão', 'mdrandao@hotmail.com', '6ca13d52ca70c883e0f0bb101e425a89e8624de51db2d2392593af6a84118090', '1971-03-01', 'Lisboa', 'Portugal', 'reviewer', 'defaultlogo.png');

INSERT INTO restaurant VALUES(1, 'Flow Restaurant & Bar', 'mgomes', 'Rua da Conceição 63', '4050-213', 'Porto', 'Portugal', 'Contemporâneo', 4.0, '11:00', '01:00', NULL);
INSERT INTO restaurant VALUES(2, 'Restaurante Filha da Mãe Preta', 'joseoliv', 'Cais da Ribeira 39','4050-510', 'Porto', 'Portugal', 'Tradicional', 3.0,'10:30', '23:00', NULL);
INSERT INTO restaurant VALUES(3, 'Ode Porto Wine House', 'bsantos', 'Largo do Terreiro 7', '4050-603','Porto', 'Portugal', 'Mediterrâneo', 5.0,'11:30:00', '00:00', NULL);

INSERT INTO owner VALUES('mgomes', 1);
INSERT INTO owner VALUES('joseoliv', 2);
INSERT INTO owner VALUES('bsantos', 3);

INSERT INTO review VALUES(1, 'mbrandao', 1, 5, 'Muito bom atendimento!');
INSERT INTO review VALUES(2, 'ruibento', 1, 4.5, 'Pratos com muito boa apresentação');
INSERT INTO review VALUES(3, 'mbrandao', 2, 3, 'Bom atendimento!');
INSERT INTO review VALUES(4, 'ruibento', 2, 3.5, 'Prato muito bom mas demorado.');
INSERT INTO review VALUES(5, 'jonhy', 2, 2, 'Not the quickest service.');
INSERT INTO review VALUES(6, 'jonhy', 3, 4.5, 'Amazing atmosphere with delicious wines to taste!');

INSERT INTO reply VALUES(1, 1, 'mgomes', 'ty');
INSERT INTO reply VALUES(2, 2, 'joseoliv', 'nao se pode ter tudo');

INSERT INTO country VALUES ('Afeganistão');
INSERT INTO country VALUES ('África do Sul');
INSERT INTO country VALUES ('Albânia');
INSERT INTO country VALUES ('Alemanha');
INSERT INTO country VALUES ('Andorra');
INSERT INTO country VALUES ('Angola');
INSERT INTO country VALUES ('Anguilla');
INSERT INTO country VALUES ('Antártida');
INSERT INTO country VALUES ('Antígua e Barbuda');
INSERT INTO country VALUES ('Arábia Saudita');
INSERT INTO country VALUES ('Argélia');
INSERT INTO country VALUES ('Argentina');
INSERT INTO country VALUES ('Arménia');
INSERT INTO country VALUES ('Aruba');
INSERT INTO country VALUES ('Austrália');
INSERT INTO country VALUES ('Áustria');
INSERT INTO country VALUES ('Azerbaijão');
INSERT INTO country VALUES ('Bahamas');
INSERT INTO country VALUES ('Bahrein');
INSERT INTO country VALUES ('Bangladesh');
INSERT INTO country VALUES ('Barbados');
INSERT INTO country VALUES ('Bélgica');
INSERT INTO country VALUES ('Belize');
INSERT INTO country VALUES ('Benin');
INSERT INTO country VALUES ('Bermuda');
INSERT INTO country VALUES ('Bielorrússia');
INSERT INTO country VALUES ('Bolívia');
INSERT INTO country VALUES ('Bósnia e Herzegovina');
INSERT INTO country VALUES ('Botswana');
INSERT INTO country VALUES ('Brasil');
INSERT INTO country VALUES ('Brunei');
INSERT INTO country VALUES ('Bulgária');
INSERT INTO country VALUES ('Burquina Faso');
INSERT INTO country VALUES ('Burundi');
INSERT INTO country VALUES ('Butão');
INSERT INTO country VALUES ('Cabo Verde');
INSERT INTO country VALUES ('Camarões');
INSERT INTO country VALUES ('Camboja');
INSERT INTO country VALUES ('Canadá');
INSERT INTO country VALUES ('Cazaquistão');
INSERT INTO country VALUES ('Ceuta & Melilla');
INSERT INTO country VALUES ('Chade');
INSERT INTO country VALUES ('Chile');
INSERT INTO country VALUES ('China');
INSERT INTO country VALUES ('Chipre');
INSERT INTO country VALUES ('Cidade do Vaticano');
INSERT INTO country VALUES ('Colômbia');
INSERT INTO country VALUES ('Comores');
INSERT INTO country VALUES ('Congo - Brazzaville');
INSERT INTO country VALUES ('Congo - Kinshasa');
INSERT INTO country VALUES ('Coreia do Norte');
INSERT INTO country VALUES ('Coreia do Sul');
INSERT INTO country VALUES ('Costa do Marfim');
INSERT INTO country VALUES ('Costa Rica');
INSERT INTO country VALUES ('Croácia');
INSERT INTO country VALUES ('Cuba');
INSERT INTO country VALUES ('Curaçao');
INSERT INTO country VALUES ('Diego Garcia');
INSERT INTO country VALUES ('Dinamarca');
INSERT INTO country VALUES ('Djibuti');
INSERT INTO country VALUES ('Dominica');
INSERT INTO country VALUES ('Egipto');
INSERT INTO country VALUES ('El Salvador');
INSERT INTO country VALUES ('Emirados Árabes Unidos');
INSERT INTO country VALUES ('Equador');
INSERT INTO country VALUES ('Eritréia');
INSERT INTO country VALUES ('Eslováquia');
INSERT INTO country VALUES ('Eslovénia');
INSERT INTO country VALUES ('Espanha');
INSERT INTO country VALUES ('Estados Unidos');
INSERT INTO country VALUES ('Estónia');
INSERT INTO country VALUES ('Etiópia');
INSERT INTO country VALUES ('Fiji');
INSERT INTO country VALUES ('Filipinas');
INSERT INTO country VALUES ('Finlândia');
INSERT INTO country VALUES ('França');
INSERT INTO country VALUES ('Gabão');
INSERT INTO country VALUES ('Gâmbia');
INSERT INTO country VALUES ('Gana');
INSERT INTO country VALUES ('Geórgia do Sul e Ilhas Sandwich do Sul');
INSERT INTO country VALUES ('Geórgia');
INSERT INTO country VALUES ('Gibraltar');
INSERT INTO country VALUES ('Grécia');
INSERT INTO country VALUES ('Grenada');
INSERT INTO country VALUES ('Gronelândia');
INSERT INTO country VALUES ('Guadalupe');
INSERT INTO country VALUES ('Guam');
INSERT INTO country VALUES ('Guatemala');
INSERT INTO country VALUES ('Guernsey');
INSERT INTO country VALUES ('Guiana Francesa');
INSERT INTO country VALUES ('Guiana');
INSERT INTO country VALUES ('Guiné Equatorial');
INSERT INTO country VALUES ('Guiné');
INSERT INTO country VALUES ('Guiné-Bissau');
INSERT INTO country VALUES ('Haiti');
INSERT INTO country VALUES ('Honduras');
INSERT INTO country VALUES ('Hungria');
INSERT INTO country VALUES ('Ilha da Ascensão');
INSERT INTO country VALUES ('Ilha de Man');
INSERT INTO country VALUES ('Ilha de Natal');
INSERT INTO country VALUES ('Ilha de Norfolk');
INSERT INTO country VALUES ('Ilhas Åland');
INSERT INTO country VALUES ('Ilhas Canárias');
INSERT INTO country VALUES ('Ilhas Cayman');
INSERT INTO country VALUES ('Ilhas Cocos (Keeling)');
INSERT INTO country VALUES ('Ilhas Cook');
INSERT INTO country VALUES ('Ilhas Falkland');
INSERT INTO country VALUES ('Ilhas Faroé');
INSERT INTO country VALUES ('Ilhas Marianas do Norte');
INSERT INTO country VALUES ('Ilhas Marshall');
INSERT INTO country VALUES ('Ilhas Periféricas dos EUA');
INSERT INTO country VALUES ('Ilhas Pitcairn');
INSERT INTO country VALUES ('Ilhas Salomão');
INSERT INTO country VALUES ('Ilhas Turcas e Caicos');
INSERT INTO country VALUES ('Ilhas Virgens Americanas');
INSERT INTO country VALUES ('Ilhas Virgens Britânicas');
INSERT INTO country VALUES ('Índia');
INSERT INTO country VALUES ('Indonésia');
INSERT INTO country VALUES ('Irão');
INSERT INTO country VALUES ('Iraque');
INSERT INTO country VALUES ('Irlanda');
INSERT INTO country VALUES ('Islândia');
INSERT INTO country VALUES ('Israel');
INSERT INTO country VALUES ('Itália');
INSERT INTO country VALUES ('Jamaica');
INSERT INTO country VALUES ('Japão');
INSERT INTO country VALUES ('Jersey');
INSERT INTO country VALUES ('Jordânia');
INSERT INTO country VALUES ('Kiribati');
INSERT INTO country VALUES ('Kosovo');
INSERT INTO country VALUES ('Kuwait');
INSERT INTO country VALUES ('Laos');
INSERT INTO country VALUES ('Lesoto');
INSERT INTO country VALUES ('Letónia');
INSERT INTO country VALUES ('Líbano');
INSERT INTO country VALUES ('Libéria');
INSERT INTO country VALUES ('Líbia');
INSERT INTO country VALUES ('Liechtenstein');
INSERT INTO country VALUES ('Lituânia');
INSERT INTO country VALUES ('Luxemburgo');
INSERT INTO country VALUES ('Macau SAR China');
INSERT INTO country VALUES ('Macedónia');
INSERT INTO country VALUES ('Madagascar');
INSERT INTO country VALUES ('Malásia');
INSERT INTO country VALUES ('Malawi');
INSERT INTO country VALUES ('Maldivas');
INSERT INTO country VALUES ('Mali');
INSERT INTO country VALUES ('Malta');
INSERT INTO country VALUES ('Marrocos');
INSERT INTO country VALUES ('Martinica');
INSERT INTO country VALUES ('Maurício');
INSERT INTO country VALUES ('Mauritânia');
INSERT INTO country VALUES ('Mayotte');
INSERT INTO country VALUES ('México');
INSERT INTO country VALUES ('Micronésia');
INSERT INTO country VALUES ('Moçambique');
INSERT INTO country VALUES ('Moldávia');
INSERT INTO country VALUES ('Mónaco');
INSERT INTO country VALUES ('Mongólia');
INSERT INTO country VALUES ('Montenegro');
INSERT INTO country VALUES ('Montserrat');
INSERT INTO country VALUES ('Myanmar (Birmânia)');
INSERT INTO country VALUES ('Namíbia');
INSERT INTO country VALUES ('Nauru');
INSERT INTO country VALUES ('Nepal');
INSERT INTO country VALUES ('Nicarágua');
INSERT INTO country VALUES ('Níger');
INSERT INTO country VALUES ('Nigéria');
INSERT INTO country VALUES ('Niue');
INSERT INTO country VALUES ('Noruega');
INSERT INTO country VALUES ('Nova Caledónia');
INSERT INTO country VALUES ('Nova Zelândia');
INSERT INTO country VALUES ('Omã');
INSERT INTO country VALUES ('Países Baixos do Caribe');
INSERT INTO country VALUES ('Países Baixos');
INSERT INTO country VALUES ('Palau');
INSERT INTO country VALUES ('Panamá');
INSERT INTO country VALUES ('Papua Nova Guiné');
INSERT INTO country VALUES ('Paquistão');
INSERT INTO country VALUES ('Paraguai');
INSERT INTO country VALUES ('Peru');
INSERT INTO country VALUES ('Polinésia Francesa');
INSERT INTO country VALUES ('Polónia');
INSERT INTO country VALUES ('Porto Rico');
INSERT INTO country VALUES ('Portugal');
INSERT INTO country VALUES ('Qatar');
INSERT INTO country VALUES ('Quénia');
INSERT INTO country VALUES ('Quirguizistão');
INSERT INTO country VALUES ('Região Administrativa Especial de Hong Kong');
INSERT INTO country VALUES ('Reino Unido');
INSERT INTO country VALUES ('República Centro-Africana');
INSERT INTO country VALUES ('República Checa');
INSERT INTO country VALUES ('República Dominicana');
INSERT INTO country VALUES ('Reunião');
INSERT INTO country VALUES ('Roménia');
INSERT INTO country VALUES ('Ruanda');
INSERT INTO country VALUES ('Rússia');
INSERT INTO country VALUES ('Saara Ocidental');
INSERT INTO country VALUES ('Samoa Americana');
INSERT INTO country VALUES ('Samoa');
INSERT INTO country VALUES ('Santa Helena');
INSERT INTO country VALUES ('Santa Lúcia');
INSERT INTO country VALUES ('São Bartolomeu');
INSERT INTO country VALUES ('São Cristóvão e Nevis');
INSERT INTO country VALUES ('São Marinho');
INSERT INTO country VALUES ('São Martinho');
INSERT INTO country VALUES ('São Pedro e Miquelon');
INSERT INTO country VALUES ('São Tomé e Príncipe');
INSERT INTO country VALUES ('São Vicente e Granadinas');
INSERT INTO country VALUES ('Senegal');
INSERT INTO country VALUES ('Serra Leoa');
INSERT INTO country VALUES ('Sérvia');
INSERT INTO country VALUES ('Seychelles');
INSERT INTO country VALUES ('Singapura');
INSERT INTO country VALUES ('Sint Maarten');
INSERT INTO country VALUES ('Síria');
INSERT INTO country VALUES ('Somália');
INSERT INTO country VALUES ('Sri Lanka');
INSERT INTO country VALUES ('Suazilândia');
INSERT INTO country VALUES ('Sudão do Sul');
INSERT INTO country VALUES ('Sudão');
INSERT INTO country VALUES ('Suécia');
INSERT INTO country VALUES ('Suíça');
INSERT INTO country VALUES ('Suriname');
INSERT INTO country VALUES ('Svalbard & Jan Mayen');
INSERT INTO country VALUES ('Tailândia');
INSERT INTO country VALUES ('Taiwan');
INSERT INTO country VALUES ('Tajiquistão');
INSERT INTO country VALUES ('Tanzânia');
INSERT INTO country VALUES ('Território Britânico do Oceano Índico');
INSERT INTO country VALUES ('Territórios Franceses do Sul');
INSERT INTO country VALUES ('Territórios palestinos');
INSERT INTO country VALUES ('Timor-Leste');
INSERT INTO country VALUES ('Togo');
INSERT INTO country VALUES ('Tokelau');
INSERT INTO country VALUES ('Tonga');
INSERT INTO country VALUES ('Trinidad & Tobago');
INSERT INTO country VALUES ('Tristão da Cunha');
INSERT INTO country VALUES ('Tunísia');
INSERT INTO country VALUES ('Turquemenistão');
INSERT INTO country VALUES ('Turquia');
INSERT INTO country VALUES ('Tuvalu');
INSERT INTO country VALUES ('Ucrânia');
INSERT INTO country VALUES ('Uganda');
INSERT INTO country VALUES ('Uruguai');
INSERT INTO country VALUES ('Uzbequistão');
INSERT INTO country VALUES ('Vanuatu');
INSERT INTO country VALUES ('Venezuela');
INSERT INTO country VALUES ('Vietname');
INSERT INTO country VALUES ('Wallis & Futuna');
INSERT INTO country VALUES ('Yemen');
INSERT INTO country VALUES ('Zâmbia');
INSERT INTO country VALUES ('Zimbabué');