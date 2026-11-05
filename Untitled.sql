USE harry_potter_db;

-- Desactivar temporalmente la verificación de llaves foráneas
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS Estudiante;
DROP TABLE IF EXISTS Casa;

CREATE TABLE Casa (
    idCasa INT AUTO_INCREMENT PRIMARY KEY,
    nombre_casa VARCHAR(50) NOT NULL
);

INSERT INTO Casa (nombre_casa) VALUES ('Gryffindor'), ('Slytherin'), ('Ravenclaw'), ('Hufflepuff');

CREATE TABLE Estudiante (
    idEstudiante INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    edad INT NOT NULL,
    anio_cursado INT NOT NULL,
    idCasa INT,
    FOREIGN KEY (idCasa) REFERENCES Casa(idCasa)
);

-- Volver a activar la verificación
SET FOREIGN_KEY_CHECKS = 1;








ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '1234';
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY '1234';
FLUSH PRIVILEGES;