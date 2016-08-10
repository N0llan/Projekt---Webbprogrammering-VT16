CREATE SCHEMA projekt1;
SET search_path = projekt1, public, pg_catalog;

CREATE TABLE medlem (
  firstname VARCHAR(20) NOT NULL,
  lastname VARCHAR(20) NOT NULL,
  nick VARCHAR(20) NOT NULL,
  epost VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,
  admin BOOLEAN NOT NULL,
  salt1 CHAR(6) NOT NULL,
  salt2 CHAR(6) NOT NULL,
CONSTRAINT medlem_pk PRIMARY KEY(epost));

CREATE TABLE nyhet (
  rubrik VARCHAR(40) NOT NULL,
  content VARCHAR(1000) NOT NULL,
  skriven DATE NOT NULL,
CONSTRAINT nyhet_pk PRIMARY KEY(rubrik));
