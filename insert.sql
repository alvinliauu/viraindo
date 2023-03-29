INSERT INTO tbl_viraindo_category (shopping_category_id, category_name, category_stock, isActive, isUpdate) VALUES 
(1, 'Motherboard', 100, 1, 0), (1, 'Processor', 100, 1, 0), (1, 'HDD', 100, 1, 0), (1, 'SSD', 100, 1, 0),
(2, 'NAS', 100, 1, 0), (2, 'RAM', 100, 1, 0), (2, 'LCD', 100, 1, 0), (2, 'Casing', 100, 1, 0),
(2, 'Power Supply', 100, 1, 0), (2, 'VGA Card', 100, 1, 0), (2, 'Optical Drive', 100, 1, 0),
(2, 'Memory Card', 100, 1, 0), (2, 'Flash Disk', 100, 1, 0), (2, 'Keyboard', 100, 1, 0),
(2, 'Mouse', 100, 1, 0), (2, 'Speaker', 100, 1, 0), (2, 'Sound Card', 100, 1, 0), (3, 'Headset', 100, 1, 0),
(3, 'Cooler & Fan', 100, 1, 0), (3, 'Aksesoris', 100, 1, 0), (3, 'Networking', 100, 1, 0), (3, 'Printer', 100, 1, 0),
(3, 'Scanner', 100, 1, 0), (4, 'Perlengkapan Kantor / Office', 100, 1, 0), (4, 'Tinta & Toner', 100, 1, 0),
(4, 'Software Original', 100, 1, 0), (4, 'UPS', 100, 1, 0), (4, 'Stabilizer', 100, 1, 0), (4, 'Notebook', 100, 1, 0),
(4, 'PC Branded', 100, 1, 0), (4, 'Games', 100, 1, 0);


INSERT INTO tbl_viraindo_sub_category (category_id, sub_category_name, isActive, isUpdate) VALUES
(1, 'Intel G41, Vga, DDR3', 1, 0), (1, 'Afox IG41 (Intel G41, Vga, DDR3)', 1, 0), (1, 'Afox IG41-MA6 (Intel G41, Vga, DDR3)', 1, 0),
(1, 'Afox IG41-MA7 (Intel G41, Vga, DDR3)', 1, 0), (1, 'Amptron G41 (Intel G41, Vga, DDR3)', 1, 0), (1, 'Digital Alliance IG41-MA6 (Intel G41, Vga, DDR3)', 1, 0),
(1, 'MSI G45 (Intel G45, Vga, DDR3)', 1, 0), (2, 'Dual Core, 1.6 Ghz (FSB 800 Mhz) E2140 Cache 1 MB (Tray)', 1, 0), (2, 'Core i3 6100 (3.7 Ghz) Cache 3 MB (BOX)', 1, 0),
(2, 'Core i7 6700 (3.4 Ghz up to 3.9 Ghz) Cache 8 MB (BOX)', 1, 0), (2, 'Core i7 7700 (3.6 Ghz up to 4.2 Ghz) Cache 8 MB (Tray)', 1, 0), (2, 'Core i9 9900KF (3.6 Ghz up to 5.0 Ghz) Cache 16 MB (BOX)', 1, 0),
(2, 'Core i7 5960X (3.0 Ghz up to 3.5 Ghz) Cache 20 MB (BOX)', 1, 0), (3, 'Seagate 3.5" 80 GB IDE', 1, 0), (3, 'Seagate 3.5" 500 GB Sata3 Bararcuda', 1, 0), (3, 'Seagate 3.5" 4 TB Sata3 Skyhawk (Ready Stock)', 1, 0), (3, 'Western Digital 3.5" 2 TB Sata Enterprise', 1, 0),
(3, 'Toshiba 8TB SATA3 7200RPM - X300 Series', 1, 0), (3, 'Toshiba 1TB SATA3 5700RPM For CCTV - V300 Series', 1, 0);


INSERT INTO tbl_viraindo_brand (brand_name, isActive, isUpdate) VALUES
('Intel', '1', '0'), ('Afox', '1', '0'), ('Digital Alliance', '1', '0'), ('Toshiba', '1', '0'), ('Seagate', '1', '0');


INSERT INTO tbl_viraindo_item (sub_category_id, brand_id, item_name, item_picture, item_new_price, item_old_price, isActive, isUpdate) VALUES 
(1, 1, 'A-trend G41 (Intel G41, Vga, DDR3)', '1', '500000', '600000', '1', '0'),
(2, 1, 'A-trend G41 (Intel G41, Vga, DDR3)', '1', '500000', '600000', '1', '0'),
(3, 2, 'A-trend G41 (Intel G41, Vga, DDR3)', '1', '500000', '600000', '1', '0'),
(4, 1, 'A-trend G41 (Intel G41, Vga, DDR3)', '1', '500000', '600000', '1', '0'),
(5, 1, 'A-trend G41 (Intel G41, Vga, DDR3)', '1', '500000', '600000', '1', '0'),
(6, 1, 'A-trend G41 (Intel G41, Vga, DDR3)', '1', '500000', '600000', '1', '0'),
(7, 1, 'A-trend G41 (Intel G41, Vga, DDR3)', '1', '500000', '600000', '1', '0'),
(7, 1, 'A-trend G41 (Logitech G41, Vga, DDR3)', '1', '500000', '600000', '1', '0');




INSERT INTO tbl_viraindo_shopping_category (shopping_category_id, shopping_category_name, isActive) VALUES
(1, 'komponen komputer', 1), (2, 'aksesoris komputer', 1), (3, 'headset', 1), (4, 'networking', 1);


INSERT INTO tbl_viraindo_processor (processor_id, processor_name) VALUES
(1, 'Intel'), (2, 'AMD');


USE viraindo_demo;

SELECT * FROM tbl_viraindo_item;


SELECT item_id, item_name FROM tbl_viraindo_item WHERE item_name like '%intel%' LIMIT 5;


SELECT * FROM tbl_viraindo_shopping_category ShopCat 
INNER JOIN tbl_viraindo_category Cat 
ON ShopCat.shopping_category_id = Cat.shopping_category_id
INNER JOIN tbl_viraindo_sub_category SubCat
ON Cat.category_id = SubCat.category_id
INNER JOIN tbl_viraindo_item Item
ON SubCat.sub_category_id = Item.sub_category_id
INNER JOIN tbl_viraindo_brand Brand;







insert into tbl_viraindo_shopping_category (shopping_category_name, isActive) values ('komponen komputer', 1), ('notebook and accessories', 1);

insert into tbl_viraindo_category (shopping_category_id, category_name, category_stock, isActive) values (1, 'processor', 100, 1), (1, 'motherboard', 100, 1), (2, 'notebook', 100, 1), (2, 'ram notebook', 100, 1);

insert into tbl_viraindo_sub_category (category_id, sub_category_name, isActive) values (1, 'intel core i3', 1), (1, 'intel core i5', 1), (1, 'intel core i7', 1),
(2, 'colorful', 1), (2, 'AMD', 1), (2, 'MSI', 1), (3, 'acer', 1), (3, 'apple', 1), (4, 'ddr2', 1), (4, 'ddr4', 1);

insert into tbl_viraindo_item (sub_category_id, brand_id, item_name, item_picture, item_new_price, item_old_price, isActive) values
(1, 1, 'Intel Core i3-13100 3.4GHz Up To 4.5GHz - Cache 12MB [Box] Socket LGA 1700 - Raptor Lake Series', 'image', 500000, 450000, 1),
(1, 1, 'Intel Core i3-12100 3.3GHz Up To 4.3GHz - Cache 12MB [Box] Socket LGA 1700 - Alder Lake Series', 'image', 500000, 450000, 1),
(2, 1, 'Intel Core i5-13600K 3.5GHz Up To 5.1GHz - Cache 24MB [Box] Socket LGA 1700 - Raptor Lake Series', 'image', 500000, 450000, 1),
(2, 1, 'Intel Core i5-13500 2.5GHz Up To 4.8GHz - Cache 24MB [Box] Socket LGA 1700 - Raptor Lake Series', 'image', 500000, 450000, 1),
(3, 1, 'Intel Core i7-13700K 3.4GHz Up To 5.4GHz - Cache 30MB [Box] Socket LGA 1700 - Raptor Lake Series', 'image', 500000, 450000, 1),
(3, 1, 'Intel Core i7-13700 2.1GHz Up To 5.2GHz - Cache 30MB [Box] Socket LGA 1700 - Raptor Lake Series', 'image', 500000, 450000, 1),
(5, 1, 'AMD Ryzen 9 5950X 3.4Ghz Up To 4.9Ghz Cache 64MB 105W AM4 [Box] - 16 Core - 100-100000059WOF (Garansi Lokal/AMD Indonesia)', 'image', 500000, 450000, 1),
(5, 1, 'AMD Ryzen 9 5950Z 3.4Ghz Up To 5.9Ghz Cache 64MB 105W AM4 [Box] - 16 Core - 100-100000F', 'image', 500000, 450000, 1),
(7, 1, 'Acer Aspire 3 (A314-22-A1M5)', 'image', 500000, 450000, 1),
(7, 1, 'Acer Aspire 3 Slim (A314-23M-R7VJ)', 'image', 500000, 450000, 1),
(9, 1, 'ddr2 gigabyte', 'image', 500000, 450000, 1),
(10, 1, 'ddr4 samsung', 'image', 500000, 450000, 1);

insert into tbl_viraindo_brand (brand_name, isActive) values ('test aja', 1);




select sc.shopping_category_id, sc.shopping_category_name, c.category_id, c.category_name, suc.sub_category_id, suc.sub_category_name, it.item_id, it.item_name
from tbl_viraindo_shopping_category sc 
join tbl_viraindo_category c on sc.shopping_category_id = c.shopping_category_id
join tbl_viraindo_sub_category suc on suc.category_id = c.category_id
join tbl_viraindo_item it on it.sub_category_id = suc.sub_category_id;



SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI 
        JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
        JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
        WHERE TVC.category_name = 'processor' AND TVI.item_name LIKE '%i3%';