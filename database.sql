CREATE DATABASE viraindo_demo;

USE viraindo_demo;


CREATE TABLE tbl_viraindo_user(
	user_id INT NOT NULL auto_increment,
    user_email VARCHAR(100) NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    user_password VARCHAR(50) NOT NULL,
    PRIMARY KEY (user_id)
);

CREATE TABLE tbl_viraindo_shopping_category(
	shopping_category_id INT NOT NULL auto_increment,
    shopping_category_name VARCHAR(100),
    isActive INT,
    PRIMARY KEY (shopping_category_id)
);

CREATE TABLE tbl_viraindo_category (
	category_id INT NOT NULL auto_increment,
    shopping_category_id INT,
    category_name VARCHAR(100),
    category_stock INT,
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
    sub_category_id INT NOT NULL,
    brand_id INT NOT NULL,
    item_name VARCHAR(300) NOT NULL,
    item_picture VARCHAR(10000) NOT NULL,
    item_new_price INT NOT NULL,
    item_old_price INT NOT NULL,
    isActive INT,
    isUpdate INT,
    PRIMARY KEY (item_id),
    FOREIGN KEY (sub_category_id) REFERENCES tbl_viraindo_sub_category(sub_category_id),
    FOREIGN KEY (brand_id) REFERENCES tbl_viraindo_brand(brand_id)
);

CREATE TABLE tbl_viraindo_processor (
	processor_id INT,
    processor_name VARCHAR(20)
);

CREATE TABLE tbl_viraindo_item_detail (
	item_detail_id INT NOT NULL auto_increment,
    item_id INT NOT NULL

);

DROP TABLE tbl_viraindo_category;
DROP TABLE tbl_viraindo_shopping_category;
DROP TABLE tbl_viraindo_sub_category;
DROP TABLE tbl_viraindo_brand;
DROP TABLE tbl_viraindo_item;

select * from tbl_viraindo_item;


SELECT item_id, item_name FROM tbl_viraindo_item WHERE item_name like '%intel%' LIMIT 10;


SELECT item_id, item_name, item_picture, item_new_price, brand_name FROM tbl_viraindo_item TVI JOIN tbl_viraindo_brand TVB ON TVI.brand_id = TVB.brand_id LIMIT 100;
