

CREATE TABLE `badge` (
  `badge_id` int(11) NOT NULL AUTO_INCREMENT,
  `badge_name` varchar(32) NOT NULL,
  `badge_misson` varchar(64) NOT NULL,
  `badge_reward` int(6) NOT NULL DEFAULT '0',
  `badge_grade` tinyint(2) NOT NULL DEFAULT '1',
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
  `parent_category_id` int(11) NOT NULL DEFAULT '0',
  `category_color` varchar(10) NOT NULL,
  `category_icon` varchar(32) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

INSERT INTO category VALUES("1","Meb Ders","0","#DE4C8A","fa fa-building-columns");
INSERT INTO category VALUES("2","Lise 1","1","#E4A010","fa fa-school");
INSERT INTO category VALUES("3","Lise 2","1","#1B5583","fa fa-building-columns");
INSERT INTO category VALUES("4","Lise 3","1","#287233","fa fa-pencil");
INSERT INTO category VALUES("5","Lise 4","1"," #00BB2D","fa fa-graduation-cap");
INSERT INTO category VALUES("6","Yüksek Okul","1","#2271B3","fa fa-infinity");
INSERT INTO category VALUES("7","Bt ve Yazılım","0","#781F19","fa fa-computer");
INSERT INTO category VALUES("8","Web Geliştirme","7","#D36E70","fa fa-spider-web");
INSERT INTO category VALUES("9","Oyun Geliştirme","7","#6C3B2A","fa fa-gamepad-modern");
INSERT INTO category VALUES("10","Uygulama Geliştirme","7","#909090","fa fa-code");
INSERT INTO category VALUES("11","Diğer","0","#C2B078","fa fa-clothes-hanger");
INSERT INTO category VALUES("12","Tasarım","0","#F54021","fa fa-brush");
INSERT INTO category VALUES("25","PHP","8","#787CB5","fa-brands fa-php");





CREATE TABLE `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message_content` text NOT NULL,
  `message_product_quatation_id` int(11) NOT NULL DEFAULT '0',
  `message_product_quat_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4;

INSERT INTO message VALUES("34","38","34","2022-08-30 00:48:56","knk naber","0","0");
INSERT INTO message VALUES("35","38","34","2022-08-30 00:55:29","selam naber","0","0");
INSERT INTO message VALUES("36","34","38","2022-08-30 01:08:26","iyiyim aga sen nasılsın","0","0");
INSERT INTO message VALUES("37","38","34","2022-08-30 01:08:40","ben de iyi öyle","0","0");
INSERT INTO message VALUES("38","34","38","2022-08-30 01:10:43","lan noluyo","0","0");
INSERT INTO message VALUES("39","38","34","2022-08-30 01:11:09","peki","0","0");
INSERT INTO message VALUES("40","34","38","2022-08-30 01:11:43","hey","0","0");
INSERT INTO message VALUES("41","38","34","2022-08-29 01:12:21","ben anlamıyorum ki noluyo olm","0","0");
INSERT INTO message VALUES("42","38","34","2022-08-30 01:13:36","şimdi olucak mı","0","0");
INSERT INTO message VALUES("43","38","34","2022-08-30 01:14:47","s","0","0");
INSERT INTO message VALUES("44","34","38","2022-08-30 01:14:54","aa","0","0");
INSERT INTO message VALUES("45","34","38","2022-08-30 01:14:57","bu da","0","0");
INSERT INTO message VALUES("46","34","38","2022-08-30 01:14:59","hyeyo","0","0");
INSERT INTO message VALUES("47","34","38","2022-08-30 01:15:03","noyo","0","0");
INSERT INTO message VALUES("48","38","34","2022-08-30 01:17:19","l","0","0");
INSERT INTO message VALUES("49","38","34","2022-08-30 02:20:46","merhaba","0","0");
INSERT INTO message VALUES("50","38","34","2022-08-30 02:25:13","zaman çalışıyo mu","0","0");
INSERT INTO message VALUES("51","38","34","2022-08-30 15:07:49","merhaba","0","0");
INSERT INTO message VALUES("52","34","38","2022-08-31 15:09:23","djaefouheaofoea","0","0");
INSERT INTO message VALUES("53","38","34","2022-09-06 14:53:21","naber","0","0");
INSERT INTO message VALUES("54","38","34","2022-09-06 14:59:23","lann","0","0");
INSERT INTO message VALUES("55","38","34","2022-09-06 15:02:12","caefea","0","0");
INSERT INTO message VALUES("56","38","34","2022-09-06 15:02:15","daf","0","0");
INSERT INTO message VALUES("57","38","34","2022-09-06 15:02:19","313131","0","0");
INSERT INTO message VALUES("58","38","34","2022-09-06 15:05:15","sfwef","0","0");
INSERT INTO message VALUES("59","38","34","2022-09-06 15:05:16","fq","0","0");
INSERT INTO message VALUES("60","38","34","2022-09-06 15:05:16","fq","0","0");
INSERT INTO message VALUES("61","38","34","2022-09-06 15:05:23","fqwfq","0","0");
INSERT INTO message VALUES("62","38","34","2022-09-06 15:05:24","ewq","0","0");
INSERT INTO message VALUES("63","38","34","2022-09-06 15:06:47","fawefae","0","0");
INSERT INTO message VALUES("64","38","34","2022-09-06 15:06:47","dawfaw","0","0");
INSERT INTO message VALUES("66","38","34","2022-09-06 16:43:41","d","0","0");
INSERT INTO message VALUES("67","38","34","2022-09-06 17:14:13","naber napıyosun","0","0");
INSERT INTO message VALUES("68","38","34","2022-09-06 17:15:53","dwadaw","0","0");
INSERT INTO message VALUES("71","38","34","2022-09-06 19:30:45","bura benim mesaj","11","12");
INSERT INTO message VALUES("72","38","34","2022-09-07 22:59:16","merhaba","0","0");
INSERT INTO message VALUES("73","34","38","2022-09-07 22:59:20","fafea","0","0");
INSERT INTO message VALUES("74","34","38","2022-09-07 22:59:33","faefa","0","0");
INSERT INTO message VALUES("75","38","34","2022-09-07 23:02:06","naber","11","12");
INSERT INTO message VALUES("76","38","49","2022-09-11 09:22:19","Selam knk","0","0");
INSERT INTO message VALUES("77","38","49","2022-09-11 09:22:25","Napıyon","0","0");





CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notification_content` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_readed` tinyint(1) NOT NULL DEFAULT '0',
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
  `product_state` tinyint(1) DEFAULT '1',
  `product_photo` varchar(64) NOT NULL DEFAULT 'img/product_default.jpg',
  `price_category_id` int(11) DEFAULT NULL,
  `product_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_type` enum('teach','learn') DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

INSERT INTO product VALUES("4","Ingilizce-9.sınıf","ben öğretebilirm","38","ingilizce","ingilizce","0","img/product_default.jpg","0","2022-08-19 05:32:52","teach","3");
INSERT INTO product VALUES("5","Ingilizce-9.sınıf","ben öğretebilirm","32","ingilizce","ingilizce","0","img/product_default.jpg","0","2022-08-19 05:32:52","learn","3");
INSERT INTO product VALUES("9","burasıtrade-denemesi","heyy buradası da meres","38","","","1","img/product_default.jpg","10","2022-08-20 04:42:35","","4");
INSERT INTO product VALUES("10","zeynepdenemesi","zeynep agam ya","34","","","1","img/product_default.jpg","2","2022-08-20 04:44:25","","8");
INSERT INTO product VALUES("11","adıbura","burası da açıklaması emri sitek atçak","34","","","1","img/product_default.jpg","3","2022-08-20 15:02:18","","9");
INSERT INTO product VALUES("13","basık","jhıpugh8ugp8ı","31","","","1","img/product_default.jpg","9","2022-08-20 18:52:40","","3");
INSERT INTO product VALUES("14","Bu benim Alan","dawfafefa","34","","","1","img/product_default.jpg","9","2022-09-07 23:03:12","","8");
INSERT INTO product VALUES("15","Edebiyat","Deneme","57","","","1","img/product_default.jpg","8","2022-09-11 08:54:46","","2");





CREATE TABLE `product_comment` (
  `product_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_comment_title` varchar(64) NOT NULL,
  `product_comment_content` text NOT NULL,
  `product_comment_starts` int(5) NOT NULL,
  `product_comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `product_order` (
  `product_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_first_id` int(11) NOT NULL,
  `product_second_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_schedule` int(5) NOT NULL,
  `order_status` enum('progress','cancel_first','finished','cancel_second') DEFAULT NULL,
  `started_date` datetime DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  PRIMARY KEY (`product_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

INSERT INTO product_order VALUES("22","12","10","2022-08-25 02:43:48","0","progress","0000-00-00 00:00:00","0000-00-00 00:00:00");





CREATE TABLE `product_request` (
  `product_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `requested_product_id` int(11) NOT NULL,
  `product_request_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_request_statu` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

INSERT INTO product_request VALUES("1","5","4","2022-08-18 02:20:48","1");
INSERT INTO product_request VALUES("2","6","4","2022-08-18 02:20:52","1");
INSERT INTO product_request VALUES("3","6","5","2022-08-19 14:33:03","0");
INSERT INTO product_request VALUES("6","10","9","2022-08-20 12:14:14","1");
INSERT INTO product_request VALUES("7","9","10","2022-08-20 12:17:32","1");
INSERT INTO product_request VALUES("8","10","4","2022-08-20 12:20:38","1");
INSERT INTO product_request VALUES("10","9","11","2022-08-20 15:03:23","1");
INSERT INTO product_request VALUES("11","13","12","2022-08-20 18:53:02","1");
INSERT INTO product_request VALUES("13","10","12","2022-08-25 00:33:29","1");
INSERT INTO product_request VALUES("17","12","11","2022-09-06 19:30:45","0");
INSERT INTO product_request VALUES("18","12","11","2022-09-07 23:02:06","0");
INSERT INTO product_request VALUES("19","4","15","2022-09-11 09:21:40","0");





CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_biography` text,
  `user_interests` varchar(250) NOT NULL,
  `user_city` varchar(64) DEFAULT NULL,
  `user_school` varchar(64) DEFAULT NULL,
  `user_class` tinyint(2) DEFAULT NULL,
  `user_level` tinyint(3) NOT NULL DEFAULT '0',
  `user_level_xp` tinyint(3) NOT NULL DEFAULT '0',
  `user_profile_photo` varchar(64) NOT NULL DEFAULT 'img/default_photo.jpg',
  `user_profile_banner` varchar(32) NOT NULL DEFAULT 'img/default_banner.jpg',
  `user_last_online` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_is_active` tinyint(1) NOT NULL DEFAULT '0',
  `user_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permissin` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

INSERT INTO user VALUES("38","emir_tolluoglu","Emir Tolluoğlu","emirtolluoglu@gmail.com","$2y$10$oUhTQey/LOSuGI7q1f.kPuuP.uJ6/l9K/fFTqTIlY.u0s.2zsCQb.","Merhaba benim adım Emir Tolluoğlu.","","Türkiye, istanbul","Haydarpaşa Lisesi","10","5","77","img/profile.jpg","img/default_banner.jpg","2022-08-14 16:25:36","0","2022-08-12 01:35:57","2");
INSERT INTO user VALUES("49","kaan-ege-esen","Kaan Ege","kaanegeesen@gmail.com","kaan123456","Ben kaanım.","","Türkiye, istanbul","Haydarpaşa Lisesi","10","11","99","img/default_photo.jpg","img/default_banner.jpg","2022-09-10 21:34:21","0","2022-09-10 21:34:21","2");
INSERT INTO user VALUES("51","Emir","Emir","arduinomerkez44@gmail.com","$2y$10$C12SS3AcMOJb3tlQ3Jl66eAJqi8x3j/A/lRgze1lFztv.wQ1RQLf2","Merhaba benim adım Emir.","","Türkiye, istanbul","Malatya Erman Ilıcak Fen Lisesi","127","0","0","img/default_photo.jpg","img/default_banner.jpg","2022-09-10 18:42:53","0","2022-09-10 18:42:53","0");
INSERT INTO user VALUES("52","Meyra Öztürk","Meyra-ozturk","meyrozt@gmail.com","$2y$10$3Ww.2MQyiLZowq/O5KS71e5BfHHM/iRhkfOn2ASa8QVwNzJzurkUe","Merhaba benim adım Meyra Öztürk.","","Türkiye, istanbul","Haydarpaşa Lisesi","127","0","0","img/default_photo.jpg","img/default_banner.jpg","2022-09-10 19:00:42","0","2022-09-10 19:00:42","2");
INSERT INTO user VALUES("53","manstein","Manstein ","haksimtimefor4@gmail.com","$2y$10$KleOWrOcw0Y.bXOVS5Ry9Oj6ENRRCFOUsy.BDehh5VFBlTrHLKlhy","Merhaba benim adım manstein.","","","Haydarpaşa Lisesi ","127","0","0","img/default_photo.jpg","img/default_banner.jpg","2022-09-11 06:12:56","0","2022-09-11 06:12:56","0");
INSERT INTO user VALUES("54","huseyin","Hüseyin ","h.korkmaz.23@haydarpasa.k12.tr","$2y$10$4phhA1pXpN9l2ywiLAAEa.witoFNRyg26Ux8bRpWK6tatbrjZBcPu","Merhaba benim adım huseyin.","","","Haydarpaşa Lisesi ","127","0","0","img/default_photo.jpg","img/default_banner.jpg","2022-09-11 06:14:37","0","2022-09-11 06:14:37","2");
INSERT INTO user VALUES("55","burak-gumrah","Burak Gümrah","burak@gumrah.net","$2y$10$YlzJ78Kd7zd3f/8aTTTeAuWqjwXlB2vn8MQf9zbJ1zaNzJ.jPiv.K","Merhaba benim adım burak-gumrah.","","","Haydarpaşa Lisesi","127","0","0","img/default_photo.jpg","img/default_banner.jpg","2022-09-11 06:41:57","0","2022-09-11 06:41:57","2");
INSERT INTO user VALUES("56","esra","Esra","esrayagisan04@gmail.com","$2y$10$Rd86YMh.xPHaHU0z1b1i2OICUBxtERNz9Z4nXgPltIqpCsuH7wOV2","Merhaba benim adım esra.","","","Haydarpaşa Lisesi","12","0","0","img/default_photo.jpg","img/default_banner.jpg","2022-09-11 07:36:10","0","2022-09-11 07:36:10","2");
INSERT INTO user VALUES("57","yigit-dikkulak","Yiğit Dikkulak ","yigitdikkulak@gmail.com","$2y$10$cvUcCEMt9w3mTgqQMr8/9uAVXELtuGGm74Lrb36tPdJxICKPnw/w2","Merhaba ben yigit","","","Haydarpaşa Lisesi ","127","0","0","img/default_photo.jpg","img/default_banner.jpg","2022-09-11 08:51:37","0","2022-09-11 08:51:37","2");





CREATE TABLE `user_badge` (
  `user_badge_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `badge_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `user_follow_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `user_friend` (
  `user_friend_id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_first_id` int(11) NOT NULL,
  `friend_second_id` int(11) NOT NULL,
  `friend_status` enum('pending_first_second','pending_second_first','friends','block_first_second','block_second_first','lock_both') NOT NULL,
  `friend_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `friend_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

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
INSERT INTO user_interests VALUES("14","57","Fen");



