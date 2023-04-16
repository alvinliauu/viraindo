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

TRUNCATE TABLE tbl_viraindo_item;

SELECT * FROM tbl_viraindo_item;
select * from tbl_viraindo_category;
select * from tbl_viraindo_sub_category;

SELECT item_id, item_name FROM tbl_viraindo_item WHERE item_name like '%intel%' LIMIT 5;

SELECT TVI.item_name FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
ON TVC.category_id = TVSC.category_id WHERE TVC.category_id = '34';

SELECT * FROM tbl_viraindo_item;

TRUNCATE TABLE tbl_viraindo_item;

TRUNCATE TABLE tbl_viraindo_sub_category;

SELECT * FROM tbl_viraindo_sub_category;



SELECT * FROM tbl_viraindo_shopping_category ShopCat 
INNER JOIN tbl_viraindo_category Cat 
ON ShopCat.shopping_category_id = Cat.shopping_category_id
INNER JOIN tbl_viraindo_sub_category SubCat
ON Cat.category_id = SubCat.category_id
INNER JOIN tbl_viraindo_item Item
ON SubCat.sub_category_id = Item.sub_category_id
INNER JOIN tbl_viraindo_brand Brand;


SELECT * FROM tbl_viraindo_sub_category WHERE sub_category_name = 'Processor Intel Pentium/Core i3 / i5 / i7 Socket 0192';




insert into tbl_viraindo_shopping_category (shopping_category_name, isActive) values ('komponen komputer', 1), ('notebook and accessories', 1);

insert into tbl_viraindo_category (category_name, category_stock, isActive) values 
('motherboard', 100, 1), ('processor', 100, 1), ('storage', 100, 1), 
('memory ram', 100, 1), ('casing', 100, 1), ('VGA', 100, 1), 
('PSU', 100, 1), ('mouse', 100, 1), ('keyboard', 100, 1), 
('ssd', 100, 1), ('mousepad', 100, 1), ('monitor', 100, 1),
('cooler', 100, 1), ('accessories', 100, 1);

insert into tbl_viraindo_sub_category (category_id, sub_category_name, isActive) values 
(1, 'M/B Intel Socket LGA 775', 1), 
(1, 'M/B Intel Socket 1151', 1),
(1, 'M/B AMD Socket AM4', 1),
(2, 'Processor Intel Socket LGA 775', 1), 
(2, 'Processor Intel Core i3 / i5 / i7 Socket 1151', 1), 
(2, 'Processor Intel Pentium/Core i3 / i5 / i7 Socket 1155', 1),
(2, 'Processor AMD Socket FM2+', 1),
(2, 'Processor AMD Socket AM4', 1),
(2, 'Processor AMD Socket AM5', 1),
(3, 'Hard Disk 3.5', 1), 
(3, 'Hard Disk 2.5', 1), 
(4, 'Memory PC DDR3', 1), 
(4, 'Memory PC DDR4', 1),
(5, 'Casing', 1),
(6, 'VGA Card', 1),
(7, 'Power Supply', 1),
(8, 'Logitech', 1),
(8, 'A4Tech', 1),
(8, 'Corsair', 1),
(9, 'Logitech', 1),
(9, 'Cyborg', 1),
(10, 'SSD', 1),
(11, 'Logitech', 1),
(12, 'LED Monitor', 1),
(13, 'Fan Processor', 1),
(13, 'Fan Vga / Vga Cooler', 1),
(14, 'ORICO', 1),
(14, 'Bafo', 1);


insert into tbl_viraindo_brand (brand_name, isActive) values ('intel', 1), ('AMD', 1), ('logitech', 1), ('razer', 1);

insert into tbl_viraindo_item (sub_category_id, brand_id, item_name, item_picture, item_new_price, item_old_price, isActive) values
(1, 1, 'A-trend G41 (Intel G41, Vga, DDR3)', 'image', 500000, 450000, 1),
(1, 1, 'Afox IG41-MA7 (Intel G41, Vga, DDR3)', 'image', 500000, 450000, 1),
(2, 1, 'Afox IH61-MA (Intel H61, DDR3)', 'image', 500000, 450000, 1),
(2, 1, 'Asus P8H61-M (Intel H61, DDR3)', 'image', 500000, 450000, 1),
(3, 2, 'ASRock A320MH PRO (AMD A320, DDR4)', 'image', 500000, 450000, 1),
(3, 2, 'ASRock A320M-HDV R4.0 (AMD A320, DDR4)', 'image', 500000, 450000, 1),
(4, 1, 'Celeron 3.0 Ghz (FSB 533 Mhz) 347 Cache 512 KB (Tray)', 'image', 500000, 450000, 1),
(4, 1, 'Pentium 4 3.2 Ghz (FSB 800 Mhz) 541 Cache 1 MB (Tray)', 'image', 500000, 450000, 1),
(5, 1, 'Pentium G4400 (3.3 Ghz) Cache 8 MB (Tray)', 'image', 500000, 450000, 1),
(5, 1, 'Core i5 6400 (2.7 Ghz up to 3.3 Ghz) Cache 6 MB (Tray)', 'image', 500000, 450000, 1),
(6, 1, 'Celeron G530 2.4 Ghz Cache 2 MB (BOX)', 'image', 500000, 450000, 1),
(6, 1, 'Pentium G630 2.7 Ghz Cache 3 MB (Tray)', 'image', 500000, 450000, 1),
(7, 1, 'AMD Godavari A6-7480 (Radeon R5 Series) 3.7Ghz Cache 2x1MB 65W Socket FM2+ - AD7480ACABBOX', 'image', 500000, 450000, 1),
(7, 1, 'AMD Carrizo A8-7680 (Radeon R7 Series) 3.5Ghz Cache 2MB 45W Socket FM2+ - D7680ACABBOX - With 65W Quiet Cooler', 'image', 500000, 450000, 1),
(8, 1, 'AMD Bristol Ridge A6-9500 (Radeon R5 Series) 3.5Ghz Up To 3.8Ghz Cache 1MB 65W Socket AM4 [Box] - 3 Core - AD9500AGABBOX', 'image', 500000, 450000, 1),
(8, 1, 'AMD Bristol Ridge A8-9600 (Radeon R7 Series) 3.1Ghz Up To 3.4Ghz Cache 2MB 65W Socket AM4 [Box] - 4 Core - AD9600AGABBOX', 'image', 500000, 450000, 1),
(9, 1, 'AMD Ryzen 5 7600 3.8Ghz Up To 5.1Ghz Cache 32MB 65W AM5 [Box] - 6 Core - 100-000001015BOX - with Wraith Stealth Cooler', 'image', 500000, 450000, 1),
(9, 1, 'AMD Ryzen 7 7700X 4.5Ghz Up To 5.4Ghz Cache 32MB 105W AM5 [Box] - 8 Core - 100-100000591WOF', 'image', 500000, 450000, 1),
(10, 1, 'Seagate 3.5" 80 GB IDE', 'image', 500000, 450000, 1),
(10, 1, 'Seagate 3.5" 1 TB Sata3 Barracuda (Ready Stock)', 'image', 500000, 450000, 1),
(13, 1, 'ADATA DDR4 PC21300 2666MHz 4GB Single Channel AD4U26664G19-RGN', 'image', 50000, 40000, 1),
(13, 1, 'ADATA DDR4 PC25600 3200MHz 16GB Single Channel AD4U320016G22-SGN', 'image', 50000, 40000, 1),
(14, 1, 'Abkoncore Cronos 510S', 'image', 500000, 450000, 1),
(14, 1, 'ADATA XPG BATTLECRUISER - BLACK - SIDE TEMPERED GLASS - FREE 4 PCS ARGB FAN', 'image', 500000, 450000, 1),
(15, 1, 'ASRock Radeon RX 6400 4 GB 64 Bit DDR6 - Challenger ITX 4G', 'image', 500000, 450000, 1),
(15, 1, 'Asus GeForce GT 1030 2 GB 64 Bit DDR5', 'image', 500000, 450000, 1),
(15, 1, 'Inno 3D GeForce RTX 3060 Ti 8 GB 256 GB GDDR6 ICHILL X3-LHR', 'image', 500000, 450000, 1),
(16, 1, '1STPLAYER Gaming PSU DK5.0 500W - PS-500AX (80Plus Bronze) - 3 Years Warranty Replacement', 'image', 500000, 450000, 1),
(16, 1, 'Super Flower LEGION GX PRO 650W - SF- 650P14XE - 80 PLUS GOLD - Semi Modular - 5 Years', 'image', 500000, 450000, 1),
(17, 1, 'Logitech M100r Optical Mouse USB - Black ', 'image', 500000, 450000, 1),
(17, 1, 'Logitech M 325 Cordless Notebook Mouse ', 'image', 500000, 450000, 1),
(18, 1, 'A4Tech D - 500F', 'image', 500000, 450000, 1),
(18, 1, 'A4Tech N - 370FX', 'image', 500000, 450000, 1),
(19, 1, 'Corsair Gaming Scimitar RGB Elite (Black)', 'image', 500000, 450000, 1),
(20, 1, 'Logitech Keyboard K380 Bluetooth (Black / Blue) ', 'image', 500000, 450000, 1),
(20, 1, 'Logitech G715 TKL Wireless Mechanical Gaming Keyboard - Tactile', 'image', 500000, 450000, 1),
(21, 1, 'PC MCZ R.A.T.3 (All Colors) + G.L.I.D.E.9 Gaming Surface', 'image', 500000, 450000, 1),
(22, 1, 'Ace Power SSD A1 512GB SATA3', 'image', 500000, 450000, 1),
(22, 1, 'ADATA SSD SU650 M.2 2280 240GB SATA III ( R/W Up to 550 / 500MB/s ) ASU650NS38-240GT-C', 'image', 500000, 450000, 1),
(23, 1, 'Logitech G840 XL Gaming Mouse Pad - Pink 629.000', 'image', 500000, 450000, 1),
(24, 1, 'ACER 27" KG271 Frameless Gaming Monitor', 'image', 500000, 450000, 1),
(24, 1, 'MSI Optix G241VC 24" Curved Gaming Monitor', 'image', 500000, 450000, 1),
(25, 1, 'Deepcool LT520 A-RGB 240mm High-Performance Liquid CPU Cooler', 'image', 500000, 450000, 1),
(25, 1, 'Deepcool AS500 Plus A-RGB Strip LED With Fan 2x14cm Universal Socket - LGA1700 Support', 'image', 500000, 450000, 1),
(26, 1, 'XFX Hard Swap Fan Kit - BLUE LED x 2 Fan - MA-AP01-BLED (Only For RX 4 Series)', 'image', 500000, 450000, 1),
(27, 1, 'Orico L127SS 2.5 To 3.5 inch Hard Drive Caddy', 'image', 500000, 450000, 1),
(28, 1, 'Bafo PCI-Express To Firewire 2 Port 1394B', 'image', 500000, 450000, 1);






select sc.shopping_category_id, sc.shopping_category_name, c.category_id, c.category_name, suc.sub_category_id, suc.sub_category_name, it.item_id, it.item_name
from tbl_viraindo_shopping_category sc 
join tbl_viraindo_category c on sc.shopping_category_id = c.shopping_category_id
join tbl_viraindo_sub_category suc on suc.category_id = c.category_id
join tbl_viraindo_item it on it.sub_category_id = suc.sub_category_id;



SELECT TVI.item_id, TVI.item_name, TVI.item_new_price, TVI.item_picture FROM tbl_viraindo_item TVI 
        JOIN tbl_viraindo_sub_category TVSC ON TVI.sub_category_id = TVSC.sub_category_id
        JOIN tbl_viraindo_category TVC ON TVC.category_id = TVSC.category_id
        WHERE TVC.category_name = 'processor' AND TVI.item_name LIKE '%i3%';
        
        
SELECT sub_category_id, SUBSTRING_INDEX(sub_category_name, "Socket ", 1) as socket FROM tbl_viraindo_sub_category
                WHERE sub_category_name LIKE '%amd%' AND sub_category_name LIKE '%processor%' LIMIT 100;
                
                SELECT sub_category_id, SUBSTRING_INDEX(sub_category_name, "Socket ", -1) as socket FROM tbl_viraindo_sub_category
                WHERE sub_category_name LIKE '%amd%' AND sub_category_name LIKE '%processor%' LIMIT 100;
                
                
SELECT LOCATE("DDR", "MSI MAG Z690 Tomahawk WiFi DDR4 (LGA1700, Z690, DDR4, USB3.2, SATA3)") AS MatchPosition;

SELECT SUBSTR("MSI MAG Z690 Tomahawk WiFi DDR4 (LGA1700, Z690, DDR4, USB3.2, SATA3)", "28", 4) AS ExtractString;

SELECT TVI.item_name, TVI.item_new_price, TVI.item_old_price FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
        ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
        ON TVC.category_id = TVSC.category_id WHERE TVC.category_id = '31';


SELECT TVC.category_id, TVC.category_name, TVI.item_id, TVI.item_name FROM tbl_viraindo_item TVI JOIN tbl_viraindo_sub_category TVSC
        ON TVI.sub_category_id = TVSC.sub_category_id JOIN tbl_viraindo_category TVC
        ON TVC.category_id = TVSC.category_id WHERE TVC.category_id = '31';


TRUNCATE TABLE tbl_viraindo_item;

        
                