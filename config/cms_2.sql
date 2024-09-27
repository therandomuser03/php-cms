-- SQL file for table structure (to setup or export database)

-- IF DATABASE IS NOT CREATED, THEN ONLY FOLLOW THE "Database creation" COMMAND

-- Database creation
CREATE DATABASE cms_2;
USE cms_2;

-----------------------------------------------------

-- Table: content
CREATE TABLE content (
    sl_no INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    header_image VARCHAR(255),
    contents TEXT NOT NULL,
    search_tag VARCHAR(255),
    display ENUM('yes', 'no') NOT NULL DEFAULT 'yes'
);

-- Table: login
CREATE TABLE login (
    sl_no INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(15),
    password VARCHAR(255) NOT NULL,
    status ENUM('admin', 'user', 'others') NOT NULL DEFAULT 'user',
    access ENUM('yes', 'no') NOT NULL DEFAULT 'yes'
);

-- Table: gallery
CREATE TABLE gallery (
    sl_no INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    url VARCHAR(255) NOT NULL,
    display ENUM('yes', 'no') NOT NULL DEFAULT 'yes',
    size VARCHAR(50) NOT NULL
);
