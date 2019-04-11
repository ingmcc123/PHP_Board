create table board (
    number int not null primary key auto_increment,
    title varchar(50) not null,
    content text not null,
    id varchar(20) not null,
    password varchar(20) not null,
    date datetime not null,
    hit int not null default 0
);

create table users (
    number int not null primary key auto_increment,
    id varchar(20) not null,
    password varchar(20) not null,
    date datetime not null
);

create table images (
    id int(10) not null primary key auto_increment,
    filename varchar(100) not null,
    imgurl varchar(512) not null,
    size int not null
);

drop table board;
drop table users;
drop table images;