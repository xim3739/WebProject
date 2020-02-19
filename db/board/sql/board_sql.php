<?php

create table board(
	num int not null auto_increment,
    id char(20) not null,
    name char(20) not null,
    subject char(20) not null,
    content text not null,
    regist_day char(30) not null,
    hit int not null,
    file_name char(25),
    file_type char(25),
    file_copied char(25),
    location char(254),
    primary key(num)
);

CREATE TABLE qna (
    num int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    group_num int UNSIGNED NOT NULL,
    depth int UNSIGNED NOT NULL,
    ord int UNSIGNED NOT NULL,
    id char(15) NOT NULL,
    name char(10) NOT NULL,
    subject varchar(100) NOT NULL,
    content text NOT NULL,
    regist_day char(20) DEFAULT NULL,
    PRIMARY KEY (`num`)
);

?>
