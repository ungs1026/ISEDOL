-- user
create table users (
	id int(11) not null auto_increment,
	username varchar(25) not null,
	firstName varchar(50) not null,
	lastName varchar(50) not null,
	email varchar(200) not null,
	password varchar(50) not null,
	signUpDate datetime default now(),
	profilePic varchar(500),
	admin_num int(4),
	primary key(id)
);

--artists
create table artists(
	id int not null auto_increment,
	name varchar(50) not null,
	primary key(id)
);

-- goods
CREATE TABLE goods (
	id int(11) not null AUTO_INCREMENT,
	name varchar(255) DEFAULT '',
	price int(11) DEFAULT 0,
	img varchar(255) DEFAULT '',
	detailImg varchar(255) default '',
	production varchar(255) DEFAULT null,
	sales int(20) default 0,
	kind varchar(50),
	PRIMARY KEY(id)
);

-- albums
create table albums (
	id int(11) not null auto_increment,
	title varchar(250) not null,
	artist int(11) not null,
	artworkPath varchar(250) not null,
	primary key(id),
	FOREIGN KEY (artist) REFERENCES artists(artist)
);

-- songs
create table songs (
	id int(11) not null auto_increment,
	title varchar(250) not null,
	artist int(11) not null,
	album int(11) not null,
	duration varchar(10) not null,
	path varchar(500) not null,
	albumOrder int(11) not null,
	songArt varchar(500) not null,
	plays int(11) not null,
	primary key(id),
	FOREIGN KEY (artist) REFERENCES artists(artist),
	FOREIGN KEY (album) REFERENCES albums(album)
);

-- group
create table groups (
	id int(11) not null auto_increment,
	name varchar(50) not null,
	thumbnail varchar(255) not null,
	date date not null,
	year varchar(20) not null,
	kind varchar(50) not null,
	youtube varchar(500) not null,
	primary key(id)
);