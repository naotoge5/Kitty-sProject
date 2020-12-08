drop database if exists kittydb;
create database kittydb;

use kittydb;
/*↓を使う*/
create user 'kitty'@'localhost' identified by 'pro02';
/*mysql8.0~*/
/*create user 'kitty'@'localhost' identified with mysql_native_password by 'pro02';*/

/*権限の付drop database if exists kittydb;
create database kittydb;
与*/
grant all on kittydb.* to 'kitty'@'localhost';
create table companies
(
    id            int auto_increment primary key,
    name          varchar(100) not null,
    tel           varchar(100) null,
    postal        varchar(100) not null,
    prefecture    varchar(100) not null,
    city          varchar(100) not null,
    town          varchar(100) not null,
    details       text,
    mail          varchar(100) not null,
    password      varchar(100) not null,
    object_update datetime
);

create table objects
(
    id         int auto_increment primary key,
    name       varchar(100) not null,
    details    text,
    category   varchar(100) not null,
    datetime   datetime,
    company_id int          not null
);

create table pre_companies
(
    id       int auto_increment primary key,
    token    varchar(128) not null,
    mail     varchar(100) not null,
    datetime datetime     not null
);

insert into companies
values (null, '京都コンピュータ学院 京都駅前校', '0120-123-456', '601-8407', '京都府', '京都市南区', '西九条寺ノ前町10-5', '電話対応受付時間9:00-22:00',
        '10naotoge5.ykputi@gmail.com',
        '$2y$10$CstYoew/bQ0z7Yjb6T1wh.Z3wfynIEbQ5eySdwN8kyYaekPjfDSxC', null);
insert into companies
values (null, '京都情報大学院大学 百万遍キャンパス', '012-078-9111', '606-8225', '京都府', '京都市左京区', '田中門前町7', null,
        'st071959@m03.kyoto-kcg.ac.jp',
        '$2y$10$CScjAAj9Cg4DspqQ1MubOe3t6bmy53TaN1GsrWaSahde/a9c4HTEa', null);
insert into objects
values (null, 'レインコート', '駐車場', '雨具類', '2020-11-20 13:00:00', 2);
insert into objects
values (null, '傘', '駐車場', '雨具類', '2020-11-20 14:00:00', 1);
insert into objects
values (null, '折り畳み傘', '駐車場', '雨具類', '2020-11-20 14:00:00', 2);
insert into objects
values (null, '折り畳み傘', '駐車場', '雨具類', '2020-11-20 14:00:00', 1);
insert into objects
values (null, '鉛筆', '駐車場', '手帳・文具類', '2020-11-20 14:00:00', 3);
insert into objects
values (null, '財布', '駐車場', '財布類', '2020-11-20 15:00:00', 2);
insert into objects
values (null, 'シャープペン', '駐車場', '手帳・文具類', '2020-11-21 16:00:00', 2);