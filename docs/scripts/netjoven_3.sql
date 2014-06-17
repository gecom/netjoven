



INSERT INTO njv_post  (id,tags_old, id_old, category_id_old, user_id, category_id, type, title, slug, content, summary, counter,ip,`status`,view_index, post_at, expire_at, display,twitter,america, frecuencia, created_at) SELECT news_id,tags, news_id , category_id,NULL,NULL,'NOTA' ,title, title AS slug,content, summary,counter, ip, 'pub', ver_index, datepost,dateexpire,display, twiter, america, frecuencia, datepost FROM news_publish p   WHERE YEAR(datepost) = 2014;
UPDATE njv_post t1 INNER JOIN tmp_category t2 ON t1.category_id_old = t2.category_id_old SET t1.category_id = t2.category_id_new WHERE YEAR(created_at) = 2014 and t1.category_id_old IS NOT  NULL;

CALL migrate_slug_news('NOTA', 2014);
CALL migrate_tags_publish(2014);

INSERT INTO njv_post_multimedia (post_id, image, thumbnail_one, thumbnail_two, is_principal) SELECT n.id, imagen, thumbnail, thumbnail2, 1  FROM news_publish p INNER JOIN njv_post n ON p.news_id = n.id_old WHERE YEAR(n.created_at) = 2014;




INSERT INTO njv_post  (id_old,type_video, category_id, type, id_video, title, slug, content,counter,status, post_at) SELECT id_video, 'Y', 37, "VIDEO", v, titulo, titulo,coment,visto, 'pbl', tiempo  FROM videos WHERE categoria = 'video';
INSERT INTO njv_post  (id_old,type_video, category_id, type, id_video, title, slug, content,counter,status, post_at) SELECT id_video, 'Y', 37, "VIDEO", v, titulo, titulo,coment,visto, 'pbl', tiempo  FROM videos WHERE categoria = 'recomendados';
CALL migrate_slug_news_by_type('VIDEO');

INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,13, 'NOTA', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'AMBOS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,13, 'NOTA', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'CHICOS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,13, 'NOTA', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'CHICAS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,13, 'NOTA', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'NETJOVEN';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,16, 'NOTA', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'FAMOSAS';
INSERT INTO njv_post  (id_old, category_id, type, title, slug, content,summary,tags_old, has_gallery, post_at)
SELECT id_galeria,16, 'NOTA', titulo, titulo, descp, sumary, tags,1, creacion FROM galeria WHERE UPPER(cat) = 'FAMOSOS';
CALL migrate_slug_news_by_type('NOTA');
CALL migrate_tags_by_type('NOTA');
INSERT INTO njv_post_multimedia (post_id, title, image, is_gallery) SELECT n.id,titulo, imagen, 1 FROM galeria_foto g INNER JOIN njv_post n ON g.id_galeria = n.id_old WHERE has_gallery = 1;




CALL migrate_tags_news(2014);

