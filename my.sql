CREATE DEFINER=`myRoot`@`%` PROCEDURE `bloque`(
	_id INT
)
BEGIN
	DECLARE finished INTEGER DEFAULT 0;
	DECLARE vonly_text int;
	DECLARE linex INTEGER DEFAULT 0;
	DECLARE vcontent varchar(500);
    DECLARE text_content varchar(500);
    DECLARE htmlbloque varchar(4000) DEFAULT "";w
    /*** COUNT TEXT CONTENIDO_ESTATICO ***/
	DECLARE count_ce int;
    /*** COUNT TEXT SECCION_CONTENT ***/
	DECLARE count_sc int;
    /*** RELLENO ID ***/
	DECLARE id_rell int;


    DEClARE html
		CURSOR FOR
			SELECT SC.only_text, SC.content FROM seccion S INNER JOIN seccion_content SC ON SC.id_seccion = S.id WHERE S.id = _id;
	DECLARE CONTINUE HANDLER
        FOR NOT FOUND SET finished = 1;
    
    SELECT count(only_Text), id_seccion INTO count_sc, id_rell FROM seccion_content GROUP BY only_Text HAVING only_text = 2 and id_seccion = _id;
    SELECT count(content), id_seccion INTO count_ce, id_rell FROM seccion_content GROUP BY only_Text HAVING only_text = 2 and id_seccion = _id;
    -- SET htmlbloque = CONCAT(htmlbloque,"count_sc : ", count_sc, "; ");
    -- SET htmlbloque = CONCAT(htmlbloque,"count_ce : ", count_ce, "; ");
    
    if count_sc = count_ce then
    
		OPEN html;
		
		gethtml: LOOP
			FETCH html INTO vonly_text, vcontent;
			IF finished = 1 THEN
				LEAVE gethtml;
			END IF;
			
			IF vonly_text = 1 THEN
				SET htmlbloque = CONCAT(htmlbloque, vcontent);
			ELSE
				set linex = linex + 1;
				set text_content = (select content from contenido_estatico where id_seccion = _id and line = linex);
				SET htmlbloque = CONCAT(htmlbloque, text_content);
                
			END IF;
		END LOOP gethtml;
		
		CLOSE html;
    end if;
    SELECT htmlbloque as html;
END

