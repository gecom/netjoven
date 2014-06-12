
mysql -h localhost -u root -p --default_character_set utf8 -f netjoven < D:\netjovenv2.sql

mysqldump -h localhost -u root -p netjoven2 > netjovenv2.sql

mysqldump --skip-triggers --compact --no-create-info  -h localhost -u root -p netjoven2 > inser_data2.sql
source D:\netjoven_2.sql