# D:\FACULTATE\BD\FINAL GIT\myPage\script05.sql



/*        PARTEA 1 - STERGEREA SI RECREAREA BAZEI DE DATE      */

DROP DATABASE muzicaDB;

CREATE DATABASE muzicaDB;

USE muzicaDB;



/*                  PARTEA 2 - CREAREA TABELELOR              */


CREATE TABLE Manager(
idManager SMALLINT PRIMARY KEY AUTO_INCREMENT,
nume VARCHAR(50) NOT NULL,
contact VARCHAR(50)
);

CREATE TABLE CasaDiscuri(
idCasaDiscuri SMALLINT PRIMARY KEY AUTO_INCREMENT,
nume VARCHAR(50) NOT NULL,
anInfiintare YEAR,
adresa VARCHAR(50),
contact VARCHAR(50)
);


CREATE TABLE Artisti(
idArtist SMALLINT PRIMARY KEY AUTO_INCREMENT,
nume VARCHAR(50) NOT NULL,
dataNasterii DATE,
gen VARCHAR(50),
origine VARCHAR(50),
contact VARCHAR(50),
idCasaDiscuri SMALLINT NOT NULL,
idManager SMALLINT NOT NULL,
CONSTRAINT fk_cd FOREIGN KEY (idCasaDiscuri)
REFERENCES CasaDiscuri(idCasaDiscuri) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_m FOREIGN KEY (idManager)
REFERENCES Manager(idManager) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE Albume (
idAlbum SMALLINT PRIMARY KEY AUTO_INCREMENT,
titlu VARCHAR(50) NOT NULL,
nrMelodii SMALLINT,
idArtist SMALLINT NOT NULL,
CONSTRAINT fk_a FOREIGN KEY (idArtist)
REFERENCES Artisti(idArtist) ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE Melodii(
idMelodie SMALLINT PRIMARY KEY AUTO_INCREMENT,
titlu VARCHAR(50) NOT NULL,
gen VARCHAR(50),
dataLansare DATE,
rating DECIMAL(2,1),
idAlbum SMALLINT NOT NULL,
CONSTRAINT fk_al FOREIGN KEY (idAlbum)
REFERENCES Albume(idAlbum) ON DELETE CASCADE ON UPDATE CASCADE
);




CREATE TABLE Nominalizari(
idNominalizare SMALLINT PRIMARY KEY AUTO_INCREMENT, 
nume VARCHAR(50) NOT NULL,
categorie VARCHAR(50),
dataNominalizare YEAR,
idArtist SMALLINT,
idAlbum SMALLINT,
idMelodie SMALLINT,
CONSTRAINT fk_art FOREIGN KEY (idArtist)
REFERENCES Artisti(idArtist) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_alb FOREIGN KEY (idAlbum)
REFERENCES Albume(idAlbum) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_mel FOREIGN KEY (idMelodie)
REFERENCES Melodii(idMelodie) ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE Features(
idFeature SMALLINT PRIMARY KEY AUTO_INCREMENT,
idMelodie SMALLINT NOT NULL,
idArtist SMALLINT NOT NULL,
CONSTRAINT fk_art FOREIGN KEY (idArtist)
REFERENCES Artisti(idArtist) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_mel FOREIGN KEY (idMelodie)
REFERENCES Melodii(idMelodie) ON DELETE CASCADE ON UPDATE CASCADE
);



/*         PARTEA 3 - INSERAREA INREGISTRARILOR IN TABELE      */



INSERT INTO Manager (nume, contact) VALUES ("Paul Rosenberg", "(840) 297-5488");
INSERT INTO Manager (nume, contact) VALUES ("Scooter Braun", "(203) 973-7098");
INSERT INTO Manager (nume, contact) VALUES ("Colonel Tom Parker", "(907) 599-4845");
INSERT INTO Manager (nume, contact) VALUES ("John Branca", "(209) 453-0621");
INSERT INTO Manager (nume, contact) VALUES ("Miguel Angel Arenas", "(480) 649-1429");
INSERT INTO Manager (nume, contact) VALUES ("Steve Pamon", "(785) 619-5972");
INSERT INTO Manager (nume, contact) VALUES ("Jonathan Dickins", "(405) 798-7905");
INSERT INTO Manager (nume, contact) VALUES ("Adel Nur", "(424) 557-6949");
INSERT INTO Manager (nume, contact) VALUES ("Abou ‘Bu’ Thiam", "(248) 613-1249");
INSERT INTO Manager (nume, contact) VALUES ("Maggie Baird", "(226) 975-7076");
INSERT INTO Manager (nume, contact) VALUES ("AdelNur", "(585) 574-0839");
INSERT INTO Manager (nume, contact) VALUES ("David Weise", "(860) 345-2103");


INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES ("Shady Records",1999,"Ferndale Michigan","(209) 453-0621");
INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES ("Republic Records",1995,"New York","(585) 574-0839");
INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES ("Sun Records",1952,"Memphis Tennessee","(840) 297-5488");
INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES (",Epic Records",1953,"New York","(405) 798-7905");
INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES ("RCA Records",1928,"New York","(424) 557-6949");
INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES ("Parkwood Entertainment",2010,"Los Angeles","(325) 391-2617");
INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES ("XL Recordings",2005,"California","(800) 712-5091");
INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES ("OVO Sound",2001,"Tennessee","(202) 236-0541");
INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES ("Roc-A-Fella Records",2000,"New York","(860) 345-2103");
INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES ("Interscope Records",2008,"Canada","(657) 772-0177");
INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES ("Def Jam Recordings",1987,"Florida","(936) 473-4996");
INSERT INTO CasaDiscuri (nume, anInfiintare, adresa, contact) VALUES ("Young Money Entertainment",2005,"New Orleans Louisiana","(907) 599-4845");


INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Eminem","1972-10-17","Rap","St.Joseph Missouri","(484) 435-5988",1,1);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Justin Bieber","1994-03-01","1994-03-01","London Ontario","(514) 716-0393",2,2);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Ariana Grande","1993-06-26","Pop","Boca Raton","(385) 679-0257",2,2);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Elvis Presley","1935-01-08","Rock","Tupelo Mississippi","(447) 451-5738",3,3);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Michael Jackson","1958-08-29","Pop","Gary Indiana","(416) 621-9291",4,4);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Enrique Iglesias","1975-05-08","Pop","Madrid","(840) 726-2818",5,5);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Beyonce","1981-09-04","Pop","Houston","(302) 580-4809",6,6);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Adele","1988-06-05","Soul","Tottenham","(507) 471-3874",7,7);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Drake","1986-10-24","Rap","Toronto Ontario","(507) 764-4180",8,8);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Kanye West","1977-05-08","Hip-Hop","Atlanta Georgia","(828) 615-2750",9,9);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Billie Eilish","2001-12-18","Indie-Pop","Los-Angeles California","(228) 212-1949",10,10);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Jay-Z","1969-12-04","Hip-Hop","Brooklyn New York","(326) 578-5910",11,11);
INSERT INTO Artisti (nume, dataNasterii, gen, origine, contact,idManager, idCasaDiscuri) VALUES ("Lil Wayne","1982-12-27","Hip-Hop","New Orleans Louisiana","(434) 342-0673",12,12);


INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("The Slim Shady LP",14,1);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("The Marshall Mathers LP",18,1);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Purpose",13,2);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Changes",17,2);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("My everything",12,3);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Dangerous Woman",15,3);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("From Elvis in Memphis",12,4);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Promised Land",10,4);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Thriller",9,5);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Bad",10,5);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Escape",14,6);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Euphoria",13,6);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Lemonade",12,7);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Renaissance",16,7);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("21",11,8);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("25",12,8);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Thank Me Later",14,9);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Take Care",8,9);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("The College Dropout",21,10);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Yeezus",18,10);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("When We All Fall Asleep, Where Do We Go?",14,11);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("Happier Than Ever",16,11);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("The Blueprint",13,12);
INSERT INTO Albume (titlu, nrMelodii, idArtist) VALUES ("The Black Album",14,12);


INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("My Name Is", "Rap", "1999-01-25",3.3,1);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Guilty Conscience", "Rap", "2000-11-21",3.5,2);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Sorry", "Pop", "2015-10-23",3.9,3);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("What Do You Mean?", "Pop", "2015-08-28",3.7,3);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Intentions", "R&B-Pop", "2020-02-07",3.5,4);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Problem", "Pop-R&B", "2014-04-28",3.5,5);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Dangerous Woman", "Pop-R&B", "2016-03-11",4.1,6);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Promised Land", "Rock and Roll", "1975-06-13",4.4,7);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Suspicious Minds", "Rock and Roll", "1969-08-26",4.3,8);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Thriller", "Pop-R&B", "1982-11-23",4.7,9);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Beat It", "Pop-R&B", "1988-10-21",4.6,10);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Hero", "Pop", "2001-09-03",4.0,11);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("I Like It", "Dance-Pop", "2010-05-03",4.1,12);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Formation", "R&B", "2016-02-06",3.9,13);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Hold Up", "R&B", "2016-04-23",3.2,14);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Rolling in the Deep", "Pop", "2010-11-29",4.8,15);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Hello", "Pop", "2015-10-15",4.6,16);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Over", "Rap", "2010-03-8",3.0,17);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Take Care", "Hip-Hop", "2012-02-7",3.1,18);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Jesus Walks", "Hip-Hop", "2004-05-11",4.2,19);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Black Skinhead", "Hip-Hop", "2013-06-19",3.9,20);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Bad Guy", "Pop", "2019-03-29",4.4,21);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Happier Than Ever", "Pop", "2021-07-30",4.7,22);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("Izzo", "Hip-Hop", "2001-08-07",4.9,23);
INSERT INTO Melodii (titlu, gen, dataLansare, rating, idAlbum) VALUES ("99 Problems", "Hip-Hop", "2004-04-27",4.4,24);


INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Album of the Year", "Grammy Awards",2001 ,1 ,NULL ,2 );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Artist of the Year", "Billboard Music Awards",2002 ,1 ,NULL ,NULL );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Best New Artist", "Grammy Awards",2001 ,2 ,NULL ,NULL );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Video of the Year", "American Music Awards",2016 ,2 ,5 ,3 );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Record of the Year", "Grammy Awards",2015 ,3 ,8 ,5 );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Best Pop Album", "Grammy Awards",2015 ,3 ,NULL ,5 );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Best Newcomer-Male", "Golden Globe Awards",1957 ,4 ,NULL ,NULL );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Record of the Year", "Grammy Awards",1984 ,5 ,13 ,9 );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Artist of the Century", "American Music Awards",2002 ,5 ,NULL ,NULL );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Best Male Pop Vocal Album", "Latin Grammy Awards",2011 ,6 ,NULL ,12 );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Favorite Latin Artist", "American Music Awards",2009 ,6 ,NULL ,NULL );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Best Music Video", "Grammy Awards",2017 ,7 ,17 ,13 );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Album of the Year", "Grammy Awards",2012 ,8 ,NULL ,15 );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Best Rap Album", "Grammy Awards",2011 ,9 ,NULL ,17 );
INSERT INTO Nominalizari (nume, categorie, dataNominalizare, idArtist, idMelodie, idAlbum) VALUES ("Best Rap Album", "Grammy Awards",2005 ,10 ,NULL ,20 );


INSERT INTO Features (idMelodie, idArtist) VALUES (7,12);
INSERT INTO Features (idMelodie, idArtist) VALUES (8,13);
INSERT INTO Features (idMelodie, idArtist) VALUES (9,13);
INSERT INTO Features (idMelodie, idArtist) VALUES (17,12);
INSERT INTO Features (idMelodie, idArtist) VALUES (21,12);
INSERT INTO Features (idMelodie, idArtist) VALUES (22,13);
INSERT INTO Features (idMelodie, idArtist) VALUES (23,12);
INSERT INTO Features (idMelodie, idArtist) VALUES (24,12);
INSERT INTO Features (idMelodie, idArtist) VALUES (28,1);




/*  PARTEA 4 - VIZUALIZAREA STUCTURII BD SI A INREGISTRARILOR  */


DESCRIBE CasaDiscuri;
DESCRIBE Manager;
DESCRIBE Artisti;
DESCRIBE Albume;
DESCRIBE Melodii;
DESCRIBE Nominalizari;
DESCRIBE Features;





SELECT * FROM CasaDiscuri;
SELECT * FROM Manager;
SELECT * FROM Artisti;
SELECT * FROM Albume;
SELECT * FROM Melodii;
SELECT * FROM Nominalizari;
SELECT * FROM Features;