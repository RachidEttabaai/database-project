DROP DATABASE IF EXISTS db_shop;
CREATE DATABASE db_shop charset=utf8;

DROP TABLE IF EXISTS Customer;
CREATE TABLE Customer(customer_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
firstname VARCHAR(256),
lastname VARCHAR(256),
email VARCHAR(256),
phone VARCHAR(256));

DROP TABLE IF EXISTS Address;
CREATE TABLE Address(id_address INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
customer_id INT,
address_type VARCHAR(256),
address LONGTEXT,
town VARCHAR(256),
country VARCHAR(256),
FOREIGN KEY (customer_id) REFERENCES Customer(customer_id));

DROP TABLE IF EXISTS Product;
CREATE TABLE Product(product_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
name VARCHAR(256),
description LONGTEXT,
url VARCHAR(256),
keywords VARCHAR(256),
price FLOAT);

DROP TABLE IF EXISTS Compagny;
CREATE TABLE Compagny(compagny_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
product_id INT,
name_compagny VARCHAR(256),
FOREIGN KEY (product_id) REFERENCES Product(product_id));

DROP TABLE IF EXISTS Sale;
CREATE TABLE Sale(sale_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
customer_id INT,
date DATETIME,
colorstatus VARCHAR(256),
montant FLOAT,
FOREIGN KEY (customer_id) REFERENCES Customer(customer_id)
);

DROP TABLE IF EXISTS Basket;
CREATE TABLE Basket(basket_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
sale_id INT,
product_id INT,
price FLOAT,
quantite INT,
FOREIGN KEY (sale_id) REFERENCES Sale(sale_id),
FOREIGN KEY (product_id) REFERENCES Product(product_id));


