-- Opret database
CREATE DATABASE IF NOT EXISTS proyecto_peliculas;
USE proyecto_peliculas;

-- Usuario para bdd
CREATE USER 'peliculas_app'@'localhost'
IDENTIFIED BY 'Peliculas123$';

GRANT ALL PRIVILEGES
ON proyecto_peliculas.*
TO 'peliculas_app'@'localhost';

FLUSH PRIVILEGES;



-- Tabla: usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellidos VARCHAR(100),
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla: categorias
CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(100)
);

-- Tabla: peliculas
CREATE TABLE peliculas (
    id_pelicula INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200),
    director VARCHAR(150),
    duracion_min INT,
    restriccion_edad INT,
    fecha_estreno DATE,
    descripcion TEXT,
    imagen VARCHAR(255),
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

-- Tabla: resenas
CREATE TABLE resenas (
    id_resena INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_pelicula INT,
    comentario TEXT,
    fecha_resena DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (id_usuario, id_pelicula),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_pelicula) REFERENCES peliculas(id_pelicula)
);

-- Tabla: puntajes
CREATE TABLE puntajes (
    id_puntaje INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_pelicula INT,
    puntaje_1_5 INT CHECK (puntaje_1_5 BETWEEN 1 AND 5),
    UNIQUE (id_usuario, id_pelicula),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_pelicula) REFERENCES peliculas(id_pelicula)
);


-- Tabla: listas (watchlists)
CREATE TABLE listas (
    id_lista INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    nombre VARCHAR(100),
    fecha_agregado DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);


-- Tabla: listas_peliculas (relación N:M)
CREATE TABLE listas_peliculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_lista INT,
    id_pelicula INT,
    FOREIGN KEY (id_lista) REFERENCES listas(id_lista),
    FOREIGN KEY (id_pelicula) REFERENCES peliculas(id_pelicula)
);

-- 1) Vista: promedio de puntuación por película
CREATE VIEW vista_promedio_puntaje AS
SELECT 
    p.id_pelicula,
    p.nombre AS pelicula,
    ROUND(AVG(pt.puntaje_1_5), 2) AS promedio_puntaje,
    COUNT(pt.id_puntaje) AS total_votos
FROM peliculas p
LEFT JOIN puntajes pt ON p.id_pelicula = pt.id_pelicula
GROUP BY p.id_pelicula, p.nombre;


-- 2) Vista: películas con categoría y puntuación media
CREATE VIEW vista_peliculas_con_categoria_y_puntaje AS
SELECT
    p.id_pelicula,
    p.nombre AS pelicula,
    c.nombre_categoria,
    ROUND(AVG(pt.puntaje_1_5), 2) AS promedio_puntaje
FROM peliculas p
LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
LEFT JOIN puntajes pt ON p.id_pelicula = pt.id_pelicula
GROUP BY p.id_pelicula, p.nombre, c.nombre_categoria;


-- 3) Vista: watchlist lista para mostrar
CREATE VIEW vista_watchlist AS
SELECT
    u.id_usuario,
    u.username,
    l.id_lista,
    l.nombre AS nombre_lista,
    p.id_pelicula,
    p.nombre AS pelicula,
    p.imagen
FROM listas l
JOIN usuarios u ON l.id_usuario = u.id_usuario
JOIN listas_peliculas lp ON l.id_lista = lp.id_lista
JOIN peliculas p ON lp.id_pelicula = p.id_pelicula;



-- =========================
-- CATEGORÍAS (15)
-- =========================
INSERT INTO categorias (nombre_categoria) VALUES
('Acción'),
('Drama'),
('Ciencia ficción'),
('Comedia'),
('Thriller'),
('Aventura'),
('Fantasía'),
('Romance'),
('Terror'),
('Animación'),
('Documental'),
('Crimen'),
('Misterio'),
('Guerra'),
('Historia');

-- =========================
-- USUARIOS (5)
-- =========================
INSERT INTO usuarios (nombre, apellidos, username, password) VALUES
('Oscar', 'Sorensen', 'oscaradmin', 'admin'),
('Carlos', 'Gallardo', 'CGallardo', 'Gallardo123'),
('Bryan', 'Avila', 'BAvila', 'Avila123'),
('Jose Vicente', 'Carratala', 'jocarsa', 'jocarsa123'),
('Laura', 'Martinez', 'lmartinez', 'password123');

-- =========================
-- PELÍCULAS (25)
-- =========================
INSERT INTO peliculas
(nombre, director, duracion_min, restriccion_edad, fecha_estreno, descripcion, imagen, id_categoria)
VALUES
('Película 1',  'Director A', 120, 12, '2010-01-01', 'Descripción básica de la película 1.',  'img/peliculas/p1.jpg', 1),
('Película 2',  'Director B', 110, 7,  '2011-02-02', 'Descripción básica de la película 2.',  'img/peliculas/p2.jpg', 2),
('Película 3',  'Director C', 130, 16, '2012-03-03', 'Descripción básica de la película 3.',  'img/peliculas/p3.jpg', 3),
('Película 4',  'Director D', 95,  7,  '2013-04-04', 'Descripción básica de la película 4.',  'img/peliculas/p4.jpg', 4),
('Película 5',  'Director E', 140, 16, '2014-05-05', 'Descripción básica de la película 5.',  'img/peliculas/p5.jpg', 5),
('Película 6',  'Director F', 125, 12, '2015-06-06', 'Descripción básica de la película 6.',  'img/peliculas/p6.jpg', 6),
('Película 7',  'Director G', 118, 7,  '2016-07-07', 'Descripción básica de la película 7.',  'img/peliculas/p7.jpg', 7),
('Película 8',  'Director H', 102, 12, '2017-08-08', 'Descripción básica de la película 8.',  'img/peliculas/p8.jpg', 8),
('Película 9',  'Director I', 90,  18, '2018-09-09', 'Descripción básica de la película 9.',  'img/peliculas/p9.jpg', 9),
('Película 10', 'Director J', 85,  3,  '2019-10-10','Descripción básica de la película 10.', 'img/peliculas/p10.jpg',10),
('Película 11', 'Director K', 100, 7,  '2020-01-11','Descripción básica de la película 11.', 'img/peliculas/p11.jpg',11),
('Película 12', 'Director L', 135, 16, '2020-02-12','Descripción básica de la película 12.', 'img/peliculas/p12.jpg',12),
('Película 13', 'Director M', 128, 12, '2020-03-13','Descripción básica de la película 13.', 'img/peliculas/p13.jpg',13),
('Película 14', 'Director N', 142, 16, '2020-04-14','Descripción básica de la película 14.', 'img/peliculas/p14.jpg',14),
('Película 15', 'Director O', 115, 12, '2020-05-15','Descripción básica de la película 15.', 'img/peliculas/p15.jpg',15),
('Película 16', 'Director P', 121, 7,  '2021-01-16','Descripción básica de la película 16.', 'img/peliculas/p16.jpg',1),
('Película 17', 'Director Q', 133, 16, '2021-02-17','Descripción básica de la película 17.', 'img/peliculas/p17.jpg',2),
('Película 18', 'Director R', 97,  7,  '2021-03-18','Descripción básica de la película 18.', 'img/peliculas/p18.jpg',3),
('Película 19', 'Director S', 109, 12, '2021-04-19','Descripción básica de la película 19.', 'img/peliculas/p19.jpg',4),
('Película 20', 'Director T', 150, 18, '2021-05-20','Descripción básica de la película 20.', 'img/peliculas/p20.jpg',5),
('Película 21', 'Director U', 112, 7,  '2022-01-21','Descripción básica de la película 21.', 'img/peliculas/p21.jpg',6),
('Película 22', 'Director V', 99,  12, '2022-02-22','Descripción básica de la película 22.', 'img/peliculas/p22.jpg',7),
('Película 23', 'Director W', 138, 16, '2022-03-23','Descripción básica de la película 23.', 'img/peliculas/p23.jpg',8),
('Película 24', 'Director X', 104, 7,  '2022-04-24','Descripción básica de la película 24.', 'img/peliculas/p24.jpg',9),
('Película 25', 'Director Y', 126, 12, '2022-05-25','Descripción básica de la película 25.', 'img/peliculas/p25.jpg',10);

-- =========================
-- PUNTAJES (1 por película)
-- =========================
INSERT INTO puntajes (id_usuario, id_pelicula, puntaje_1_5) VALUES
(1, 1, 5),(2, 2, 4),(3, 3, 3),(4, 4, 4),(5, 5, 5),
(1, 6, 4),(2, 7, 3),(3, 8, 4),(4, 9, 2),(5,10, 3),
(1,11, 4),(2,12, 5),(3,13, 3),(4,14, 4),(5,15, 5),
(1,16, 3),(2,17, 4),(3,18, 2),(4,19, 4),(5,20, 5),
(1,21, 4),(2,22, 3),(3,23, 4),(4,24, 3),(5,25, 5);

-- =========================
-- RESEÑAS (1 por película)
-- =========================
INSERT INTO resenas (id_usuario, id_pelicula, comentario) VALUES
(1, 1, 'Muy buena película, entretenida.'),
(2, 2, 'Historia interesante y bien contada.'),
(3, 3, 'Correcta, aunque algo lenta.'),
(4, 4, 'Me gustó bastante.'),
(5, 5, 'Excelente, muy recomendable.'),
(1, 6, 'Buena producción.'),
(2, 7, 'Entretenida para pasar el rato.'),
(3, 8, 'No está mal.'),
(4, 9, 'Un poco floja.'),
(5,10, 'Divertida.'),
(1,11, 'Buen ritmo.'),
(2,12, 'Muy buena dirección.'),
(3,13, 'Aceptable.'),
(4,14, 'Interesante propuesta.'),
(5,15, 'Me encantó.'),
(1,16, 'Correcta.'),
(2,17, 'Buena historia.'),
(3,18, 'Podría ser mejor.'),
(4,19, 'Sólida.'),
(5,20, 'Muy recomendable.'),
(1,21, 'Entretenida.'),
(2,22, 'Normal.'),
(3,23, 'Bien hecha.'),
(4,24, 'No destaca mucho.'),
(5,25, 'Muy buena.');

-- =========================
-- BASIC DATABASE TESTS
-- These queries are used to verify that the database structure,
-- relationships, constraints, and views are working correctly.
-- =========================


-- 1) Check that all tables exist
-- This confirms that the database schema was created successfully.
SHOW TABLES;


-- 2) Check that each table contains the expected amount of data
-- These counts should match the inserted test data.
SELECT COUNT(*) AS total_categorias FROM categorias;
SELECT COUNT(*) AS total_usuarios FROM usuarios;
SELECT COUNT(*) AS total_peliculas FROM peliculas;
SELECT COUNT(*) AS total_puntajes FROM puntajes;
SELECT COUNT(*) AS total_resenas FROM resenas;


-- 3) Test foreign key relationships
-- This verifies that movies are correctly linked to their categories.
SELECT 
    p.nombre AS movie,
    c.nombre_categoria AS category
FROM peliculas p
JOIN categorias c ON p.id_categoria = c.id_categoria
LIMIT 5;


-- 4) Test UNIQUE constraint on ratings (puntajes)
-- Each user can only rate a movie once.
-- This INSERT should FAIL with a duplicate entry error.
INSERT INTO puntajes (id_usuario, id_pelicula, puntaje_1_5)
VALUES (1, 1, 3);


-- 5) Test view: average rating per movie
-- This view calculates the average score and total votes for each movie.
SELECT * 
FROM vista_promedio_puntaje
LIMIT 5;


-- 6) Test view: movies with category and average rating
-- This combines movies, categories, and their average scores.
SELECT * 
FROM vista_peliculas_con_categoria_y_puntaje
LIMIT 5;


-- 7) Realistic example query
-- This shows the top 5 highest-rated movies.
SELECT 
    pelicula,
    promedio_puntaje
FROM vista_promedio_puntaje
ORDER BY promedio_puntaje DESC
LIMIT 5;

-------
-- =========================
-- DATA DISPLAY QUERIES
-- These queries are used to display the main data
-- that will later be shown on the website (PHP frontend).
-- =========================


-- 1) Show all users
-- Used for admin panels or debugging authentication.
-- Show users including passwords (FOR TESTING ONLY)
-- This is useful to verify that test data was inserted correctly.
SELECT
    id_usuario,
    nombre,
    apellidos,
    username,
    password
FROM usuarios; -- normally you wouldn't select passwords



-- 2) Show all movies
-- Basic movie list with main information.
SELECT 
    id_pelicula,
    nombre,
    director,
    duracion_min,
    restriccion_edad,
    fecha_estreno
FROM peliculas;


-- 3) Show movies with category
-- Common query for listing movies on the homepage.
SELECT 
    p.id_pelicula,
    p.nombre AS movie,
    c.nombre_categoria AS category
FROM peliculas p
JOIN categorias c ON p.id_categoria = c.id_categoria;


-- 4) Show movies with category and average rating
-- Uses the view to simplify the query logic.
SELECT 
    pelicula,
    nombre_categoria,
    promedio_puntaje
FROM vista_peliculas_con_categoria_y_puntaje;


-- 5) Show all reviews with user and movie
-- Used to display reviews on a movie detail page.
SELECT
    u.username,
    p.nombre AS movie,
    r.comentario,
    r.fecha_resena
FROM resenas r
JOIN usuarios u ON r.id_usuario = u.id_usuario
JOIN peliculas p ON r.id_pelicula = p.id_pelicula;


-- 6) Show ratings given by users
-- Useful for testing or user profile pages.
SELECT
    u.username,
    p.nombre AS movie,
    pt.puntaje_1_5 AS rating
FROM puntajes pt
JOIN usuarios u ON pt.id_usuario = u.id_usuario
JOIN peliculas p ON pt.id_pelicula = p.id_pelicula;



-- NUEVO, IMPORTANTE! HZLO ESTO

ALTER TABLE puntajes
DROP FOREIGN KEY puntajes_ibfk_2;

ALTER TABLE puntajes
ADD CONSTRAINT puntajes_ibfk_2
FOREIGN KEY (id_pelicula)
REFERENCES peliculas(id_pelicula)
ON DELETE CASCADE;


ALTER TABLE resenas
DROP FOREIGN KEY resenas_ibfk_2;

ALTER TABLE resenas
ADD CONSTRAINT resenas_ibfk_2
FOREIGN KEY (id_pelicula)
REFERENCES peliculas(id_pelicula)
ON DELETE CASCADE;


ALTER TABLE listas_peliculas
DROP FOREIGN KEY listas_peliculas_ibfk_2;

ALTER TABLE listas_peliculas
ADD CONSTRAINT listas_peliculas_ibfk_2
FOREIGN KEY (id_pelicula)
REFERENCES peliculas(id_pelicula)
ON DELETE CASCADE;