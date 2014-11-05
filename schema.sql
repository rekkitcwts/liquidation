# This schema currently works with PostgreSQL.
# Change attributes to fit into other DBMS like MySQL or SQL Server.

CREATE TABLE users (
    id serial NOT NULL,
    username VARCHAR(128) NOT NULL,
    password VARCHAR(128) NOT NULL,
    fname varchar(255) NOT NULL,
    lname varchar(255) NOT NULL,
    role VARCHAR(64) NOT NULL,
    created timestamp without time zone DEFAULT NULL,
    modified timestamp without time zone DEFAULT NULL,
    deleted boolean DEFAULT false,
    PRIMARY KEY (id)
);

CREATE TABLE organisations (
    id serial NOT NULL,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);