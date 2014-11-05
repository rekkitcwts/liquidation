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

CREATE TABLE items (
    id serial NOT NULL,
    item_name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE liquidations (
    id serial NOT NULL,
    recipient varchar(255) NOT NULL,
    position varchar(255) NOT NULL,
    form_number varchar(16) NOT NULL,
    voucher_number varchar(16) NOT NULL,
    amount_received numeric(8,2) NOT NULL,
    buficom bigint NOT NULL,
    org_id bigint NOT NULL,
    created timestamp without time zone DEFAULT NULL,
    modified timestamp without time zone DEFAULT NULL,
    deleted boolean DEFAULT false,
    PRIMARY KEY (id),
    FOREIGN KEY (buficom) REFERENCES users(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (org_id) REFERENCES organisations(id) ON UPDATE CASCADE ON DELETE RESTRICT
);