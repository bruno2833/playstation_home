CREATE DATABASE  IF NOT EXISTS `bd-playstation`;
USE `bd-playstation`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(45) NOT NULL,
            `email` varchar(45) NOT NULL,
            `password` varchar(255) NOT NULL,
            `photo` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
            PRIMARY KEY (`id`),
            UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
UNLOCK TABLES;


CREATE TABLE `products` (
    `id` INT(255) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `preco` DECIMAL(10 , 2),
    `idCategory` int(11) NOT NULL,
    `description` VARCHAR(2000) NOT NULL,
    `idAdm` int(11) NOT NULL,
    KEY `fk_adm_adm1_idx` (`idAdm`),
    CONSTRAINT `fk_adm_adm1` FOREIGN KEY (`idAdm`) REFERENCES `adm` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = MyISAM;

INSERT INTO `products` VALUES (NULL, 'PLaystation 4', 1050.00, 1 , 'Console lançado em 2013', 1);

DROP TABLE IF EXISTS `adm`;
CREATE TABLE `adm` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(45) NOT NULL,
            `email` varchar(45) NOT NULL,
            `password` varchar(255) NOT NULL,
            /*`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),*/
            PRIMARY KEY (`id`),
            UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO `adm` VALUES (1, 'marcio', 'mabua@gmail.com', "alal");

LOCK TABLES `users` WRITE;
UNLOCK TABLES;


CREATE TABLE `categories` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `field` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

LOCK TABLES `categories` WRITE;

INSERT INTO `categories` VALUES (1,'Consoles'),(2,'Games'),(3,'Diversos');
UNLOCK TABLES;