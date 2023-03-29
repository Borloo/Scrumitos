DROP TABLE IF EXISTS Emplacement;
DROP TABLE IF EXISTS Type;


CREATE TABLE Type (
idType VARCHAR(4),
nomType VARCHAR(25),
PRIMARY KEY (idType)
) Engine=InnoDB;

CREATE TABLE Emplacement (
idEmpl VARCHAR(3),
idType VARCHAR(4) NOT NULL,
adresseEmpl VARCHAR(50),
anneeConstruction mediumint(4),
PRIMARY KEY (idEmpl),
FOREIGN KEY(idType) REFERENCES Type(idType)
)Engine=InnoDB; 


INSERT INTO Type (idType, nomType) VALUES ('100', 'Bungalow'); 
INSERT INTO Type (idType, nomType) VALUES ('200', 'Mobil-Home'); 
INSERT INTO Type (idType, nomType) VALUES ('300', 'Emplacement');

INSERT INTO Emplacement (idEmpl, idType, adresseEmpl, anneeConstruction) VALUES ('115', '100','4 rue du Soleil',2012);
INSERT INTO Emplacement (idEmpl, idType, adresseEmpl, anneeConstruction) VALUES ('198', '100', '7 rue des Fleurs', 2008);
INSERT INTO Emplacement (idEmpl, idType, adresseEmpl, anneeConstruction) VALUES ('231', '200', '5 rue des Fleurs', 2003);
INSERT INTO Emplacement (idEmpl, idType, adresseEmpl, anneeConstruction) VALUES ('302', '300', '1 rue de la Plage', 1999);
INSERT INTO Emplacement (idEmpl, idType, adresseEmpl, anneeConstruction) VALUES ('357', '300', '12 rue des Pins', 2016);	

COMMIT;





