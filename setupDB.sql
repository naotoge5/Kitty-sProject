drop database if exists kittydb;

create database kittydb;

use kittydb;

/*create user 'kitty' @'localhost' identified by 'pro02';*/
/*↓を使う*/
create user 'kitty'@'localhost' identified by 'pro02';

/*mysqlデフォルト認証方式がcaching_sha2_password,PHPのMySQL接続方式が未対応のため*/
grant all on kittydb.* to 'kitty'@'localhost';

/*権限の付与*/
/*
 grant all on pp11db.* to 'kitty'@'localhost' identified with mysql_native_password by 'password';
 MySQL5.7以降出来なくなった。
 */
create table companies (
    id int auto_increment primary key,
    name varchar (100) not null,
    tel varchar (100) not null,
    address varchar (100) not null,
    mail varchar (100) not null,
    password varchar (100) not null
);

create table objects (
    id int auto_increment primary key,
    name varchar (100) not null,
    details text,
    category varchar(100) not null,
    datetime datetime not null,
    company_id int not null
);