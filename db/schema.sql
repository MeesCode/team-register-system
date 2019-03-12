
CREATE SCHEMA IF NOT EXISTS `c27055aanmeldsysteem` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `c27055aanmeldsysteem` ;

CREATE TABLE IF NOT EXISTS `c27055aanmeldsysteem`.`users` (
    email VARCHAR(255) NOT NULL PRIMARY KEY,
    school VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    admin BOOLEAN DEFAULT FALSE,
    address VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(32) NOT NULL
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS `c27055aanmeldsysteem`.`game_types` (
    type_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    type_name VARCHAR(32) NOT NULL
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS `c27055aanmeldsysteem`.`teams` (
	team_id INT AUTO_INCREMENT KEY PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    type_id INT NOT NULL,
    members INT NOT NULL,
    age INT NOT NULL,
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
INSERT INTO game_types (type_name) VALUES ("Dansen");
INSERT INTO game_types (type_name) VALUES ("Voetbal");
INSERT INTO game_types (type_name) VALUES ("Groeneveld");

-- test data
INSERT INTO users (email, school, password, admin, address, name, phone) VALUES ("mees@robocupjunior.nl", "TU Delft", "$2y$10$.J.MfcHMlwaMVbtJlOKsxe/2imcmtQ8f3G7nX9PLSgT/hvHlT3eva", true, "Kleverling Buismanweg 66", "Mees Brinkhuis", "0625314532");
