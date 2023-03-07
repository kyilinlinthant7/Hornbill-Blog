-- create database
CREATE DATABASE hornbill_blog;


-- create tables
-- users
CREATE TABLE users (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	password VARCHAR(50) NOT NULL,
	role VARCHAR(50) NOT NULL,
	PRIMARY KEY (id)
);


-- categories
CREATE TABLE categories (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
);

-- blogs
CREATE TABLE blogs (
	id INT(11) NOT NULL AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	category_id INT(11) NOT NULL,
	content LONGTEXT NOT NULL,
	image VARCHAR(255),
	user_id INT(11) NOT NULL,
	created_at TIMESTAMP NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (category_id) REFERENCES categories(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
);

-- comments
CREATE TABLE comments (
	id INT(11) NOT NULL AUTO_INCREMENT,
	text TEXT NOT NULL,
	blog_id INT(11) NOT NULL,
	user_id INT(11) NOT NULL,
	created_at DATETIME NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (blog_id) REFERENCES blogs(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
);
