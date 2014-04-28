
INSERT INTO njv_category (name, description)  VALUES ('Ambos', 'Ambos' ), ('Chicos', 'Chicos'), 
('Chicas', 'Chicas'),('Netjoven', 'Netjoven'),
('Famosos', 'Famosos'), ('Famosas', 'Famosas');
INSERT INTO njv_category (name, description)  VALUES ('Netjoven TV', 'Netjoven TV'), ('Recomendados', 'Recomendados');

INSERT INTO njv_category (name, description)  VALUES ('Actualidad','Actualidad');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Facebook fail','Facebook fail');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Tu estado','Tu estado');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Tech','tech');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Miscelaneas','miscelaneas');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Elecciones 2011','Elecciones 2011');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Actualidad','Actualidad');

INSERT INTO njv_category (name, description)  VALUES ('Apps','Apps');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'apps','apps');

INSERT INTO njv_category (name, description)  VALUES ('curiosidades','curiosidades');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Curiosidades','Curiosidades');

INSERT INTO njv_category (name, description)  VALUES ('Deportes','Deportes');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Pichanga','pichanga');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Mundo Futbol','Mundo futbol');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Deporte total','Deporte total');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Descentralizado','Descentralizado');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Arriba Peru','arriba peru');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Deportes Internacionales','Deportes internacionales');


INSERT INTO njv_category (name, description)  VALUES ('Espectaculos','Espectaculos');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Y tu mundo','y tu mundo');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Cine','Cine');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Televisión','Televisión');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Especiales','Especiales');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Puro peru','puro peru');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Informativas','Informativas');


INSERT INTO njv_category (name, description)  VALUES ('Horoscopo','Horoscopo');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Horoscopo','Horoscopo');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Horoscopo Noticias','Horoscopo Noticias');


INSERT INTO njv_category (name, description)  VALUES ('Humor','Humor');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Humor','Humor');

INSERT INTO njv_category (name, description)  VALUES ('Kpop','Kpop');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'K-pop','K-pop');

INSERT INTO njv_category (name, description)  VALUES ('Moda','Moda');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Moda','Moda');

INSERT INTO njv_category (name, description)  VALUES ('Móviles','Móviles');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Móviles','Móviles');

INSERT INTO njv_category (name, description)  VALUES ('Nutricion','Nutricion');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Nutrición','Nutrición');

INSERT INTO njv_category (name, description)  VALUES ('Otros deportes','Otros deportes');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Otros deportes','Otros deportes');

INSERT INTO njv_category (name, description)  VALUES ('Redes Sociales','Redes Sociales');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Redes Sociales','Redes Sociales');

INSERT INTO njv_category (name, description)  VALUES ('Estilo de vida','Estilo de vida');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Sexo','sexo');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Horoscopo','horoscopo');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Juerga','juerga');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Moda','moda');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Vida Sana','vida sana');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Sexualidad','Sexualidad');

INSERT INTO njv_category (name, description)  VALUES ('Gamers','Gamers');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Juegos','juegos');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Plataformas','Plataformas');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Trucos','Trucos');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Curiosidades','Curiosidades');

INSERT INTO njv_category (name, description)  VALUES ('Netjoven tv','Netjoven tv');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Tu estado Paranormal','Tu estado Paranormal');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Somos de Calle','Somos de Calle');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Tv Web','Tv web');
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Famosos Con Nosotros','Famosos con nosotros');

INSERT INTO njv_category (name, description)  VALUES ('Blogs','Blogs');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Blogs','Blogs');

INSERT INTO njv_category (name, description)  VALUES ('Cartelera','Cartelera');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Cartelera','Cartelera');

INSERT INTO njv_category (name, description)  VALUES ('Sexualidad','Sexualidad');
SET @a = LAST_INSERT_ID();
INSERT INTO njv_category (parent_id,name, description)  VALUES (@a,'Sexualidad','sexualidad');

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

INSERT INTO njv_post  (tags_old, id_old, category_id_old, user_id, category_id, type, title, slug, content, summary, counter,ip,`status`,view_index, post_at, expire_at, display,twitter,america, frecuencia, created_at) SELECT tags, news_id , category_id,NULL,NULL,'NOTA' ,title, title AS slug,content, summary,counter, ip, 'pub', ver_index, datepost,dateexpire,display, twiter, america, frecuencia, datepost FROM news_publish p   WHERE YEAR(datepost) = 2014;
UPDATE njv_post n SET n.category_id = (SELECT category_id_new FROM tmp_category tc WHERE tc.category_id_old = n.category_id_old) WHERE YEAR(created_at) = 2014;

CALL migrate_slug_news('NOTA', 2014);
CALL migrate_tags_publish(2014);

INSERT INTO njv_post_multimedia (post_id, image, thumbnail_one, thumbnail_two, is_principal) SELECT n.id, imagen, thumbnail, thumbnail2, 1  FROM news_publish p INNER JOIN njv_post n ON p.news_id = n.id_old WHERE YEAR(n.created_at) = 2014;

INSERT INTO njv_post  (id_old, category_id, type, id_video, title, slug, content,counter,status, post_at) SELECT id_video, 7, "VIDEO", v, titulo, titulo,coment,visto, 'pbl', tiempo  FROM videos WHERE categoria = 'video';
INSERT INTO njv_post  (id_old, category_id, type, id_video, title, slug, content,counter,status, post_at) SELECT id_video, 8, "VIDEO", v, titulo, titulo,coment,visto, 'pbl', tiempo  FROM videos WHERE categoria = 'recomendados';
CALL migrate_slug_news_by_type('VIDEO');

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

