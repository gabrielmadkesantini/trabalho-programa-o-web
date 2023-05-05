    CREATE SCHEMA IF NOT EXISTS `pw` DEFAULT CHARACTER SET utf8;

    CREATE TABLE IF NOT EXISTS `pw`.`users` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `password` VARCHAR(200) NOT NULL,
        `ativo` BOOLEAN NOT NULL DEFAULT 1,
        PRIMARY KEY (`id`)
    );
    CREATE TABLE IF NOT EXISTS `pw`.`documents` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `path` VARCHAR(2000) NOT NULL,
        `users_id` INT NOT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY(`users_id`) REFERENCES users(id)
    )