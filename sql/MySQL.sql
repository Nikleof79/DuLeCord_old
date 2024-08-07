CREATE DATABASE dulecord;
USE dulecord;
CREATE TABLE users (
    username VARCHAR(25) PRIMARY KEY NOT NULL,
    name VARCHAR(25) NOT NULL,
    password VARCHAR(60) NOT NULL,
    about VARCHAR(150) NULL
);

CREATE TABLE friends (
    requester VARCHAR(25) NOT NULL,
    reciver VARCHAR(25) NOT NULL,
    is_request TINYINT(1) NOT NULL
);
