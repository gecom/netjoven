
INSERT INTO njv_directory_publishing (id, directory_id, title, address, web, phone, observation, place, id_district, type, created_at,status) SELECT iddisco, 2, titulo, direccion, web,telefono, observaciones, lugar, distrito, tipo, fecha, if(activo = 'si', 'act', 'ina')  FROM socdisco;
INSERT INTO njv_district (id, id_city, district, link_uri, place) SELECT * FROM distrito;
