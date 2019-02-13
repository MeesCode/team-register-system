-- running this will empty your old database and create a new one

DROP SCHEMA IF EXISTS `RoboCup` ;
CREATE SCHEMA IF NOT EXISTS `RoboCup` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `RoboCup` ;

DROP TABLE IF EXISTS `RoboCup`.`users`;

CREATE TABLE IF NOT EXISTS `RoboCup`.`users` (
    email VARCHAR(255) NOT NULL PRIMARY KEY,
    school VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    admin BOOLEAN DEFAULT FALSE,
    address VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(32) NOT NULL
) ENGINE = INNODB;

DROP TABLE IF EXISTS `RoboCup`.`types`;

CREATE TABLE IF NOT EXISTS `RoboCup`.`game_types` (
    type_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    type_name VARCHAR(32) NOT NULL
) ENGINE = INNODB;

DROP TABLE IF EXISTS `RoboCup`.`teams`;

CREATE TABLE IF NOT EXISTS `RoboCup`.`teams` (
	team_id INT AUTO_INCREMENT KEY PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    type_id INT NOT NULL,
    members INT NOT NULL,
    comment TEXT,
    FOREIGN KEY (email)
        REFERENCES users(email)
        ON DELETE CASCADE,
	FOREIGN KEY (type_id) 
		REFERENCES game_types(type_id)
        ON DELETE CASCADE
) ENGINE = INNODB;

-- actual data
INSERT INTO game_types (type_name) VALUES ("Rescue");
INSERT INTO game_types (type_name) VALUES ("OnStage");
INSERT INTO game_types (type_name) VALUES ("Voetbal");
INSERT INTO game_types (type_name) VALUES ("Groeneveld");

-- test data
INSERT INTO users (email, school, password, admin, address, name, phone) VALUES ("mees@robocupjunior.nl", "TU Delft", "$2y$10$.J.MfcHMlwaMVbtJlOKsxe/2imcmtQ8f3G7nX9PLSgT/hvHlT3eva", true, "Kleverling Buismanweg 66", "Mees Brinkhuis", "0625314532");
INSERT INTO teams (email, name, type_id, members) VALUES ("mees@robocupjunior.nl", "GLaDOS 1", 1, 1);
INSERT INTO teams (email, name, type_id, members) VALUES ("mees@robocupjunior.nl", "GLaDOS 2", 4, 1);
