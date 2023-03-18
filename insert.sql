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
(4, 2, 'A-trend G41 (Intel G41, Vga, DDR3)', '1', '500000', '600000', '1', '0'),
(2, 1, 'A-trend G41 (Intel G41, Vga, DDR3)', '1', '500000', '600000', '1', '0'),
(3, 1, 'A-trend G41 (Intel G41, Vga, DDR3)', '1', '500000', '600000', '1', '0');

INSERT INTO tbl_viraindo_shopping_category (shopping_category_id, shopping_category_name, isActive) VALUES
(1, 'komponen komputer', 1), (2, 'aksesoris komputer', 1), (3, 'headset', 1), (4, 'networking', 1);


USE viraindo_demo;

SELECT * FROM tbl_viraindo_item;




SELECT * FROM tbl_viraindo_shopping_category ShopCat 
INNER JOIN tbl_viraindo_category Cat 
ON ShopCat.shopping_category_id = Cat.shopping_category_id
INNER JOIN tbl_viraindo_sub_category SubCat
ON Cat.category_id = SubCat.category_id
INNER JOIN tbl_viraindo_item Item
ON SubCat.sub_category_id = Item.sub_category_id
INNER JOIN tbl_viraindo_brand Brand
