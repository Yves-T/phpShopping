/*
 Navicat SQLite Data Transfer

 Source Server         : shopping
 Source Server Version : 3008004
 Source Database       : main

 Target Server Version : 3008004
 File Encoding         : utf-8

 Date: 12/09/2015 05:26:18 AM
*/

PRAGMA foreign_keys = false;

-- ----------------------------
--  Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS "product";
CREATE TABLE product (
  id integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  name char(256),
  description text(60000),
  image char(128),
  category char(128),
  price float(128)
);
INSERT INTO "main".sqlite_sequence (name, seq) VALUES ("product", '17');

-- ----------------------------
--  Records of product
-- ----------------------------
BEGIN;
INSERT INTO "product" VALUES (1, 'IPhone 6s', 'iPhone 6s 64 GB Space Gray', '', 'gsm', 849.5);
INSERT INTO "product" VALUES (2, 'Galaxy JS', ' Galaxy J5 Zwart', null, 'gsm', 199.0);
INSERT INTO "product" VALUES (3, 'Moto E', 'Moto E 4G (2015) Zwart', null, 'gsm', 138.0);
INSERT INTO "product" VALUES (4, 'Galaxy Js', 'Galaxy J5 Goud', null, 'gsm', 199.99);
INSERT INTO "product" VALUES (5, 'iPhone 6', 'iPhone 6 16 GB Silver', null, 'gsm', 629.0);
INSERT INTO "product" VALUES (6, 'iPad mini', 'Apple iPad Mini 2 Wifi 16 GB Silver', null, 'tablet', 279.0);
INSERT INTO "product" VALUES (7, 'Galaxy tab A', 'Galaxy Tab A 9.7 Wifi Zwart', null, 'tablet', 249.0);
INSERT INTO "product" VALUES (8, 'iPad Air 2 wifi', 'iPad Air 2 Wifi + 4G 64 GB Space Gray', null, 'tablet', 699.0);
INSERT INTO "product" VALUES (9, 'Galaxy tab A9', 'Galaxy Tab A 9.7 Wifi Wit', null, 'tablet', 249.0);
COMMIT;

PRAGMA foreign_keys = true;
