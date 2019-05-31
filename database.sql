create database logo;

use logo;

create table category(
id int primary key auto_increment,
name varchar(50) not null
);

create table tag(
id int primary key auto_increment,
name varchar(50) not null
);

create table company(
id int primary key auto_increment,
name varchar(50) not null
);

create table logo(
id int primary key auto_increment,
description varchar(50),
logo_image mediumblob not null,
id_category int not null,
constraint fk_category foreign key (id_category) references  category(id)
);

create table logo_tags(
id int primary key auto_increment,
id_logo int,
id_tag int,
constraint fk_logo foreign key (id_logo) references  logo(id),
constraint fk_tag foreign key (id_tag) references  tag(id)
);

insert into category(name) values('Food');
insert into category(name) values('Automobile');
insert into category(name) values('Clothes');
insert into category(name) values('Technology');
insert into category(name) values('Social');
	

insert into tag(name) values('#famous');
insert into tag(name) values('#cheap');
insert into tag(name) values('#expensive');
insert into tag(name) values('#delicious');
insert into tag(name) values('#rich');
insert into tag(name) values('#classic');
insert into tag(name) values('#modern');
insert into tag(name) values('#tashkent');

insert into company(name) values('KFC');
insert into company(name) values('GM');
insert into company(name) values('D&G');
insert into company(name) values('TUIT');
insert into company(name) values('IUT');
insert into company(name) values('Acer');
insert into company(name) values('hp');