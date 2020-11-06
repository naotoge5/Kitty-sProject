drop database if exists kittydb;
create database kittydb;
use kittydb;
/*↓を使う*/
create user 'kitty'@'localhost' identified by 'pro02';
/*mysql8.0~*/
/*create user 'kitty'@'localhost' identified with mysql_native_password by 'pro02';*/

/*権限の付与*/
grant all on kittydb.* to 'kitty'@'localhost';
create table companies
(
    id             int auto_increment primary key,
    name           varchar(100) not null,
    tel            int          not null,
    postal         varchar(100) not null,
    address_first  varchar(100) not null,
    address_second varchar(100) not null,
    address_third  varchar(100) not null,
    mail           varchar(100) not null,
    password       varchar(100) not null
);

create table objects
(
    id         int auto_increment primary key,
    name       varchar(100) not null,
    details    text,
    category   varchar(100) not null,
    datetime   datetime     not null,
    company_id int          not null
);
insert into companies
values (null, '京都コンピュータ学院 京都駅前校', 0120123456, '6018407', '京都府', '京都市南区', '西九条寺ノ前町10-5', '10naotoge5.ykputi@gmail.com',
        '$2y$10$CstYoew/bQ0z7Yjb6T1wh.Z3wfynIEbQ5eySdwN8kyYaekPjfDSxC');
insert into companies
values (null, '京都情報大学院大学 百万遍キャンパス', 0120789111, '6068225', '京都府', '京都市左京区', '田中門前町7', 'st071959@m03.kyoto-kcg.ac.jp',
        '$2y$10$CScjAAj9Cg4DspqQ1MubOe3t6bmy53TaN1GsrWaSahde/a9c4HTEa');

insert into objects
values (null, 'レインコート', '駐車場', '雨具', '2020-11-20 13:00:00', 2);
insert into objects
values (null, '傘', '駐車場', '雨具', '2020-11-20 14:00:00', 2);
insert into objects
values (null, '財布', '駐車場', '貴重品', '2020-11-20 15:00:00', 2);
insert into objects
values (null, 'シャープペン', '駐車場', '筆記用具', '2020-11-21 16:00:00', 2);