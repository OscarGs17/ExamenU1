CREATE SCHEMA IF NOT EXISTS usuarios;
USE usuarios;
CREATE TABLE IF NOT EXISTS usuario(

  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50) NOT NULL,
  password VARCHAR(250) NOT NULL

) ENGINE = InnoDB CHARACTER SET = utf8;