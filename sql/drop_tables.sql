--
-- heroku pg:psql < drop_tables.sql
--

DROP TABLE IF EXISTS ut CASCADE;
DROP TABLE IF EXISTS bike CASCADE;
DROP TABLE IF EXISTS component CASCADE;
DROP TABLE IF EXISTS gear CASCADE;
DROP TABLE IF EXISTS tag CASCADE;
DROP TABLE IF EXISTS biketag CASCADE;
DROP TABLE IF EXISTS componenttag CASCADE;
DROP TABLE IF EXISTS geartag CASCADE;
