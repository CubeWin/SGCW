DROP PROCEDURE IF EXISTS `temp`;
DELIMITER $$
CREATE PROCEDURE `temp` (
    IN _id_seccion int
)
BEGIN
    DECLARE finished int DEFAULT 0;
    DECLARE rtn_html TEXT DEFAULT "";

    DECLARE html_in_content TEXT DEFAULT "";

    DECLARE cod_id int DEFAULT 0;
    DECLARE cod_id_bloque int DEFAULT 0;
    DECLARE cod_id_detalle int DEFAULT 0;
    DECLARE cod_html TEXT;
    DECLARE cod_contenedor int DEFAULT 0;

    /** consulta select para crear el cursor */
    DECLARE cursor_detalle CURSOR FOR
    SELECT D.id, D.id_bloque, IFNULL(D.id_detalle, 0) id_detalle, IFNULL(IFNULL( CH.html, ( SELECT contenido FROM detalle_texto WHERE id_detalle = D.id AND Linea = CE.linea)), "") html, IFNULL(CE.contenedor, 0) contenedor
    FROM detalle D
        INNER JOIN bloque B ON D.id_bloque = B.id
        INNER JOIN contenido_html CH ON B.id = CH.id_bloque
        LEFT JOIN contenido_editable CE ON CH.id = CE.id_contenido_html
    WHERE id_seccion = _id_seccion
        AND id_detalle IS NULL;
    DECLARE CONTINUE HANDLER FOR NOT FOUND
        SET finished = 1;

    /** eliminamos si existe la vista */
    PREPARE Dstmt FROM 'DROP VIEW IF EXISTS html_temp';
    EXECUTE Dstmt;
    DEALLOCATE PREPARE Dstmt;

    /** preparamos la consulta para crear una vista temporal */
    PREPARE cstmt FROM 'CREATE VIEW html_temp AS
        SELECT D.id, D.id_detalle, IFNULL(IFNULL(CH.html, (SELECT contenido FROM detalle_texto WHERE id_detalle = D.id AND Linea = CE.linea)), "") html, CE.contenedor
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
        FETCH cursor_detalle INTO cod_id, cod_id_bloque, cod_id_detalle, cod_html, cod_contenedor;

        IF finished = 1 THEN
            LEAVE cursor_detalle_loop;
        END IF;
        /* PENSAR */
        IF cod_contenedor = 1 THEN
            SET @@GLOBAL.max_sp_recursion_depth = 255;
            SET @@session.max_sp_recursion_depth = 255;
            CALL `temp_2` (cod_id, html_in_content);
            SET rtn_html = CONCAT(rtn_html, html_in_content);
            -- SET html_in_content = "";
        ELSE
            SET rtn_html = CONCAT(rtn_html, cod_html);
        END IF;

    END LOOP;
    CLOSE cursor_detalle;
    select rtn_html;

    /** eliminar vista */
    PREPARE Vstmt FROM 'DROP VIEW html_temp';
    EXECUTE Vstmt;
    DEALLOCATE PREPARE Vstmt;

END $$
DELIMITER ;

CREATE PROCEDURE `sgcw`.`temp_2`(
    IN _id_detalle int,
    INOUT rtn_html TEXT
)
BEGIN
    DECLARE finished int DEFAULT 0;
    DECLARE respuesta_html TEXT DEFAULT "";

    DECLARE ct_id int DEFAULT 0;
    DECLARE ct_id_detalle int DEFAULT 0;
    DECLARE ct_html TEXT DEFAULT "";
    DECLARE ct_contenedor int DEFAULT 0;

    DECLARE ct_rtn TEXT DEFAULT "";

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
            SET ct_rtn = CONCAT(ct_rtn, respuesta_html);
            SET respuesta_html = "";
            -- SELECT ct_rtn;
        ELSE
            SET ct_rtn = CONCAT(ct_rtn, ct_html);
        END IF;
    END LOOP;

    SET  rtn_html = CONCAT(rtn_html, ct_rtn);
    CLOSE cursor_temp;
END