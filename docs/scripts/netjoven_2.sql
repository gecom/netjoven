
CREATE  PROCEDURE addPostSearch(p_year INT)
BEGIN

REPLACE INTO njv_search(id, category, tag, title, summary, content, created_at)
SELECT p.id, c.name as categoria,GROUP_CONCAT(t.tag) as tags, p.title, p.summary, p.content, p.created_at FROM njv_post p
INNER JOIN njv_post_tag pt ON p.id = pt.post_id
INNER JOIN njv_tag t ON t.id = pt.tag_id
INNER JOIN njv_category c ON c.id =  p.category_id
-- WHERE p.updated_at >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
WHERE YEAR(p.created_at) = p_year
GROUP BY p.id;

END;

CREATE  PROCEDURE explode( pDelim VARCHAR(32), pStr TEXT)
BEGIN
  DROP TABLE IF EXISTS temp_explode;
  CREATE TEMPORARY TABLE temp_explode (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, word VARCHAR(40));
  SET @sql := CONCAT('INSERT INTO temp_explode (word) VALUES (', REPLACE(QUOTE(pStr), pDelim, '\'), (\''), ')');
  PREPARE myStmt FROM @sql;
  EXECUTE myStmt;
END;

CREATE  PROCEDURE migrateUser()
BEGIN
	DECLARE done INT DEFAULT 0;
	DECLARE a INT;
	DECLARE cr_user CURSOR FOR select id from users;
  DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;

  OPEN cr_user;

  REPEAT
    FETCH cr_user INTO a;
		INSERT INTO njv_user (id, user, password, status, level, email, email_register, user_social, created_at) SELECT id, usuario, passwd, IF(level = 'desahabilitado','ina','act') ,IF(level = 'desahabilitado' , 'usuario', level), email, email_register,usuariosocial, NOW() from users WHERE id = a;
		INSERT INTO njv_user_profile (user_id, first_name, last_name, gender, image ,phone, acerca, web, twitter, youtube, birthday, created_at) SELECT a, nombres, apellidos, IF(u.sexo = 'hombre', 'M', 'F') as gender, u.foto, telefono, acerca, web, twitter, youtube, nacimiento, NOW() FROM usersdescription d INNER JOIN users u ON d.idUsuario = u.id WHERE u.id = a;
  UNTIL done END REPEAT;

  CLOSE cr_user;
END;

CREATE  PROCEDURE migrate_slug_news(type_news varchar(50), p_year INT)
BEGIN
	DECLARE done INT DEFAULT 0;
	DECLARE a TEXT;
	DECLARE cr_news CURSOR FOR SELECT id FROM njv_post WHERE type = type_news AND YEAR(created_at) = p_year;
	DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;

	OPEN cr_news;

  REPEAT
    FETCH cr_news INTO a;

		UPDATE njv_post SET slug = slugify(title) WHERE id = a;
  UNTIL done END REPEAT;

  CLOSE cr_news;
END;

CREATE  PROCEDURE migrate_slug_news_by_type(type_news varchar(50))
BEGIN
	DECLARE done INT DEFAULT 0;
	DECLARE a TEXT;
	DECLARE cr_news CURSOR FOR SELECT id FROM njv_post WHERE type = type_news;
	DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;

	OPEN cr_news;

  REPEAT
    FETCH cr_news INTO a;

		UPDATE njv_post SET slug = slugify(title) WHERE id = a;
  UNTIL done END REPEAT;

  CLOSE cr_news;

END;

CREATE  PROCEDURE migrate_tags_by_type(p_type varchar(60))
BEGIN
	DECLARE done INT DEFAULT 0;
	DECLARE a TEXT;
	DECLARE cr_tags CURSOR FOR SELECT tags_old from njv_post WHERE type  = p_type AND tags_old <> '';
	DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;

	OPEN cr_tags;

  REPEAT
    FETCH cr_tags INTO a;

		CALL explode(',',a);

		REPLACE INTO njv_tag (tag, slug) SELECT word, slugify(word) FROM temp_explode;
  UNTIL done END REPEAT;

  CLOSE cr_tags;

END;

CREATE  PROCEDURE migrate_tags_news(p_year int(4))
BEGIN
 	DECLARE done INT DEFAULT 0;
	DECLARE a INT;
	DECLARE b TEXT;
	DECLARE cr_tags_news CURSOR FOR select id, tags_old from njv_post WHERE YEAR(created_at) = p_year  AND tags_old <> '';
	DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;

	OPEN cr_tags_news;
		REPEAT
			FETCH cr_tags_news INTO a, b;
			CALL explode(',',b);

			INSERT INTO njv_post_tag (post_id, tag_id) SELECT a, id FROM njv_tag WHERE slug in (SELECT slugify(word) FROM temp_explode);
		UNTIL done END REPEAT;

  CLOSE cr_tags_news;

END;

CREATE  PROCEDURE migrate_tags_publish(p_year int(4))
BEGIN
 	DECLARE done INT DEFAULT 0;
	DECLARE a TEXT;
	DECLARE cr_tags CURSOR FOR SELECT tags FROM news_publish WHERE tags <> '' AND YEAR(datepost) = p_year;
	DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;

	OPEN cr_tags;
		REPEAT
			FETCH cr_tags INTO a;
			CALL explode(',',a);

			REPLACE INTO njv_tag (tag, slug) SELECT word, slugify(word) FROM temp_explode;
		UNTIL done END REPEAT;
  CLOSE cr_tags;

END;

--
-- Funciones
--
CREATE  FUNCTION fn_remove_accents( textvalue varchar(20000) ) RETURNS varchar(20000)
begin

set @textvalue = textvalue;

-- ACCENTS
set @withaccents = 'ŠšŽžÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÑÒÓÔÕÖØÙÚÛÜÝŸÞàáâãäåæçèéêëìíîïñòóôõöøùúûüýÿþƒ';
set @withoutaccents = 'SsZzAAAAAAACEEEEIIIINOOOOOOUUUUYYBaaaaaaaceeeeiiiinoooooouuuuyybf';
set @count = length(@withaccents);

while @count > 0 do
    set @textvalue = replace(@textvalue, substring(@withaccents, @count, 1), substring(@withoutaccents, @count, 1));
    set @count = @count - 1;
end while;

-- SPECIAL CHARS
set @special = '!@#$%¨&*()_+=§¹²³£¢¬"´{[^~}]<,>.:;?/°ºª+*|\\''';
set @count = length(@special);
while @count > 0 do
    set @textvalue = replace(@textvalue, substring(@special, @count, 1), '');
    set @count = @count - 1;
end while;

return @textvalue;

end;

CREATE  FUNCTION slugify(dirty_string varchar(200)) RETURNS varchar(200)
BEGIN
    DECLARE x, y , z Int;
    Declare temp_string, allowed_chars, new_string VarChar(200);
    Declare is_allowed Bool;
    Declare c, check_char VarChar(1);

    set allowed_chars = "abcdefghijklmnopqrstuvwxyz0123456789-";
    set temp_string = fn_remove_accents(LOWER(dirty_string));

    Select temp_string Regexp('&') Into x;
    If x = 1 Then
        Set temp_string = replace(temp_string, '&', ' and ');
    End If;

    Select temp_string Regexp('[^a-z0-9]+') into x;
    If x = 1 then
        set z = 1;
        While z <= Char_length(temp_string) Do
            Set c = Substring(temp_string, z, 1);
            Set is_allowed = False;
            Set y = 1;
            Inner_Check: While y <= Char_length(allowed_chars) Do
                If (strCmp(ascii(Substring(allowed_chars,y,1)), Ascii(c)) = 0) Then
                    Set is_allowed = True;
                    Leave Inner_Check;
                End If;
                Set y = y + 1;
            End While;
            If is_allowed = False Then
                Set temp_string = Replace(temp_string, c, '-');
            End If;

            set z = z + 1;
        End While;
    End If;

    Select temp_string Regexp("^-|-$|'") into x;
    If x = 1 Then
        Set temp_string = Replace(temp_string, "'", '');
        Set z = Char_length(temp_string);
        Set y = Char_length(temp_string);
        Dash_check: While z > 1 Do
            If Strcmp(SubString(temp_string, -1, 1), '-') = 0 Then
                Set temp_string = Substring(temp_string,1, y-1);
                Set y = y - 1;
            Else
                Leave Dash_check;
            End If;
            Set z = z - 1;
        End While;
    End If;

    Repeat
        Select temp_string Regexp("--") into x;
        If x = 1 Then
            Set temp_string = Replace(temp_string, "--", "-");
        End If;
    Until x <> 1 End Repeat;

    If LOCATE('-', temp_string) = 1 Then
        Set temp_string = SUBSTRING(temp_string, 2);
    End If;

    Return temp_string;
END;

