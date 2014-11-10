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
    activity varchar(255) NOT NULL,
    amount_received numeric(8,2) NOT NULL,
    buficom bigint NOT NULL,
    org_id bigint NOT NULL,
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone NOT NULL,
    deleted boolean DEFAULT false,
    PRIMARY KEY (id),
    FOREIGN KEY (buficom) REFERENCES users(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (org_id) REFERENCES organisations(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE user_organisation (
    id serial NOT NULL,
    user_id bigint NOT NULL,
    org_id bigint NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (org_id) REFERENCES organisations(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE disbursements (
    id serial NOT NULL,
    liquidation_id bigint NOT NULL,
    item_id bigint NOT NULL,
    disbursement_date date NOT NULL,
    or_number varchar(20) NOT NULL,
    amount numeric(8,2) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (liquidation_id) REFERENCES liquidations(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (item_id) REFERENCES items(id) ON UPDATE CASCADE ON DELETE RESTRICT
);