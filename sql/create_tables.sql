--
-- heroku pg:psql < create_tables.sql
--

CREATE TABLE ut(
	id SERIAL PRIMARY KEY,
	username varchar(50) NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE bike(
	id SERIAL PRIMARY KEY,
	user_id INTEGER REFERENCES ut NOT NULL,
	distance DOUBLE PRECISION DEFAULT 0,
	name varchar(50) NOT NULL,
	model varchar(400),
	link varchar(400),
	year INTEGER,
	in_use BOOLEAN DEFAULT TRUE,
	retired BOOLEAN DEFAULT FALSE,
	description varchar(400)
);

CREATE TABLE component(
	id SERIAL PRIMARY KEY,
	user_id INTEGER REFERENCES ut NOT NULL,
	bike_id INTEGER REFERENCES bike,
	distance DOUBLE PRECISION DEFAULT 0,
	name varchar(50) NOT NULL,
	model varchar(400),
	link varchar(400),
	year INTEGER, 
	in_use BOOLEAN DEFAULT FALSE,
	retired BOOLEAN DEFAULT FALSE,
	description varchar(400) 
);

CREATE TABLE gear(
	id SERIAL PRIMARY KEY,
	user_id INTEGER REFERENCES ut NOT NULL,
	distance DOUBLE PRECISION DEFAULT 0,
	name varchar(50) NOT NULL,
	model varchar(400),
	link varchar(400),
	year INTEGER, 
	in_use BOOLEAN DEFAULT FALSE,
	retired BOOLEAN DEFAULT FALSE,
	description varchar(400) 
);

CREATE TABLE tag(
	id SERIAL PRIMARY KEY,
	user_id INTEGER REFERENCES ut NOT NULL,
	name varchar(50) NOT NULL,
	exclusive BOOLEAN DEFAULT FALSE,
	required BOOLEAN DEFAULT FALSE
);

CREATE TABLE biketag(
	id SERIAL PRIMARY KEY,
	tag INTEGER REFERENCES tag NOT NULL,
	bike INTEGER REFERENCES bike NOT NULL
);

CREATE TABLE geartag(
	id SERIAL PRIMARY KEY,
	tag INTEGER REFERENCES tag NOT NULL,
	gear INTEGER REFERENCES gear NOT NULL
);

CREATE TABLE componenttag(
	id SERIAL PRIMARY KEY,
	tag INTEGER REFERENCES tag NOT NULL,
	component INTEGER REFERENCES component NOT NULL
);
