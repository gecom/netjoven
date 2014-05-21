SET GLOBAL event_scheduler=ON;

CREATE EVENT update_search ON SCHEDULE EVERY 2 MINUTE STARTS now() DO call addPostSearch(2014);

-- DROP EVENT update_search;

INSERT INTO njv_banner_detail 
(banner_id, tag, date_start, date_end, time_start, time_end, module, type, sector, weight,status)
select idbanner, tag,inicio, fin, horainicio, horafin, modulo, tipo, sector, peso, if(activo = 'si','act', 'ina') 
from banners 


-- INSERT INTO njv_banner (id, title, code, created_at ) select id, titulo, codigo, creacion from bannerstxt;