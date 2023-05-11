CREATE DATABASE viraindo_demo;

USE viraindo_demo;


CREATE TABLE tbl_viraindo_user(
	user_id INT NOT NULL auto_increment,
    user_email VARCHAR(100) NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    user_password VARCHAR(50) NOT NULL,
    createOn DATETIME,
    createBy INT,
    modifyOn DATETIME,
    modifyBy INT,
    PRIMARY KEY (user_id)
);

CREATE TABLE tbl_viraindo_category (
	category_id INT NOT NULL auto_increment,
    category_name VARCHAR(100),
    category_stock INT,
    isActive INT,
    updatedOn DATETIME,
    updatedBy VARCHAR(100) NULL,
    updatedCount INT NULL,
    insertedOn DATETIME,
    insertedBy VARCHAR(100) NULL,
    PRIMARY KEY (category_id)
);

CREATE TABLE tbl_viraindo_sub_category (
	sub_category_id INT NOT NULL auto_increment,
	category_id INT NOT NULL,
    sub_category_name VARCHAR(100) NOT NULL,
    isActive INT,
    updatedOn DATETIME,
    updatedBy VARCHAR(100) NULL,
    updatedCount INT NULL,
    insertedOn DATETIME,
    insertedBy VARCHAR(100) NULL,
    PRIMARY KEY (sub_category_id),
    FOREIGN KEY (category_id) REFERENCES tbl_viraindo_category (category_id)
);



CREATE TABLE tbl_viraindo_item (
	item_id INT NOT NULL auto_increment,
    sub_category_id INT NOT NULL,
    item_name VARCHAR(300) NOT NULL,
    item_picture VARCHAR(10000) NOT NULL,
    item_new_price INT NOT NULL,
    item_old_price INT NOT NULL,
    isActive INT,
    updatedOn DATETIME,
    updatedBy VARCHAR(100) NULL,
    updatedCount INT NULL,
    insertedOn DATETIME,
    insertedBy VARCHAR(100) NULL,
    PRIMARY KEY (item_id),
    FOREIGN KEY (sub_category_id) REFERENCES tbl_viraindo_sub_category(sub_category_id)
);

CREATE TABLE tbl_viraindo_brand (
	brand_id INT NOT NULL auto_increment,
    brand_name VARCHAR(50) NOT NULL,
    isActive INT,
    createOn DATETIME,
    createBy INT,
    modifyOn DATETIME,
    modifyBy INT,
    PRIMARY KEY (brand_id)
);





DROP TABLE tbl_viraindo_category;
DROP TABLE tbl_viraindo_shopping_category;
DROP TABLE tbl_viraindo_sub_category;
DROP TABLE tbl_viraindo_brand;
DROP TABLE tbl_viraindo_item;

	

SELECT Lap.iLaporanId, Lap.cKodeTransaksi, Lap.cNamaMaster, Lap.cNamaLaporan, Lap.cJenisLaporan, 
        Trans.cNamaPIC, Trans.cEmailPIC, Lap.cMediaLaporan, Lap.iTanggalSLA, Lap.iBulanSLA,
        GROUP_CONCAT(SLA.cKategori SEPARATOR '$^$') AS Kategori,
        GROUP_CONCAT(SLA.iTanggalDeadline SEPARATOR '$^$') AS TanggalDeadline
        FROM tbl_ceed_m_laporan Lap JOIN tbl_ceed_t_transaksi Trans
        ON Lap.iLaporanId = Trans.iLaporanId JOIN tbl_ceed_m_sla SLA
        ON SLA.iLaporanId = Lap.iLaporanId GROUP BY Lap.iLaporanId;
        
select * from tbl_viraindo_item;
	select * from tbl_viraindo_category;
	select * from tbl_viraindo_sub_category;

SELECT TVSC.sub_category_id, TVSC.sub_category_name, GROUP_CONCAT(TVI.item_name SEPARATOR '$^$') AS item_name,
GROUP_CONCAT(TVI.item_picture SEPARATOR '$^$') AS item_picture, GROUP_CONCAT(TVI.item_new_price SEPARATOR '$^$') AS item_price
FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id 
WHERE TVI.item_name LIKE "%fan%"
GROUP BY TVSC.sub_category_id;


truncate table tbl_viraindo_item;

SELECT item_id, item_name FROM tbl_viraindo_item WHERE item_name like '%intel%' LIMIT 10;


SELECT item_id, item_name, item_picture, item_new_price, brand_name FROM tbl_viraindo_item TVI JOIN tbl_viraindo_brand TVB ON TVI.brand_id = TVB.brand_id LIMIT 100;
