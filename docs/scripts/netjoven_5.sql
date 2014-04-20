SET GLOBAL event_scheduler=ON;

CREATE EVENT update_search ON SCHEDULE EVERY 2 MINUTE STARTS now() DO call addPostSearch(2014);

-- DROP EVENT update_search;