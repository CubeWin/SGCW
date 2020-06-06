use sgcw;
/**
 * @var TABLA PERSONA
 */
DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	`surname` varchar(100) NOT NULL,
	`telephone` varchar(15),
	`email` varchar(100),
	`gender` TINYINT NOT NULL,
	`create_at` DATETIME NOT NULL DEFAULT now(),
	`update_at` DATETIME NOT NULL DEFAULT "00-00-0000",
	`disable_at` DATETIME NOT NULL DEFAULT "00-00-0000",
	`state` TINYINT NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
/**
 * @var TABLA USUARIO
 */
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`id_persona` INT NOT NULL,
	`id_grupo` INT NOT NULL,
	`user` varchar(25) NOT NULL UNIQUE,
	`password` varchar(60) NOT NULL,
	`token` varchar(250) NOT NULL,
	`create_at` DATETIME NOT NULL DEFAULT now(),
	`update_at` DATETIME NOT NULL DEFAULT "00-00-0000",
	`disable_at` DATETIME NOT NULL DEFAULT "00-00-0000",
	`state` TINYINT NOT NULL DEFAULT 1,
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_id_persona` FOREIGN KEY (`id_persona`)
    REFERENCES `persona` (`id`) ON DELETE RESTRICT
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
/**
 * @var TABLA BLOQUE
 */
DROP TABLE IF EXISTS `bloque`;
CREATE TABLE `bloque`(
    `id` int NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100) NOT NULL,
    `total` int NOT NULL,
    `iterable` int,
    PRIMARY KEY(`id`)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
/**
 * @var TABLA CONTENIDO_HTML
 */
DROP TABLE IF EXISTS `contenido_html`;
CREATE TABLE `contenido_html` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_bloque` int NOT NULL,
    `html` varchar(500),
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_id_bloque` FOREIGN KEY (`id_bloque`) REFERENCES `bloque` (`id`) ON DELETE RESTRICT
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
/**
 * @var TABLA TIPO_EDITABLE
 */
DROP TABLE IF EXISTS `tipo_editable`;
CREATE TABLE `tipo_editable` (
    `id` int NOT NULL AUTO_INCREMENT,
    `contenido` varchar(200) NOT NULL,
    `descripcion` varchar(200),
    PRIMARY KEY(`id`)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
/**
 * @var TABLA CONTENIDO_EDITABLE
 */
DROP TABLE IF EXISTS `contenido_editable`;
CREATE TABLE `contenido_editable` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_contenido_html` int NOT NULL,
    `id_tipo_editable` int NOT NULL,
    `contenedor` int NOT NULL,
    `linea` int NOT NULL,
    `descripcion` varchar(500) NOT NULL DEFAULT "",
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_id_contenido_html` FOREIGN KEY (`id_contenido_html`) REFERENCES `contenido_html` (`id`) ON DELETE RESTRICT,
    CONSTRAINT `fk_id_tipo_editable` FOREIGN KEY (`id_tipo_editable`) REFERENCES `tipo_editable` (`id`) ON DELETE RESTRICT
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
/**
 * @var TABLA PAGE
 */
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100),
    `titulo` varchar(100),
    `descripcion` varchar(500),
    `estado` int NOT NULL DEFAULT 1,
    PRIMARY KEY(`id`)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
/**
 * @var TABLA SECCION
 */
DROP TABLE IF EXISTS `seccion`;
CREATE TABLE `seccion` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_page` int NOT NULL,
    `nombre` varchar(100) NOT NULL,
    `descripcion` varchar(500) NOT NULL,
    `estado` TINYINT NOT NULL DEFAULT 1,
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_id_page` FOREIGN KEY (`id_page`) REFERENCES `page` (`id`) ON DELETE RESTRICT
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
/**
 * @var TABLA DETALLE
 */
DROP TABLE IF EXISTS `detalle`;
CREATE TABLE `detalle` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_bloque`  int NOT NULL,
    `id_seccion` int NOT NULL,
    `n_orden` int NOT NULL,
    `grupo` int,
    `id_detalle` int,
    PRIMARY KEY(`id`),
    CONSTRAINT `dfk_id_bloque` FOREIGN KEY (`id_bloque`) REFERENCES `bloque` (`id`) ON DELETE RESTRICT,
    CONSTRAINT `dfk_id_detalle` FOREIGN KEY (`id_detalle`) REFERENCES `detalle` (`id`) ON DELETE RESTRICT,
    CONSTRAINT `dfk_id_seccion` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id`) ON DELETE RESTRICT
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
/**
 * @var TABLA DETALLE_TEXO
 */
DROP TABLE IF EXISTS `detalle_texto`;
CREATE TABLE `detalle_texto` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_detalle` int NOT NULL,
    `contenido` varchar(500),
    `linea` int NOT NULL,
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_id_detalle` FOREIGN KEY (`id_detalle`) REFERENCES `detalle` (`id`) ON DELETE RESTRICT
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
/**
 * ### INSERTS
 * ### BLOQUE
 */
INSERT INTO `bloque` (nombre, total, iterable)
VALUES ('slib', 1, 0), ('content', 3, 1), ('content2', 2, 0), ('subcontent', 2, 1);
/**
 * ### CONTENIDO_HTML
 */
INSERT INTO `contenido_html` (id_bloque, html)
VALUES (1, '<div>'), (1, NULL), (1, '</div>'), (2, '<div>'), (2, '<h1>'), (2, NULL), (2, '</h1>'), (2, '<p>'), (2, NULL), (2, '</p>'), (2, '<p>'), (2, NULL), (2, '</p>'), (2, '</div>'), (3, '<div>'), (3, '<ul>'), (3, NULL), (3, '</ul>'), (3, '<p>'), (3, NULL), (3, '</p>'), (3, '</div>'), (4, '<li>'), (4, '<p>'), (4, NULL), (4, '</p>'), (4, '<i>'), (4, NULL), (4, '</i>'), (4, '</li>');
/**
 * ### TIPO_EDITABLE
 */
INSERT INTO `tipo_editable` (contenido, descripcion)
VALUES ('texto', 'Texto plano'), ('imagen', 'Buscar en el gestor de imagenes');
/**
 * ### CONTENIDO_EDITABLE
 */
INSERT INTO `contenido_editable` ( id_contenido_html, id_tipo_editable, contenedor, linea, descripcion )
VALUES (2, 2, 1, 1, ""), (6, 1, 0, 1, ""), (9, 1, 0, 2, ""), (12, 1, 0, 1, ""), (17, 2, 1, 1, ""), (20, 1, 0, 1, ""), (25, 1, 0, 1, ""), (28, 1, 0, 1, "");
/**
 * ### PAGE
 */
INSERT INTO `page` (nombre, titulo, descripcion, estado)
VALUES ('inicio', 'Bienvenido', 'Pagína de inicio', 1),
    ('nosotros', 'Nosotros', 'Somos geniales', 1);
/**
 * ### SECCION
 */
INSERT INTO `seccion` (id_page, nombre, descripcion)
VALUES ( 1, 'Primer Bloque', 'Inicio bienvenida contenido' );
/**
 * ### DETALLE
 */
INSERT INTO `detalle` (id_bloque, id_seccion, n_orden, id_detalle, grupo)
VALUES (1, 1, 1, NULL, 1), (2, 1, 1, 1, 1), (3, 1, 1, 1, 1), (4, 1, 1, 3, 1), (2, 1, 2, 1, 2), (2, 1, 3, 1, 3), (4, 1, 2, 3, 2), (2, 1, 4, 1,4);

/**
 * ### DETALLE_TEXO
 */
INSERT INTO `detalle_texto` (id_detalle, contenido, linea)
VALUES (2, 'TEXTO1', 1), (2, 'TEXTO2', 2), (2, 'TEXTO3', 3), (3, 'TEXTO4', 2), (4, 'TEXTO5', 1), (4, 'TEXTO6', 2), (5, 'TEXTO7', 1), (5, 'TEXTO8', 2), (5, 'TEXTO9', 3), (6, 'TEXTO10', 1), (6, 'TEXTO11', 2), (6, 'TEXTO12', 3), (7, 'TEXTO13', 1), (7, 'TEXTO14', 2), (8, 'TEXTO15', 1), (8, 'TEXTO16', 2), (8, 'TEXTO17', 3);
/**
 * ### PERSONA
 */
INSERT INTO `persona` (name, surname, email, telephone, gender, state )
VALUES ('Eliud', 'Pedraza Churata', 'eliud16pc@hotmail.com', '925940807', 1, 1);
/**
 * ### USUARIO
 */
INSERT INTO `usuario` (id_persona, user, password, id_grupo, state)
VALUES (1, 'admin', '$2a$12$dByMLhnvPEi7UtUDE6msOePDoRYWeMQVK0olY.HZB67Ed5eEWXnGK', 1, 1);
/**
 *
 */

DROP PROCEDURE IF EXISTS `temp`;
DELIMITER $$
CREATE PROCEDURE `temp` (
    IN _id_seccion int,
    INOUT rtn_html TEXT(20000)
)
BEGIN
    DECLARE finished int DEFAULT 0;
    DECLARE respuesta_html TEXT(20000);
    DECLARE cod_id int DEFAULT 0;
    DECLARE cod_id_bloque int DEFAULT 0;
    DECLARE cod_id_detalle int DEFAULT 0;
    DECLARE cod_html varchar(500);
    DECLARE cod_contador int DEFAULT 0;
    /** consulta select para crear el cursor */
    DECLARE cursor_detalle CURSOR FOR
    SELECT D.id, D.id_bloque, D.id_detalle, IFNULL( CH.html, ( SELECT contenido FROM detalle_texto WHERE id_detalle = D.id AND Linea = CE.linea)) html, CE.contenedor
    FROM detalle D
        INNER JOIN bloque B ON D.id_bloque = B.id
        INNER JOIN contenido_html CH ON B.id = CH.id_bloque
        LEFT JOIN contenido_editable CE ON CH.id = CE.id_contenido_html
    WHERE id_seccion = 1
        AND id_detalle IS NULL;
    DECLARE CONTINUE HANDLER FOR NOT FOUND
        SET finished = 1;
    /** eliminamos si existe la vista */
    PREPARE Dstmt FROM 'DROP VIEW IF EXISTS html_temp';
    EXECUTE Dstmt;
    DEALLOCATE PREPARE Dstmt;
    /** preparamos la consulta para crear una vista temporal */
    PREPARE cstmt FROM 'CREATE VIEW html_temp AS
        SELECT D.id, D.id_detalle, IFNULL(CH.html, (SELECT contenido FROM detalle_texto WHERE id_detalle = D.id AND Linea = CE.linea)) html, CE.contenedor
        FROM detalle D inner JOIN bloque B ON D.id_bloque = B.id
        INNER JOIN contenido_html CH ON B.id = CH.id_bloque
        LEFT JOIN contenido_editable CE ON CH.id = CE.id_contenido_html
        LEFT JOIN tipo_editable TE ON TE.id = CE.id_tipo_editable
        ORDER BY D.id, CH.id';
    EXECUTE cstmt;
    DEALLOCATE PREPARE cstmt;
    /** aperturamos el cursor */
    OPEN cursor_detalle;
    cursor_detalle_loop: LOOP
        FETCH cursor_detalle INTO cod_id, cod_id_bloque, cod_id_detalle, cod_html, cod_contador;
        IF finished = 1 THEN
            LEAVE cursor_detalle_loop;
        END IF;
        /* PENSAR */
        IF cod_contador = 1 THEN
            SET @@GLOBAL.max_sp_recursion_depth = 255;
            SET @@session.max_sp_recursion_depth = 255;
            CALL `temp_2` (cod_id, respuesta_html);
            SET rtn_html = CONCAT(rtn_html, respuesta_html);
            -- SET respuesta_html = "";
        ELSE
            SET rtn_html = CONCAT(rtn_html, cod_html);
        END IF;
        SELECT rtn_html;
    END LOOP;
    CLOSE cursor_detalle;
    -- select * FROM html_temp WHERE id_detalle IS NULL;
    PREPARE Vstmt FROM 'DROP VIEW html_temp';
    EXECUTE Vstmt;
    DEALLOCATE PREPARE Vstmt;
END $$
DELIMITER ;
/**
 *
 */
DROP PROCEDURE IF EXISTS `temp_2`;
DELIMITER $$
CREATE PROCEDURE `temp_2` (
    IN _id_detalle int,
    INOUT rtn_html TEXT(20000)
)
BEGIN
    DECLARE finished int DEFAULT 0;
    DECLARE respuesta_html TEXT(20000);
    DECLARE ct_id int;
    DECLARE ct_id_detalle int;
    DECLARE ct_html varchar(500);
    DECLARE ct_contenedor int;
    DECLARE ct_rtn TEXT(20000);
        /** consulta select para crear el cursor */
    DECLARE cursor_temp CURSOR FOR
        SELECT id, id_detalle, html, contenedor
        FROM html_temp
        WHERE id_detalle = _id_detalle;
    DECLARE CONTINUE HANDLER FOR NOT FOUND
        SET finished = 1;
    /** aperturamos el cursor */
    OPEN cursor_temp;
    cursor_temp_loop: LOOP
        FETCH cursor_temp INTO ct_id, ct_id_detalle, ct_html, ct_contenedor;
        IF finished = 1 THEN
            LEAVE cursor_temp_loop;
        END IF;
        IF ct_contenedor = 1 THEN
            CALL `temp_2` (ct_id, respuesta_html);
            SET rtn_html = CONCAT(rtn_html, respuesta_html);
            -- SET respuesta_html = "";
        ELSE
            SET rtn_html = CONCAT(rtn_html, ct_html);
        END IF;
    END LOOP;
    CLOSE cursor_temp;
END $$
DELIMITER ;
/**
 *
 */
SET @html_temp = "=>";
CALL `temp` (1, @html_temp);
SELECT @html_temp;