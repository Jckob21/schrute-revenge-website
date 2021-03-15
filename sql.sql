CREATE TABLE comments (
	cid int not null AUTO_INCREMENT PRIMARY KEY,
	uid varchar(128),
	date datetime not null,
	message TEXT not null);