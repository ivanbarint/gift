DROP DATABASE IF EXISTS Gift;

CREATE DATABASE Gift;

USE Gift;

CREATE TABLE Users (
	UserID INT NOT NULL UNIQUE AUTO_INCREMENT,
    Username VARCHAR(100) NOT NULL UNIQUE,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Pswrd TEXT NOT NULL,
    PRIMARY KEY (UserID)
    );
    
CREATE TABLE Persons (
	PersonID INT NOT NULL UNIQUE AUTO_INCREMENT,
    UserID INT NOT NULL,
    PersonName VARCHAR(100) NOT NULL,
    Age INT NOT NULL,
    GenderID INT NOT NULL,
    PRIMARY KEY (PersonID)
    );
    
CREATE TABLE Events (
	EventID INT NOT NULL UNIQUE AUTO_INCREMENT,
    EventTypeID INT NOT NULL,
    EventDate DATE NOT NULL,
    PersonID INT NOT NULL,
    Preference VARCHAR(100),
    PRIMARY KEY (EventID)
    );

CREATE TABLE EventTypes (
	EventTypeID INT NOT NULL UNIQUE AUTO_INCREMENT,
    EventTypeName VARCHAR(50) NOT NULL,
    PRIMARY KEY (EventTypeID)
    );
    
CREATE TABLE Genders (
	GenderID INT NOT NULL UNIQUE AUTO_INCREMENT,
    GenderName VARCHAR(50) NOT NULL,
    PRIMARY KEY (GenderID)
    );
    
ALTER TABLE Persons
	ADD FOREIGN KEY (GenderId) REFERENCES Genders(GenderID);
    
ALTER TABLE Events
	ADD FOREIGN KEY (EventTypeID) REFERENCES EventTypes(EventTypeID);

INSERT INTO Genders (GenderName) VALUES ('Male');
INSERT INTO Genders (GenderName) VALUES ('Female');
INSERT INTO Genders (GenderName) VALUES ('Other');

INSERT INTO EventTypes (EventTypeName) VALUES ('Birthday');
INSERT INTO EventTypes (EventTypeName) VALUES ('Wedding');
INSERT INTO EventTypes (EventTypeName) VALUES ('Anniversery');
INSERT INTO EventTypes (EventTypeName) VALUES ('Engagement');
INSERT INTO EventTypes (EventTypeName) VALUES ('Baby');
INSERT INTO EventTypes (EventTypeName) VALUES ('Private');
INSERT INTO EventTypes (EventTypeName) VALUES ('Other');

DELIMITER $$
CREATE PROCEDURE Reset_Password(IN _email VARCHAR(100), IN new_password VARCHAR(100))
	BEGIN     
		UPDATE Users
		SET password = new_password
		WHERE email = _email;
    END $$
DELIMITER ;
