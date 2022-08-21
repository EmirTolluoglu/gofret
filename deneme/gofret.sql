CREATE TABLE `badge` (
  `badge_id` int(11) NOT NULL AUTO_INCREMENT,
  `badge_name` varchar(32) NOT NULL,
  `badge_misson` varchar(64) NOT NULL,
  `badge_reward` int(6) NOT NULL DEFAULT 0,
  `badge_grade` tinyint(2) NOT NULL DEFAULT 1,
  `badge_color` varchar(16) NOT NULL DEFAULT '''000''',
  `badge_pic` varchar(64) NOT NULL,
  PRIMARY KEY (`badge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO badge VALUES("1","Kayıt Ol","Kayıt Ol","20","1","0ff","compass");
INSERT INTO badge VALUES("2","deneme","Kayıt Ol","20","1","0ff","atom");
INSERT INTO badge VALUES("3","deneme2","Kayıt Ol","20","1","0f5","compass");
INSERT INTO badge VALUES("4","deneme2","Kayıt Ol","20","1","091e5c","angry");


CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(32) NOT NULL,
  `parent_category_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

INSERT INTO category VALUES("1","Akademik Ders","0");
INSERT INTO category VALUES("2","Lise 1","1");
INSERT INTO category VALUES("3","Lise 2","1");
INSERT INTO category VALUES("4","Lise 3","1");
INSERT INTO category VALUES("5","Lise 4","1");
INSERT INTO category VALUES("6","Yüksek Okul","1");
INSERT INTO category VALUES("7","Bt ve Yazılım","0");
INSERT INTO category VALUES("8","Web Geliştirme","7");
INSERT INTO category VALUES("9","Oyun Geliştirme","7");
INSERT INTO category VALUES("10","Uygulama Geliştirme","7");
INSERT INTO category VALUES("11","Diğer","0");
INSERT INTO category VALUES("12","Tasarım","0");


CREATE TABLE `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `is_readed` tinyint(1) NOT NULL DEFAULT 0,
  `message_date` datetime NOT NULL DEFAULT current_timestamp(),
  `message_quotation_id` int(11) NOT NULL DEFAULT 0,
  `message_content` text NOT NULL,
  `message_product_quatation_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

INSERT INTO message VALUES("1","38","45","0","2022-08-16 15:26:02","0","lanolm","0");
INSERT INTO message VALUES("3","38","45","0","2022-08-16 15:31:17","0","dene 2d irbu?","0");
INSERT INTO message VALUES("5","45","38","0","2022-08-16 15:31:41","0","dene 2d irbu?","0");
INSERT INTO message VALUES("6","38","45","0","2022-08-16 15:32:03","0","evet bu da son atılan","0");
INSERT INTO message VALUES("7","34","32","0","2022-08-16 17:01:47","0","Heyoo Zeynep","0");
INSERT INTO message VALUES("13","38","38","0","2022-08-16 20:44:51","0","deneme","0");
INSERT INTO message VALUES("14","38","38","0","2022-08-16 20:47:05","0","heyo","0");
INSERT INTO message VALUES("15","38","38","0","2022-08-16 20:48:22","0","lan olm","0");
INSERT INTO message VALUES("16","38","38","0","2022-08-16 20:52:33","0","dededed","0");
INSERT INTO message VALUES("17","38","38","0","2022-08-16 21:28:57","0","mnfeğ","0");
INSERT INTO message VALUES("18","38","38","0","2022-08-18 22:41:46","0","heyy","0");
INSERT INTO message VALUES("19","38","38","0","2022-08-18 22:42:02","0","Nasılsın","0");
INSERT INTO message VALUES("20","38","38","0","2022-08-18 22:42:07","0","Cevap ver","0");
INSERT INTO message VALUES("21","38","38","0","2022-08-18 22:56:54","0","heyo","0");
INSERT INTO message VALUES("22","38","38","0","2022-08-18 22:59:15","0","dafwa","0");
INSERT INTO message VALUES("23","38","38","0","2022-08-18 23:01:10","0","lannn","0");
INSERT INTO message VALUES("24","38","38","0","2022-08-18 23:07:53","0","heyy","0");
INSERT INTO message VALUES("25","38","38","0","2022-08-18 23:09:40","0","lan","0");
INSERT INTO message VALUES("26","38","38","0","2022-08-19 02:54:11","0","burak naber","1");
INSERT INTO message VALUES("27","38","38","0","2022-08-19 02:54:43","0","HEYY BURAK","0");
INSERT INTO message VALUES("28","38","31","0","2022-08-19 03:06:13","0","cakma emir","0");
INSERT INTO message VALUES("29","38","31","0","2022-08-19 03:06:17","0","naber","0");
INSERT INTO message VALUES("30","38","32","0","2022-08-19 03:54:58","0","lan","0");
INSERT INTO message VALUES("31","38","38","0","2022-08-19 04:48:07","0","hyyyy","0");
INSERT INTO message VALUES("32","38","32","0","2022-08-19 14:01:42","0","yiğit naber","0");
INSERT INTO message VALUES("33","38","38","0","2022-08-20 13:02:57","0","fafadawfaw","0");


CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_date` datetime NOT NULL DEFAULT current_timestamp(),
  `notification_content` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_readed` tinyint(1) NOT NULL DEFAULT 0,
  `notification_profile_photo` varchar(32) NOT NULL DEFAULT 'img/default_photo.jpg',
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO notification VALUES("1","2022-08-20 17:38:22","Aramıza Hoşgeldin","38","0","img/default_photo.jpg");



CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(32) NOT NULL,
  `product_content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_seourl` varchar(250) DEFAULT NULL,
  `product_keywords` varchar(250) DEFAULT NULL,
  `product_state` tinyint(1) DEFAULT 1,
  `product_photo` varchar(64) NOT NULL DEFAULT 'img/product_default.jpg',
  `price_category_id` int(11) DEFAULT NULL,
  `product_time` datetime NOT NULL DEFAULT current_timestamp(),
  `product_type` enum('teach','learn') DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO product VALUES("4","Ingilizce-9.sınıf","ben öğretebilirm","38","ingilizce","ingilizce","0","img/product_default.jpg","0","2022-08-19 05:32:52","teach","3");
INSERT INTO product VALUES("5","Ingilizce-9.sınıf","ben öğretebilirm","32","ingilizce","ingilizce","0","img/product_default.jpg","0","2022-08-19 05:32:52","learn","3");
INSERT INTO product VALUES("6","bu-bir-denmee","merhabalan naber","32","hrgg","erger","0","img/product_default.jpg","0","2022-08-19 14:31:28","learn","7");
INSERT INTO product VALUES("9","burasıtrade-denemesi","heyy buradası da meres","38","","","1","img/product_default.jpg","10","2022-08-20 04:42:35","","4");
INSERT INTO product VALUES("10","zeynepdenemesi","zeynep agam ya","34","","","1","img/product_default.jpg","2","2022-08-20 04:44:25","","8");
INSERT INTO product VALUES("11","adıbura","burası da açıklaması emri sitek atçak","34","","","1","img/product_default.jpg","3","2022-08-20 15:02:18","","9");
INSERT INTO product VALUES("12","önlkhoh","kjoıhğıhğoyyğop","38","","","1","img/product_default.jpg","9","2022-08-20 18:49:51","","8");
INSERT INTO product VALUES("13","basık","jhıpugh8ugp8ı","31","","","1","img/product_default.jpg","9","2022-08-20 18:52:40","","3");



CREATE TABLE `product_comment` (
  `product_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_comment_title` varchar(64) NOT NULL,
  `product_comment_content` text NOT NULL,
  `product_comment_starts` int(5) NOT NULL,
  `product_comment_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`product_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `product_order` (
  `product_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_first_id` int(11) NOT NULL,
  `product_second_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_schedule` int(5) NOT NULL,
  `order_status` enum('progress','cancel_first','finished','cancel_second') DEFAULT NULL,
  `started_date` datetime DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  PRIMARY KEY (`product_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

INSERT INTO product_order VALUES("8","4","6","2022-08-20 00:28:12","0","finished","","");
INSERT INTO product_order VALUES("12","9","10","2022-08-20 12:19:52","0","finished","","");
INSERT INTO product_order VALUES("13","4","10","2022-08-20 12:47:56","0","finished","","");
INSERT INTO product_order VALUES("14","9","11","2022-08-20 16:12:49","0","progress","","");
INSERT INTO product_order VALUES("15","12","12","2022-08-20 18:56:03","0","progress","","");


CREATE TABLE `product_request` (
  `product_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `requested_product_id` int(11) NOT NULL,
  `product_request_time` datetime NOT NULL DEFAULT current_timestamp(),
  `product_request_statu` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`product_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO product_request VALUES("1","5","4","2022-08-18 02:20:48","1");
INSERT INTO product_request VALUES("2","6","4","2022-08-18 02:20:52","1");
INSERT INTO product_request VALUES("3","6","5","2022-08-19 14:33:03","0");
INSERT INTO product_request VALUES("6","10","9","2022-08-20 12:14:14","1");
INSERT INTO product_request VALUES("7","9","10","2022-08-20 12:17:32","1");
INSERT INTO product_request VALUES("8","10","4","2022-08-20 12:20:38","1");
INSERT INTO product_request VALUES("10","9","11","2022-08-20 15:03:23","1");
INSERT INTO product_request VALUES("11","13","12","2022-08-20 18:53:02","1");



CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_biography` text DEFAULT NULL,
  `user_interests` varchar(250) NOT NULL,
  `user_city` varchar(64) DEFAULT NULL,
  `user_school` varchar(64) DEFAULT NULL,
  `user_class` tinyint(2) DEFAULT NULL,
  `user_level` tinyint(3) NOT NULL DEFAULT 0,
  `user_level_xp` tinyint(3) NOT NULL DEFAULT 0,
  `user_profile_photo` varchar(64) NOT NULL DEFAULT 'img/default_photo.jpg',
  `user_profile_banner` varchar(32) NOT NULL DEFAULT 'img/default_banner.jpg',
  `user_last_online` datetime NOT NULL DEFAULT current_timestamp(),
  `user_is_active` tinyint(1) NOT NULL DEFAULT 0,
  `user_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

INSERT INTO user VALUES("29","burak_gumrah","burakgumrah@gmail.com","$2y$10$cNTpsZADP.OBIK2WW2CWluK7T9yYgbDxj/3.cOIhbQ7EF6xE/hpXa","Merhaba benim adım Burak Gümrah.","","Türkiye/İstanbul","Haydarpaşa Lisesi","12","3","56","img\\pp1.jpg","img/default_banner.jpg","2022-08-14 16:25:36","0","2022-08-10 21:50:18");
INSERT INTO user VALUES("31","emir_tolluoglu_1","emirtolluoglu34@gmail.com","$2y$10$kLW7/OHJv.9WsRlMFgOZkeoqy3uMlW68Y5jmo4Tl4.7ycfi1kIC6S","Merhaba benim adım Emir Tolluoğlu.","","Türkiye/İstanbul","Haydarpaşa Lisesi","10","2","71","img\\profile.jpg","img/default_banner.jpg","2022-08-14 16:25:36","0","2022-08-10 22:57:07");
INSERT INTO user VALUES("32","yigit_dikkulak","yigitdikkulak@gmail.com","$2y$10$0VvchBTCXa7nTFaV3JkD6e1vn8P6vDyq0ZSU/nLTyu2tljghfko6e","Merhaba benim adım Yiğit Dikkulak.","","Türkiye/İstanbul","Haydarpaşa Lisesi","9","2","78","img/pp2.jpg","img/default_banner.jpg","2022-08-14 16:25:36","0","2022-08-10 23:05:54");
INSERT INTO user VALUES("34","zeynep_ersen","zeynep@gmail.com","$2y$10$IL3CSZdqnNYrSS92oISzhu7QrJNH3ub8Y8kEZMdlj1P37ei9lTaSe","Merhaba benim adım Zeynep Erşen.","","Türkiye/İstanbul","Haydarpaşa Lisesi","12","6","34","img/default.jpg","img/default_banner.jpg","2022-08-14 16:25:36","0","2022-08-11 10:03:17");
INSERT INTO user VALUES("38","emir_tolluoglu","emirtolluoglu@gmail.com","$2y$10$oUhTQey/LOSuGI7q1f.kPuuP.uJ6/l9K/fFTqTIlY.u0s.2zsCQb.","Merhaba benim adım Emir Tolluoğlu.","","Türkiye/İstanbul","Haydarpaşa Lisesi","10","5","77","img/profile.jpg","img/default_banner.jpg","2022-08-14 16:25:36","0","2022-08-12 01:35:57");
INSERT INTO user VALUES("45","huseyin_korkmaz","huso.korkmaz57@gmail.com","$2y$10$QTnPnI33jrnxRXDtlA8dYeek6hLTlkasZkM.k4dcP4.xSeuHVu3oO","Merhaba benim adım Hüseyin Korkmaz.","","Türkiye/İstanbul","Haydarpaşa Lisesi","12","1","86","img/default.jpg","img/default_banner.jpg","2022-08-14 16:25:36","0","2022-08-11 11:20:22");




CREATE TABLE `user_badge` (
  `user_badge_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `badge_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_badge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO user_badge VALUES("9","38","1","2022-08-12 04:02:35");
INSERT INTO user_badge VALUES("10","38","2","2022-08-12 04:02:35");
INSERT INTO user_badge VALUES("11","38","3","2022-08-12 04:02:35");
INSERT INTO user_badge VALUES("12","38","4","2022-08-12 04:02:35");



CREATE TABLE `user_follow` (
  `user_follow_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follow_user_id` int(11) NOT NULL,
  `user_follow_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `user_friend` (
  `user_friend_id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_first_id` int(11) NOT NULL,
  `friend_second_id` int(11) NOT NULL,
  `friend_status` enum('pending_first_second','pending_second_first','friends','block_first_second','block_second_first','lock_both') NOT NULL,
  `friend_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_friend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO user_friend VALUES("1","38","34","friends","2022-08-16 02:37:45");
INSERT INTO user_friend VALUES("2","38","32","friends","2022-08-16 02:52:03");
INSERT INTO user_friend VALUES("3","45","38","friends","2022-08-16 02:52:46");
INSERT INTO user_friend VALUES("4","38","29","pending_first_second","2022-08-16 03:10:49");
INSERT INTO user_friend VALUES("6","45","34","friends","2022-08-16 02:37:45");
INSERT INTO user_friend VALUES("7","45","31","friends","2022-08-18 18:55:36");


CREATE TABLE `user_friend3` (
  `friend_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_user_id` int(11) NOT NULL,
  `friend_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`friend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO user_friend3 VALUES("1","38","29","2022-08-18 02:50:54");
INSERT INTO user_friend3 VALUES("2","29","38","2022-08-18 02:50:54");
INSERT INTO user_friend3 VALUES("5","38","45","2022-08-18 02:50:54");
INSERT INTO user_friend3 VALUES("6","45","38","2022-08-18 03:26:37");
INSERT INTO user_friend3 VALUES("7","38","34","2022-08-18 03:26:37");


CREATE TABLE `user_interests` (
  `user_interests_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_interests_value` varchar(16) NOT NULL,
  PRIMARY KEY (`user_interests_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO user_interests VALUES("1","32","cu");
INSERT INTO user_interests VALUES("2","32","ab");
INSERT INTO user_interests VALUES("3","32","as");
INSERT INTO user_interests VALUES("7","32","emir");
INSERT INTO user_interests VALUES("8","32","yiğit");
INSERT INTO user_interests VALUES("9","38","Müzik");
INSERT INTO user_interests VALUES("10","38","selam");
INSERT INTO user_interests VALUES("11","38","r4wr3");
INSERT INTO user_interests VALUES("12","38","swdawd");
INSERT INTO user_interests VALUES("13","34","müzik");



