INSERT INTO njv_search SELECT * FROM busqueda;
INSERT INTO njv_category (name, description, type)  VALUES ('Ambos', 'Ambos', 'GALLERY'), ('Chicos', 'Chicos', 'GALLERY'), 
('Chicas', 'Chicas', 'GALLERY'),('Netjoven', 'Netjoven', 'GALLERY'),
('Famosos', 'Famosos', 'GALLERY'), ('Famosas', 'Famosas', 'GALLERY');
INSERT INTO njv_category (name, description, type)  VALUES ('Netjoven TV', 'Netjoven TV', 'VIDEO'), ('Recomendados', 'Recomendados', 'VIDEOS');

INSERT INTO njv_category (name, description, type)  VALUES ('Actualidad','Actualidad','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Facebook fail','Facebook fail','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Tu estado','Tu estado','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Tech','tech','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Miscelaneas','miscelaneas','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Elecciones 2011','Elecciones 2011','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Actualidad','Actualidad','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Apps','Apps','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'apps','apps','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('curiosidades','curiosidades','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Curiosidades','Curiosidades','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Deportes','Deportes','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Pichanga','pichanga','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Mundo Futbol','Mundo futbol','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Deporte total','Deporte total','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Descentralizado','Descentralizado','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Arriba Peru','arriba peru','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Deportes Internacionales','Deportes internacionales','NEWS');


INSERT INTO njv_category (name, description, type)  VALUES ('Espectaculos','Espectaculos','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Y tu mundo','y tu mundo','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Cine','Cine','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Televisión','Televisión','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Especiales','Especiales','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Puro peru','puro peru','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Informativas','Informativas','NEWS');


INSERT INTO njv_category (name, description, type)  VALUES ('Horoscopo','Horoscopo','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Horoscopo','Horoscopo','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Horoscopo Noticias','Horoscopo Noticias','NEWS');


INSERT INTO njv_category (name, description, type)  VALUES ('Humor','Humor','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Humor','Humor','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Kpop','Kpop','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'K-pop','K-pop','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Moda','Moda','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Moda','Moda','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Móviles','Móviles','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Móviles','Móviles','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Nutricion','Nutricion','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Nutrición','Nutrición','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Otros deportes','Otros deportes','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Otros deportes','Otros deportes','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Redes Sociales','Redes Sociales','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Redes Sociales','Redes Sociales','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Estilo de vida','Estilo de vida','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Sexo','sexo','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Horoscopo','horoscopo','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Juerga','juerga','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Moda','moda','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Vida Sana','vida sana','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Sexualidad','Sexualidad','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Gamers','Gamers','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Juegos','juegos','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Plataformas','Plataformas','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Trucos','Trucos','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Curiosidades','Curiosidades','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Netjoven tv','Netjoven tv','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Tu estado Paranormal','Tu estado Paranormal','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Somos de Calle','Somos de Calle','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Tv Web','Tv web','NEWS');
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Famosos Con Nosotros','Famosos con nosotros','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Blogs','Blogs','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Blogs','Blogs','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Cartelera','Cartelera','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Cartelera','Cartelera','NEWS');

INSERT INTO njv_category (name, description, type)  VALUES ('Sexualidad','Sexualidad','NEWS');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description, type)  VALUES (@a,'Sexualidad','sexualidad','NEWS');

UPDATE njv_category SET slug = slugify(name) WHERE parent_id IS NULL;
UPDATE njv_category c INNER JOIN  njv_category c1 on c1.id = c.parent_id SET c.slug = slugify(CONCAT(c1.name, ' ', c.name)) where c.parent_id IS NOT NULL;

call migrateUser();

CREATE TABLE tmp_category (category_id_old INT, category_id_new INT);
INSERT INTO tmp_category VALUES(26,14);
INSERT INTO tmp_category VALUES(29,15);
INSERT INTO tmp_category VALUES(39,17);
INSERT INTO tmp_category VALUES(22,25);
INSERT INTO tmp_category VALUES(23,26);
INSERT INTO tmp_category VALUES(4,28);
INSERT INTO tmp_category VALUES(15,29);
INSERT INTO tmp_category VALUES(17,30);
INSERT INTO tmp_category VALUES(20,31);
INSERT INTO tmp_category VALUES(13,32);
INSERT INTO tmp_category VALUES(27,33);
INSERT INTO tmp_category VALUES(30,35);
INSERT INTO tmp_category VALUES(42,36);
INSERT INTO tmp_category VALUES(35,38);
INSERT INTO tmp_category VALUES(31,40);
INSERT INTO tmp_category VALUES(28,42);
INSERT INTO tmp_category VALUES(37,44);
INSERT INTO tmp_category VALUES(32,46);
INSERT INTO tmp_category VALUES(34,48);
INSERT INTO tmp_category VALUES(38,50);
INSERT INTO tmp_category VALUES(33,57);
INSERT INTO tmp_category VALUES(40,59);
INSERT INTO tmp_category VALUES(36,62);

INSERT INTO njv_post  (tags_old, id_old, category_id_old, user_id, category_id, type, title, slug, content, summary, counter,ip,`status`,view_index, post_at, expire_at, display,twitter,america, frecuencia, created_at) SELECT tags, news_id , category_id,NULL,NULL,'NEWS' ,title, title AS slug,content, summary,counter, ip, 'pub', ver_index, datepost,dateexpire,display, twiter, america, frecuencia, datepost FROM news_publish p   WHERE YEAR(datepost) = 2014;
UPDATE njv_post n SET n.category_id = (SELECT category_id_new FROM tmp_category tc WHERE tc.category_id_old = n.category_id_old) WHERE YEAR(created_at) = 2014;

CALL migrate_slug_news('NEWS', 2014);
CALL migrate_tags_publish(2014);

INSERT INTO njv_comment (post_id, user_id, user_name, user_email, comment,vote, status, created_at) SELECT n.id, c.id_usuario, c.nombre, c.email, c.text, c.votos, if(c.estado = 'valido', 'pbl', 'spn'), c.fecha FROM newscoments c INNER JOIN njv_post n on c.news_id = n.id_old WHERE YEAR(n.created_at) = 2014;
INSERT INTO njv_post_multimedia (post_id, image, thumbnail_one, thumbnail_two, is_principal) SELECT n.id, imagen, thumbnail, thumbnail2, 1  FROM news_publish p INNER JOIN njv_post n ON p.news_id = n.id_old WHERE YEAR(n.created_at) = 2014;

INSERT INTO njv_post  (id_old, category_id, type, id_youtube, title, slug, content,counter,status, post_at) SELECT id_video, 7, "VIDEO", v, titulo, titulo,coment,visto, 'pbl', tiempo  FROM videos WHERE categoria = 'video';
INSERT INTO njv_post  (id_old, category_id, type, id_youtube, title, slug, content,counter,status, post_at) SELECT id_video, 8, "VIDEO", v, titulo, titulo,coment,visto, 'pbl', tiempo  FROM videos WHERE categoria = 'recomendados';
CALL migrate_slug_news_by_type('VIDEO');

INSERT INTO njv_comment (post_id, user_id, user_name, user_email, comment,vote, status, created_at) SELECT n.id, c.id_usuario, c.nombre, c.email,c.text, c.votos, if(c.estado = 'valido', 'pbl', 'spm'), c.fecha from coments_videos c INNER JOIN njv_post  n ON c.news_id = n.id_youtube;

INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, post_at)
SELECT id_galeria,1, 'GALLERY', titulo, titulo, descp, sumary, tags, creacion FROM galeria WHERE UPPER(cat) = 'AMBOS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, post_at)
SELECT id_galeria,2, 'GALLERY', titulo, titulo, descp, sumary, tags, creacion FROM galeria WHERE UPPER(cat) = 'CHICOS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, post_at)
SELECT id_galeria,3, 'GALLERY', titulo, titulo, descp, sumary, tags, creacion FROM galeria WHERE UPPER(cat) = 'CHICAS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, post_at)
SELECT id_galeria,4, 'GALLERY', titulo, titulo, descp, sumary, tags, creacion FROM galeria WHERE UPPER(cat) = 'NETJOVEN';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, post_at)
SELECT id_galeria,5, 'GALLERY', titulo, titulo, descp, sumary, tags, creacion FROM galeria WHERE UPPER(cat) = 'FAMOSAS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, post_at)
SELECT id_galeria,6, 'GALLERY', titulo, titulo, descp, sumary, tags, creacion FROM galeria WHERE UPPER(cat) = 'FAMOSOS';
CALL migrate_slug_news_by_type('GALLERY');

CALL migrate_tags_by_type('GALLERY');
INSERT INTO njv_post_multimedia (post_id, title, image, is_gallery) SELECT n.id,titulo, imagen, 1 FROM galeria_foto g INNER JOIN njv_post n ON g.id_galeria = n.id_old;
CALL migrate_tags_news(2014);

