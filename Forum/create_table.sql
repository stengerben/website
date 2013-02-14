CREATE TABLE USERS (
	id		 int NOT NULL AUTO_INCREMENT,
	Username varchar(255) NOT NULL UNIQUE,
	Password varchar(255) NOT NULL,
	FullName varchar(255) NOT NULL,
	Status   int NOT NULL DEFAULT 0,
	ProfDesc varchar(255) DEFAULT "No Description Given",
	PRIMARY KEY(id, Username)
);

CREATE TABLE MAILBOX (
	MessageNo int NOT NULL AUTO_INCREMENT,
	DateTime  TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	Subject	  varchar(255),
	Text      blob,
	StatusMail int NOT NULL DEFAULT 0,
	SendUser  varchar(255) NOT NULL,
	RecUser	  varchar(255) NOT NULL,
	PRIMARY KEY (MessageNo),
	FOREIGN KEY (SendUSer) REFERENCES USERS(Username),
	FOREIGN KEY (RecUser) REFERENCES USERS(Username)
);

CREATE TABLE GROUPS (
	id		int	 NOT NULL AUTO_INCREMENT,
	GName	varchar(255) NOT NULL UNIQUE,
	ProfDesc varchar(255) DEFAULT "No Description Given",
	Owner 	varchar(255) NOT NULL,
	Status int NOT NULL DEFAULT 0,
	PRIMARY KEY (id, GName),
	FOREIGN KEY (Owner) REFERENCES USERS(Username)
);

CREATE TABLE GROUP_MEMBER (
	UserId	int DEFAULT 0 NOT NULL,
	GroupId	int DEFAULT 0 NOT NULL,
	Status	int DEFAULT 0 NOT NULL,
	PRIMARY KEY (UserId, GroupId),
	FOREIGN KEY (UserId) REFERENCES USERS(id),
	FOREIGN KEY (GroupId) REFERENCES GROUPS(id)
);

CREATE TABLE THREAD (
	Title varchar(255) NOT NULL,
	GName varchar(255) NOT NULL,
	StartingUser varchar(255) NOT NULL,
	DateTimeThread TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	PRIMARY KEY (Title),
	FOREIGN KEY (GName) REFERENCES GROUPS(Gname),
	FOREIGN KEY (StartingUser) REFERENCES USERS(Username)
);

CREATE TABLE POST (
	PostNo   int NOT NULL AUTO_INCREMENT,
	Text	 blob NOT NULL,
	DateTimePost TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	ThreadTitle varchar(255) NOT NULL,
	CreatingUser varchar(255) NOT NULL,
	PRIMARY KEY (PostNo),
	FOREIGN KEY (ThreadTitle) REFERENCES THREAD(Title),
	FOREIGN KEY (CreatingUser) REFERENCES USERS(Username)
);

INSERT INTO USERS (FullName, Username, Password, ProfDesc, Status) VALUES ('Benjamin Stenger', 'stengerb', '894955822', 'CPSC 431 Fall 2012 Term Project', 1);
