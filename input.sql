CREATE DATABASE test;
USE test;

CREATE TABLE hotel_rooms (
  `num` int(11) unsigned NOT NULL,
  `photo` VARCHAR(255) NOT NULL  DEFAULT '',
  `type` VARCHAR(255) not null DEFAULT '',
  `col_windows` int(11) unsigned NOT NULL DEFAULT 0,
  `price` DECIMAL(6, 2) NOT NULL DEFAULT 0.00,
  `descr` VARCHAR(255) NOT NULL DEFAULT '',
  UNIQUE KEY(`num`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE orders (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `num_room` int(11) unsigned NOT NULL,
  `date_order` date not NULL  DEFAULT '0000-00-00',
  FOREIGN KEY (num_room) REFERENCES hotel_rooms(num)
    ON UPDATE CASCADE ON DELETE CASCADE,
  UNIQUE KEY(num_room, date_order)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
