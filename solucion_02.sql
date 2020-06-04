USE `solucion`;
/**
 *
 */
DROP TABLE IF EXISTS `bloque`;
CREATE TABLE `bloque`(
    `id` int NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100) NOT NULL,
    `total` int NOT NULL,
    `iterable` int,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;
/**
 *
 */
DROP TABLE IF EXISTS `contenido_html`;
CREATE TABLE `contenido_html` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_bloque` int NOT NULL,
    `html` varchar(500),
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_id_bloque` FOREIGN KEY (`id_bloque`) REFERENCES `bloque` (`id`) ON DELETE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;
DROP TABLE IF EXISTS `tipo_editable`;
/**
 *
 */
CREATE TABLE `tipo_editable` (
    `id` int NOT NULL AUTO_INCREMENT,
    `contenido` varchar(200) NOT NULL,
    `descripcion` varchar(200),
    PRIMARY KEY(`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;
/**
 *
 */
DROP TABLE IF EXISTS `contenido_editable`;
CREATE TABLE `contenido_editable` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_contenido_html` int NOT NULL,
    `id_tipo_editable` int NOT NULL,
    `contenedor` int NOT NULL,
    `linea` int NOT NULL,
    `descripcion` int NOT NULL,
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_id_contenido_html` FOREIGN KEY (`id_contenido_html`) REFERENCES `contenido_html` (`id`) ON DELETE RESTRICT,
    CONSTRAINT `fk_id_tipo_editable` FOREIGN KEY (`id_tipo_editable`) REFERENCES `tipo_editable` (`id`) ON DELETE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;
/**
 *
 */
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100),
    `titulo` varchar(100),
    `descripcion` varchar(500),
    `estado` int NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;
/**
 *
 */
DROP TABLE IF EXISTS `seccion`;
CREATE TABLE `seccion` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_page` int NOT NULL,
    `nombre` varchar(100) NOT NULL,
    `descripcion` varchar(500) NOT NULL,
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_id_page` FOREIGN KEY (`id_page`) REFERENCES `page` (`id`) ON DELETE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;
/**
 *
 */
DROP TABLE IF EXISTS `detalle`;
CREATE TABLE `detalle` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_bloque` int NOT NULL,
    `id_seccion` int NOT NULL,
    `n_orden` int NOT NULL,
    `id_detalle` int,
    PRIMARY KEY(`id`),
    CONSTRAINT `dfk_id_bloque` FOREIGN KEY (`id_bloque`) REFERENCES `bloque` (`id`) ON DELETE RESTRICT,
    CONSTRAINT `dfk_id_detalle` FOREIGN KEY (`id_detalle`) REFERENCES `detalle` (`id`) ON DELETE RESTRICT,
    CONSTRAINT `dfk_id_seccion` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id`) ON DELETE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;
/**
 *
 */
DROP TABLE IF EXISTS `detalle_texto`;
CREATE TABLE `detalle_texto` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_detalle` int NOT NULL,
    `contenido` varchar(500),
    `linea` int NOT NULL,
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_id_detalle` FOREIGN KEY (`id_detalle`) REFERENCES `detalle` (`id`) ON DELETE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;
/**
*
*/
INSERT INTO `bloque` (nombre, total, iterable)
VALUES ('slib', 1, 0),
    ('content', 3, 1),
    ('content2', 2, 0),
    ('subcontent', 2, 1);
/**
 *
 */
INSERT INTO `contenido_html` (id_bloque, html)
VALUES (1, '<div>'),
    (1, NULL),
    (1, '</div>'),
    (2, '<div>'),
    (2, '<h1>'),
    (2, NULL),
    (2, '</h1>'),
    (2, '<p>'),
    (2, NULL),
    (2, '</p>'),
    (2, '<p>'),
    (2, NULL),
    (2, '</p>'),
    (2, '</div>'),
    (3, '<div>'),
    (3, '<ul>'),
    (3, NULL),
    (3, '</ul>'),
    (3, '<p>'),
    (3, NULL),
    (3, '</p>'),
    (3, '</div>'),
    (4, '<li>'),
    (4, '<p>'),
    (4, NULL),
    (4, '</p>'),
    (4, '<i>'),
    (4, NULL),
    (4, '</i>'),
    (4, '</li>');
/**
 *
 */
INSERT INTO `tipo_editable` (contenido, descripcion)
VALUES ('texto', 'Texto plano'),
    ('imagen', 'Buscar en el gestor de imagenes');
/**
 *
 */
INSERT INTO `contenido_editable` (
        id_contenido_html,
        id_tipo_editable,
        contenedor,
        linea,
        descripcion
    )
VALUES (2, 2, 1, 1, ""),
    (6, 1, 0, 1, ""),
    (9, 1, 0, 2, ""),
    (12, 1, 0, 1, ""),
    (17, 2, 1, 1, ""),
    (20, 1, 0, 1, ""),
    (25, 1, 0, 1, ""),
    (28, 1, 0, 1, "");
/**
 *
 */
INSERT INTO `page` (nombre, titulo, descripcion, estado)
VALUES ('inicio', 'Bienvenido', 'Pagína de inicio', 1),
    ('nosotros', 'Nosotros', 'Somos geniales', 1);
/**
 *
 */
INSERT INTO `seccion` (id_page, nombre, descripcion)
VALUES (
        1,
        'Primer Bloque',
        'Inicio bienvenida contenido'
    );
/**
 *
 */
INSERT INTO `detalle` (id_bloque, id_seccion, n_orden, id_detalle)
VALUES (1, 1, 1, NULL),
    (2, 1, 1, 1),
    (3, 1, 1, 1),
    (4, 1, 1, 3),
    (2, 1, 2, 1),
    (2, 1, 3, 1),
    (4, 1, 2, 3),
    (2, 1, 4, 1);
/**
 *
 */
INSERT INTO `detalle_texto` (id_detalle, contenido, linea)
VALUES (2,'TEXTO1',1),
(2,'TEXTO2',2),
(2,'TEXTO3',3),
(3,'TEXTO4',2),
(4,'TEXTO5',1),
(4,'TEXTO6',2),
(5,'TEXTO7',1),
(5,'TEXTO8',2),
(5,'TEXTO9',3),
(6,'TEXTO10',1),
(6,'TEXTO11',2),
(6,'TEXTO12',3),
(7,'TEXTO13',1),
(7,'TEXTO14',2),
(8,'TEXTO15',1),
(8,'TEXTO16',2),
(8,'TEXTO17',3);
/**
 *
 */
DELIMITER $ $ CREATE DEFINER = `myRoot` @`%` PROCEDURE `primero` (
    IN _id int,
    INOUT return_html varchar(20000)
) BEGIN DECLARE finished int DEFAULT 0;
DECLARE respuesta_html varchar(20000);
DECLARE id int;
DECLARE id_bloque int;
DECLARE id_detalle int;
DECLARE cursor_detalle CURSOR FOR
SELECT id,
    id_bloque,
    id_detalle
FROM detalle
WHERE id_seccion = _id
    AND id_detalle = NULL;
DECLARE CONTINUE HANDLER FOR NOT FOUND
SET finished = 1;
OPEN cursor_detalle;
get_cursor_detalle: LOOP FETCH cursor_detalle INTO id,
id_bloque,
id_detalle;
IF finished = 1 THEN LEAVE get_cursor_detalle;
END IF;
IF id_detalle = NULL THEN -- EXECUTE PROCEDURE id_bloque
CALL segundo (id_bloque, id_detalle, _id, respuesta_html);
SET return_html = CONCAT(return_html, respuesta_html);
SET respuesta_html = "";
END IF;
END LOOP get_cursor_detalle;
CLOSE cursor_detalle;
END $ $ DELIMITER;
/**
 *
 */
DELIMITER $ $ CREATE DEFINER = `myRoot` @`%` PROCEDURE `segundo` (
    IN _id_bloque int,
    IN _id_detalle int,
    IN _id_seccion int,
    INOUT return_html varchar(20000)
) BEGIN DECLARE finished int DEFAULT 0;
DECLARE respuesta_html varchar(20000);
DECLARE html varchar(1000);
DECLARE contenedor int;
DECLARE linea int;
DECLARE contenido varchar(100);
DECLARE d_texto varchar(500);
DECLARE cursor_bloque CURSOR FOR
SELECT CH.html,
    CE.contenedor,
    CE.linea,
    TE.contenido
FROM bloque B
    INNER JOIN contenido_html CH ON B.id = CH.id_bloque
    LEFT JOIN contenido_editable CE ON CH.id = CE.id_contenido_html
    LEFT JOIN tipo_editable TE ON TE.id = CE.id_tipo_editable
WHERE B.id = _id_bloque
ORDER BY CH.id;
DECLARE CONTINUE HANDLER FOR NOT FOUND
SET finished = 1;
OPEN cursor_bloque;
get_cursor_bloque: LOOP FETCH cursor_bloque INTO html,
contenedor,
linea,
contenido;
IF finished = 1 THEN LEAVE get_cursor_bloque;
END IF;
IF contenedor = 1 THEN -- execute procedure 3
CALL tercero (id_detalle, _id, respuesta_html);
SET return_html = CONCAT(return_html, respuesta_html);
SET respuesta_html = "";
ELSEIF html = NULL
AND contenedor = 0 THEN
SELECT contenido INTO d_texto
FROM detalle_texto
WHERE id_detalle = _id_detalle
    AND linea = linea;
SET return_html = CONCAT(return_html, d_texto);
ELSE
SET return_html = CONCAT(return_html, html);
END IF;
END LOOP get_cursor_bloque;
CLOSE cursor_bloque;
END $ $ DELIMITER;
/**
 *
 */
DELIMITER $ $ CREATE DEFINER = `myRoot` @`%` PROCEDURE `tercero` (
    IN _id_detalle int,
    IN _id_seccion int,
    INOUT return_html varchar(20000)
) BEGIN DECLARE finished int DEFAULT 0;
DECLARE respuesta_html varchar(20000);
DECLARE id int;
DECLARE id_bloque int;
DECLARE cursor_contenedor CURSOR FOR
SELECT id,
    id_bloque
FROM detalle
WHERE id_detalle = _id_detalle
    AND id_seccion = _id_seccion;
DECLARE CONTINUE HANDLER FOR NOT FOUND
SET finished = 1;
OPEN cursor_contenedor;
get_cursor_contenedor: LOOP FETCH cursor_contenedor INTO id,
id_bloque;
IF finished = 1 THEN LEAVE get_cursor_contenedor;
END IF;
-- execute procedure 2 (id_bloque, id, _id_seccion)
CALL segundo (id_bloque, id, _id_seccion, respuesta_html);
SET return_html = CONCAT(return_html, respuesta_html);
SET respuesta_html = "";
END LOOP get_cursor_contenedor;
CLOSE cursor_contenedor;
END $ $ DELIMITER;
-- SELECT B.id, B.total, B.iterable, CH.id, CH.html, CE.id, CE.contenedor, CE.linea, TE.id, TE.contenido
SELECT *
FROM bloque B
    INNER JOIN contenido_html CH ON B.id = CH.id_bloque
    LEFT JOIN contenido_editable CE ON CH.id = CE.id_contenido_html
    LEFT JOIN tipo_editable TE ON TE.id = CE.id_tipo_editable
WHERE B.id = 3
ORDER BY CH.id;
SELECT *
FROM detalle D
    INNER JOIN detalle_texto DT ON D.id = DT.id_detalle
    INNER JOIN bloque ON D.id = B.id_detalle
    INNER JOIN contenido_html CH ON B.id = CH.id_bloque
    LEFT JOIN contenido_editable CE ON CH.id = CE.id_contenido_html
    LEFT JOIN tipo_editable TE ON TE.id = CE.id_tipo_editable
WHERE D.id = 1
ORDER BY CH.id;
/**
 *
 * MUESTRA
 *
 */
DROP FUNCTION IF EXISTS EE_FIELD_NAME;
CREATE FUNCTION EE_FIELD_NAME (id INT) RETURNS VARCHAR(32) NOT DETERMINISTIC RETURN (
    SELECT field_name
    FROM exp_channel_fields
    WHERE field_id = id
);
/**
 *
 */
DROP PROCEDURE IF EXISTS CREATE_CHANNEL_VIEW;
DELIMITER $ $ CREATE PROCEDURE CREATE_CHANNEL_VIEW (IN channame VARCHAR(40)) BEGIN DECLARE done INT DEFAULT 0;
DECLARE f INT;
DECLARE fcur CURSOR FOR
SELECT field_id
FROM exp_channel_fields f
    INNER JOIN exp_channels c ON c.field_group = f.group_id
WHERE channel_name = channame;
DECLARE CONTINUE HANDLER FOR NOT FOUND
SET done = 1;
SET @field_names = '';
OPEN fcur;
field_loop: LOOP FETCH fcur INTO f;
IF done = 1 THEN LEAVE field_loop;
END IF;
SET @field_names = CONCAT(
        @field_names,
        '`field_id_',
        f,
        '` AS `',
        EE_FIELD_NAME(f),
        '`, '
    );
END LOOP;
CLOSE fcur;
SET @field_names = SUBSTRING(@field_names, 1, CHAR_LENGTH(@field_names) - 2);
SET @dv = CONCAT('DROP VIEW IF EXISTS cv_', channame);
PREPARE dstmt
FROM @dv;
EXECUTE dstmt;
DEALLOCATE PREPARE dtmt;
SET @cv = CONCAT(
        'CREATE VIEW staging.cv_',
        channame,
        ' AS SELECT entry_id, author_id, title, url_title, status, versioning_enabled, view_count_one, view_count_two, view_count_three, view_count_four, allow_comments, sticky, entry_date, year, month, day, expiration_date, comment_expiration_date, edit_date, recent_comment_date, comment_total, ',
        @field_names,
        " FROM staging.channel_entries e NATURAL JOIN staging.exp_channels c WHERE c.channel_name='",
        channame,
        "'"
    );
PREPARE cstmt
FROM @cv;
EXECUTE cstmt;
DEALLOCATE PREPARE stmt;
END $ $ DELIMITER;



/**
 *
 */
/** INICIANDO */
DROP PROCEDURE IF EXISTS `temp`;
DELIMITER $$ CREATE PROCEDURE `temp` () BEGIN PREPARE Dstmt
FROM 'DROP VIEW IF EXISTS html_temp';
EXECUTE Dstmt;
DEALLOCATE PREPARE Dstmt;
PREPARE cstmt
FROM 'CREATE VIEW html_temp AS
        SELECT D.id, D.id_detalle, CE.contenedor, IFNULL(CH.html,
        (SELECT contenido FROM detalle_texto WHERE id_detalle = D.id AND Linea = CE.linea)) html
		FROM detalle D inner JOIN bloque B ON D.id_bloque = B.id
		INNER JOIN contenido_html CH ON B.id = CH.id_bloque
		LEFT JOIN contenido_editable CE ON CH.id = CE.id_contenido_html
		LEFT JOIN tipo_editable TE ON TE.id = CE.id_tipo_editable
		WHERE D.id = 1 ORDER BY CH.id';
EXECUTE cstmt;
DEALLOCATE PREPARE cstmt;
SELECT *
FROM html_temp
WHERE id_detalle IS NULL;
PREPARE Vstmt
FROM 'DROP VIEW html_temp';
EXECUTE Vstmt;
DEALLOCATE PREPARE Vstmt;
END $$ DELIMITER;

CALL temp;

DROP PROCEDURE IF EXISTS `temp`;
DELIMITER $$ CREATE PROCEDURE `temp` (
    IN _id_seccion int,
    INOUT rtn_html varchar(20000)
) BEGIN DECLARE finished int DEFAULT 0;
DECLARE respuesta_html varchar(20000);
DECLARE cod_id int DEFAULT 0;
DECLARE cod_id_bloque int DEFAULT 0;
DECLARE cod_id_detalle int DEFAULT 0;
DECLARE cod_html varchar(500);
DECLARE cod_contador int DEFAULT 0;
DECLARE cursor_detalle CURSOR FOR
SELECT D.id,
    D.id_bloque,
    D.id_detalle,
    IFNULL(
        CH.html,
        (
            SELECT contenido
            FROM detalle_texto
            WHERE id_detalle = D.id
                AND Linea = CE.linea
        )
    ) html,
    CE.contenedor
FROM detalle D
    inner JOIN bloque B ON D.id_bloque = B.id
    INNER JOIN contenido_html CH ON B.id = CH.id_bloque
    LEFT JOIN contenido_editable CE ON CH.id = CE.id_contenido_html
WHERE id_seccion = 1
    AND id_detalle IS NULL;
DECLARE CONTINUE HANDLER FOR NOT FOUND
SET finished = 1;
PREPARE Dstmt
FROM 'DROP VIEW IF EXISTS html_temp';
EXECUTE Dstmt;
DEALLOCATE PREPARE Dstmt;
PREPARE cstmt
FROM 'CREATE VIEW html_temp AS
        SELECT D.id, D.id_detalle, IFNULL(CH.html, (SELECT contenido FROM detalle_texto WHERE id_detalle = D.id AND Linea = CE.linea)) html, CE.contenedor
		FROM detalle D inner JOIN bloque B ON D.id_bloque = B.id
		INNER JOIN contenido_html CH ON B.id = CH.id_bloque
		LEFT JOIN contenido_editable CE ON CH.id = CE.id_contenido_html
		LEFT JOIN tipo_editable TE ON TE.id = CE.id_tipo_editable
		ORDER BY D.id, CH.id';
EXECUTE cstmt;
DEALLOCATE PREPARE cstmt;
OPEN cursor_detalle;
cursor_detalle_loop: LOOP FETCH cursor_detalle INTO cod_id,
cod_id_bloque,
cod_id_detalle,
cod_html,
cod_contador;
IF finished = 1 THEN LEAVE cursor_detalle_loop;
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
PREPARE Vstmt
FROM 'DROP VIEW html_temp';
EXECUTE Vstmt;
DEALLOCATE PREPARE Vstmt;
END $$ DELIMITER;



/**
 *
 */
DROP PROCEDURE IF EXISTS `temp_2`;
DELIMITER $$ CREATE PROCEDURE `temp_2` (
    IN _id_detalle int,
    INOUT rtn_html varchar(20000)
) BEGIN DECLARE finished int DEFAULT 0;
DECLARE respuesta_html varchar(20000);
DECLARE ct_id int;
DECLARE ct_id_detalle int;
DECLARE ct_html varchar(500);
DECLARE ct_contenedor int;
DECLARE ct_rtn varchar(20000);
DECLARE cursor_temp CURSOR FOR
SELECT id,
    id_detalle,
    html,
    contenedor
FROM html_temp
WHERE id_detalle = _id_detalle;
DECLARE CONTINUE HANDLER FOR NOT FOUND
SET finished = 1;
OPEN cursor_temp;
cursor_temp_loop: LOOP FETCH cursor_temp INTO ct_id,
ct_id_detalle,
ct_html,
ct_contenedor;
IF finished = 1 THEN LEAVE cursor_temp_loop;
END IF;
IF ct_contenedor = 1 THEN CALL `temp_2` (ct_id, respuesta_html);
SET rtn_html = CONCAT(rtn_html, respuesta_html);
-- SET respuesta_html = "";
ELSE
SET rtn_html = CONCAT(rtn_html, ct_html);
END IF;
END LOOP;
CLOSE cursor_temp;
END $ $ DELIMITER;
/**
 *
 */
SET @html_temp = "=>";
CALL `temp` (1, @html_temp);
SELECT @html_temp;