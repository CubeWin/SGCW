USE sgcw;

CREATE TABLE `prb_contenido` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_detalle` int NOT NULL,
    `html` varchar(500),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `prb_texto` (
    `id` int NOT NULL AUTO_INCREMENT,
    `texto` varchar(500),
    `linea` int NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `prb_detalle` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nombre` varchar(100) NOT NULL,
    `id_detalle` int,
    `id_texto` int,
    `total_texto` int,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DELIMITER $$
CREATE DEFINER=`myRoot`@`%` PROCEDURE `replace_text`(
    IN _id int,
    IN _id_texto int,
    IN _total_texto,
    INOUT return_html varchar(10000)
)
BEGIN
    DECLARE contador int DEFAULT 1;
    DECLARE respuesta_html varchar(10000) DEFAULT "";
    DECLARE finished int DEFAULT 0;
    DECLARE content varchar(500) DEFAULT "";

    DECLARE cursor_html
        CURSOR FOR
            SELECT  html FROM prb_contenido WHERE id_detalle = _id;
    DECLARE CONTINUE HANDLER
        FOR NOT FOUNT SET finished = 1;

    OPEN cursor_html;
        get_cursor_html: LOOP
            FETCH cursor_html INTO html;
                IF finished = 1 THEN
                    LEAVE get_cursor_html;
                END IF;
                IF html = NULL THEN
                    SELECT texto INTO content FROM prb_texto WHERE id_detalle = _id AND linea = contador;
                    SET respuesta_html = CONCAT(respuesta_html, content);
                    SET content = "";
                    SET contador = contador + 1;
                ELSE
                    SET respuesta_html = CONCAT(respuesta_html, html);
        END LOOP get_cursor_html;
    CLOSE cursor_html;

    --SELECT respuesta_html as codigo;
    SET return_html = respuesta_html;
END $$
DELIMITER;

DELIMITER $$
CREATE DELIMITER=`myRoot`@`%` PROCEDURE`bloque`(
    IN _id int
)
BEGIN
    DECLARE b_id int DEFAULT NULL;
    DECLARE b_id_detalle int DEFAULT NULL;
    DECLARE b_id_texto int DEFAULT NULL;
    DECLARE b_total_texto int DEFAULT NULL;
    DECLARE b_html varchar(10000) DEFAULT "";

    SELECT id, id_detalle, id_texto, total_texto INTO b_id, b_id_detalle, b_id_texto, b_total_texto FROM prb_detalle WHERE id = _id;

    IF b_id_detalle = NULL THEN
        EXEC PROCEDURE (b_id, b_id_texto, b_total_texto, b_html);
    ELSE

    END IF;
END $$
DELIMITER;

CREATE TABLE `prb_temporal` (
    `id` int NOT NULL AUTO_INCREMENT,
    `id_sub` int NOT NULL,
    `html` varchar(500),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;