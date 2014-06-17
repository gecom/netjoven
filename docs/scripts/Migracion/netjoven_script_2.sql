INSERT INTO njv_post  (id_old,type_video, category_id, type, id_video, title, slug, content,counter,status, post_at) SELECT id_video, 'Y', 37, "VIDEO", v, titulo, titulo,coment,visto, 'pbl', tiempo  FROM videos WHERE categoria = 'video';
INSERT INTO njv_post  (id_old,type_video, category_id, type, id_video, title, slug, content,counter,status, post_at) SELECT id_video, 'Y', 37, "VIDEO", v, titulo, titulo,coment,visto, 'pbl', tiempo  FROM videos WHERE categoria = 'recomendados';
CALL migrate_slug_news_by_type('VIDEO');

INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,13, 'GALLERY', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'AMBOS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,13, 'GALLERY', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'CHICOS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,13, 'GALLERY', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'CHICAS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,13, 'GALLERY', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'NETJOVEN';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,16, 'GALLERY', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'FAMOSAS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,16, 'GALLERY', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'FAMOSOS';
CALL migrate_slug_news_by_type('GALLERY');
CALL migrate_tags_by_type('GALLERY');
INSERT INTO njv_post_multimedia (post_id, title, image, is_gallery) SELECT n.id,titulo, imagen, 1 FROM galeria_foto g INNER JOIN njv_post n ON g.id_galeria = n.id_old WHERE has_gallery = 1;
UPDATE njv_post SET type = 'NOTA' WHERE  type = 'GALLERY';

INSERT INTO njv_directory (category_id, status) VALUES ( '9', 'act');
INSERT INTO njv_directory (category_id, status) VALUES ( '25', 'act');

INSERT INTO njv_banner (id, title, code, created_at ) select id, titulo, codigo, creacion from bannerstxt;

INSERT INTO njv_banner_detail 
(banner_id, tag, date_start, date_end, time_start, time_end, module, type, sector, weight,status)
SELECT idbanner, tag,inicio, fin, horainicio, horafin, modulo, tipo, sector, peso,
if(activo = 'si','act', 'ina') as status 
FROM banners b INNER JOIN 
bannerstxt d ON b.idbanner = d.id ORDER BY d.id

UPDATE njv_banner_detail b
INNER JOIN njv_banner_sector s ON UPPER(s.name) = UPPER(b.sector)
SET sector_id = s.id;

CALL migrate_tags_news(2013,1);
CALL migrate_tags_news(2013,2);
CALL migrate_tags_news(2013,3);
CALL migrate_tags_news(2013,4);
CALL migrate_tags_news(2013,5);
CALL migrate_tags_news(2013,6);
CALL migrate_tags_news(2013,7);
CALL migrate_tags_news(2013,8);
CALL migrate_tags_news(2013,9);
CALL migrate_tags_news(2013,10);
CALL migrate_tags_news(2013,11);
CALL migrate_tags_news(2013,12);

CALL migrate_tags_news(2014,1);
CALL migrate_tags_news(2014,2);
CALL migrate_tags_news(2014,3);
CALL migrate_tags_news(2014,4);
CALL migrate_tags_news(2014,5);
CALL migrate_tags_news(2014,6);
CALL migrate_tags_news(2014,7);
CALL migrate_tags_news(2014,8);
CALL migrate_tags_news(2014,9);
CALL migrate_tags_news(2014,10);
CALL migrate_tags_news(2014,11);
CALL migrate_tags_news(2014,12);