CREATE DATABASE viraindo_demo;

USE viraindo_demo;


CREATE TABLE tbl_viraindo_user(
	user_id INT NOT NULL auto_increment,
    user_email VARCHAR(100) NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    user_password VARCHAR(50) NOT NULL,
    PRIMARY KEY (user_id)
);

SELECT * FROM tbl_viraindo_user;

CREATE TABLE tbl_viraindo_category (
	category_id INT NOT NULL auto_increment,
    shopping_category_id INT,
    category_name VARCHAR(100) NOT NULL,
    category_stock INT NOT NULL,
    isActive INT,
    isUpdate INT,
    PRIMARY KEY (category_id),
    FOREIGN KEY (shopping_category_id) REFERENCES tbl_viraindo_shopping_category(shopping_category_id)
);

CREATE TABLE tbl_viraindo_sub_category (
	sub_category_id INT NOT NULL auto_increment,
	category_id INT NOT NULL,
    sub_category_name VARCHAR(100) NOT NULL,
    isActive INT,
    isUpdate INT,
    PRIMARY KEY (sub_category_id),
    FOREIGN KEY (category_id) REFERENCES tbl_viraindo_category (category_id)
);

CREATE TABLE tbl_viraindo_brand (
	brand_id INT NOT NULL auto_increment,
    brand_name VARCHAR(50) NOT NULL,
    isActive INT,
    isUpdate INT,
    PRIMARY KEY (brand_id)
);

CREATE TABLE tbl_viraindo_item (
	item_id INT NOT NULL auto_increment,
    category_id INT NOT NULL,
    brand_id INT NOT NULL,
    item_name VARCHAR(300) NOT NULL,
    item_picture VARCHAR(10000) NOT NULL,
    item_new_price INT NOT NULL,
    item_old_price INT NOT NULL,
    isActive INT,
    isUpdate INT,
    PRIMARY KEY (item_id),
    FOREIGN KEY (category_id) REFERENCES tbl_viraindo_category(category_id),
    FOREIGN KEY (sub_category_id) REFERENCES tbl_viraindo_sub_category(sub_category_id),
    FOREIGN KEY (brand_id) REFERENCES tbl_viraindo_brand(brand_id)
);

CREATE TABLE tbl_viraindo_item_detail (
	item_detail_id INT NOT NULL auto_increment,
    item_id INT NOT NULL

);

CREATE TABLE tbl_viraindo_shopping_category(
	shopping_category_id INT NOT NULL auto_increment,
    shopping_category_name VARCHAR(100),
    isActive INT,
    PRIMARY KEY (shopping_category_id)
);

DROP TABLE tbl_viraindo_category



