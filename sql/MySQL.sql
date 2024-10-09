CREATE DATABASE dulecord;
USE dulecord;
CREATE TABLE users
(
    username VARCHAR(25) PRIMARY KEY NOT NULL,
    name     VARCHAR(25)             NOT NULL,
    password VARCHAR(60)             NOT NULL,
    hasAvatar TINYINT(1)             NOT NULL,
    settings VARCHAR(150)            NULL,
    about    VARCHAR(150)            NULL
);

CREATE TABLE friends
(
    `requester` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `reciver` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
);

CREATE TABLE friends_requests
(
    `requester` VARCHAR(25) NOT NULL,
    `reciver`   VARCHAR(25) NOT NULL
);

CREATE TABLE messages
(
    `requester` VARCHAR(25) NOT NULL,
    `reciver`   VARCHAR(25) NOT NULL
);