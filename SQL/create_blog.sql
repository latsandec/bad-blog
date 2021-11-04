drop table User;
drop table Birthday_Age;
drop table VIP;
drop table SecurityInfo_Of;
drop table Admin_Monitor;
drop table Community;
drop table Topic;
drop table About;

drop table Subscribe;
drop table CID_DATETIME_Title;
drop table UID_CID_DATETIME;
drop table BID;
drop table Comment_Create_Follows;

CREATE TABLE User(
    userID INTEGER,
    userName CHAR(250) NOT NULL,
    birthday CHAR(8),
    userPassword CHAR(250) NOT NULL,
    ban_status INTEGER NOT NULL,
    PRIMARY KEY(userID)
);

CREATE TABLE Birthday_Age(
    birthday CHAR(8),
    age INTEGER,
    PRIMARY KEY(birthday)
);

CREATE TABLE VIP(
    vipID INTEGER,
    vip_level INTEGER NOT NULL,
    preferred_color CHAR(250),
    PRIMARY KEY(vipID),
    FOREIGN KEY(vipID) REFERENCES User(userID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE SecurityInfo_Of(
    userID INTEGER,
    email CHAR(250),
    security_question CHAR(250) NOT NULL,
    answer CHAR(250) NOT NULL,
    PRIMARY KEY(email),
    FOREIGN KEY(userID) REFERENCES User(userID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Admin_Monitor(
    adminID INTEGER,
    avatar CHAR(10) NOT NULL,
    adminPassword CHAR(250) NOT NULL,
    communityID INTEGER NOT NULL,
    PRIMARY KEY(adminID),
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Ban(
    userID INTEGER,
    adminID INTEGER,
    PRIMARY KEY(userID,adminID),
    FOREIGN KEY(userID) REFERENCES User(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(adminID) REFERENCES Admin_Monitor(adminID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Community(
    communityID INTEGER,
    community_level INTEGER NOT NULL,
    PRIMARY KEY(communityID)
);

CREATE TABLE Topic(
    topic_name CHAR(250),
    PRIMARY KEY(topic_name)
);

CREATE TABLE About(
    communityID INTEGER,
    topic_name CHAR(250),
    PRIMARY KEY(communityID,topic_name),
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(topic_name) REFERENCES Topic(topic_name) ON DELETE CASCADE ON UPDATE CASCADE

);

CREATE TABLE Subscribe(
    userID INTEGER,
    communityID INTEGER,
    PRIMARY KEY(userID,communityID),
    FOREIGN KEY(userID) REFERENCES User(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE CID_DATETIME_Title(
    communityID INTEGER,
    DATETIME_record DATETIME,
    title CHAR(250),
    content CHAR(250) NOT NULL,
    PRIMARY KEY(communityID,DATETIME_record,title),
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE UID_CID_DATETIME(
    userID INTEGER,
    communityID INTEGER,
    DATETIME_record DATETIME,
    title CHAR(250) NOT NULL,
    PRIMARY KEY(userID,communityID,DATETIME_record),
    FOREIGN KEY(userID) REFERENCES User(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE BID(
    blogId INTEGER,
    userID INTEGER NOT NULL,
    communityID INTEGER NOT NULL,
    DATETIME_record DATETIME NOT NULL,
    PRIMARY KEY(blogId),
    FOREIGN KEY(userID) REFERENCES User(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Comment_Create_Follows(
    order INTEGER,
    blogID INTEGER,
    userID INTEGER NOT NULL,
    content CHAR(250) NOT NULL,
    PRIMARY KEY(order,blogID),
    FOREIGN KEY(blogID) REFERENCES BID(blogID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(userID) REFERENCES User(userID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- INSERT INTO User    VALUES(3040001,'Amy','2000-01-01','password3040001',0);
-- INSERT INTO User    VALUES(3040002,'Bob','2000-01-02','password3040002',0);
-- INSERT INTO User    VALUES(3040003,'Cindy','2000-01-03','password3040003',0);
-- INSERT INTO User    VALUES(3040004,'Darwin','2000-01-04','password3040004',0);
-- INSERT INTO User    VALUES(3040005,'Grace','2000-01-05','password3040005',1);

-- INSERT INTO Birthday_Age    VALUES('2000-01-01',21);
-- INSERT INTO Birthday_Age    VALUES('2000-01-02',21);
-- INSERT INTO Birthday_Age    VALUES('2000-01-03',21);
-- INSERT INTO Birthday_Age    VALUES('2000-01-04',21);
-- INSERT INTO Birthday_Age    VALUES('2000-01-05',21);


-- INSERT INTO VIP    VALUES(3041001,3,'blue');
-- INSERT INTO VIP    VALUES(3041002,8,NULL);
-- INSERT INTO VIP    VALUES(3041003,7,'green');
-- INSERT INTO VIP    VALUES(3041004,5,'red');
-- INSERT INTO VIP    VALUES(3041005,4,'purple');

-- INSERT INTO SecurityInfo_Of    VALUES(3040001,'jim1@gmail.com','What is the favorate food?','apple');
-- INSERT INTO SecurityInfo_Of    VALUES(3040002,'jim2@gmail.com','What is the favorate color?','blue');
-- INSERT INTO SecurityInfo_Of    VALUES(3040003,'jim3@gmail.com','What is the favorate animal?','dog');
-- INSERT INTO SecurityInfo_Of    VALUES(3040004,'jim4@gmail.com','What is the favorate singer?','Jay Chou');
-- INSERT INTO SecurityInfo_Of    VALUES(3040005,'jim5@gmail.com','What is the favorate subject?','computer science');

-- INSERT INTO Admin_Monitor    VALUES(3044001,'autobot1','adminpassword1',3043001);
-- INSERT INTO Admin_Monitor    VALUES(3044002,'autobot2','adminpassword2',3043002);
-- INSERT INTO Admin_Monitor    VALUES(3044003,'autobot3','adminpassword3',3043003);
-- INSERT INTO Admin_Monitor    VALUES(3044004,'autobot4','adminpassword4',3043004);
-- INSERT INTO Admin_Monitor    VALUES(3044005,'autobot5','adminpassword5',3043005);

-- INSERT INTO Ban    VALUES(3040001,3044001);
-- INSERT INTO Ban    VALUES(3040002,3044002);
-- INSERT INTO Ban    VALUES(3040003,3044003);
-- INSERT INTO Ban    VALUES(3040004,3044004);
-- INSERT INTO Ban    VALUES(3040005,3044005);

-- INSERT INTO Community    VALUES(3045001, 1);
-- INSERT INTO Community    VALUES(3045002, 2);
-- INSERT INTO Community    VALUES(3045003, 3);
-- INSERT INTO Community    VALUES(3045004, 4);
-- INSERT INTO Community    VALUES(3045005, 5);

-- INSERT INTO Topic VALUES("Sports");
-- INSERT INTO Topic VALUES("Music");
-- INSERT INTO Topic VALUES("Cook");
-- INSERT INTO Topic VALUES("Anime");
-- INSERT INTO Topic VALUES("IT");

-- -- many to many
-- INSERT INTO About    VALUES(3045001, "Sports");
-- INSERT INTO About    VALUES(3045001, "Music");
-- INSERT INTO About    VALUES(3045002, "Music");
-- INSERT INTO About    VALUES(3045003, "Cook");
-- INSERT INTO About    VALUES(3045004, "Anime");
-- INSERT INTO About    VALUES(3045005, "IT");
-- INSERT INTO About    VALUES(3045006, "IT");

-- INSERT INTO Subscribe    VALUES(3040001,3045001);
-- INSERT INTO Subscribe    VALUES(3040002,3045002);
-- INSERT INTO Subscribe    VALUES(3040003,3045003);
-- INSERT INTO Subscribe    VALUES(3040004,3045004);
-- INSERT INTO Subscribe    VALUES(3040005,3045005);

-- INSERT INTO CID_DATETIME_Title    VALUES(3045001,0001-01-01 00:00:00.0000001,"testing_title","testing_content");
-- INSERT INTO CID_DATETIME_Title    VALUES(3045002,0001-01-01 00:00:00.0000002,"testing_title","testing_content");
-- INSERT INTO CID_DATETIME_Title    VALUES(3045003,0001-01-01 00:00:00.0000003,"testing_title","testing_content");
-- INSERT INTO CID_DATETIME_Title    VALUES(3045004,0001-01-01 00:00:00.0000004,"testing_title","testing_content");
-- INSERT INTO CID_DATETIME_Title    VALUES(3045005,0001-01-01 00:00:00.9999999,"testing_title","testing_content");

-- INSERT INTO UID_CID_DATETIME    VALUES(3040001,3045001,0001-01-01 00:00:00.0000001,"testing_title");
-- INSERT INTO UID_CID_DATETIME    VALUES(3040002,3045002,0001-01-01 00:00:00.0000002,"testing_title");
-- INSERT INTO UID_CID_DATETIME    VALUES(3040003,3045003,0001-01-01 00:00:00.0000003,"testing_title");
-- INSERT INTO UID_CID_DATETIME    VALUES(3040004,3045004,0001-01-01 00:00:00.0000004,"testing_title");
-- INSERT INTO UID_CID_DATETIME    VALUES(3040005,3045005,0001-01-01 00:00:00.9999999,"testing_title");

-- INSERT INTO BID    VALUES(3042001,3040001,3045001,0001-01-01 00:00:00.0000001);
-- INSERT INTO BID    VALUES(3042002,3040002,3045002,0001-01-01 00:00:00.0000002);
-- INSERT INTO BID    VALUES(3042003,3040003,3045003,0001-01-01 00:00:00.0000003);
-- INSERT INTO BID    VALUES(3042004,3040004,3045004,0001-01-01 00:00:00.0000004);
-- INSERT INTO BID    VALUES(3042005,3040005,3045005,0001-01-01 00:00:00.9999999);

-- INSERT INTO Comment_Create_Follows    VALUES(1,3042001,3040001,"testing_content");
-- INSERT INTO Comment_Create_Follows    VALUES(2,3042002,3040002,"testing_content");
-- INSERT INTO Comment_Create_Follows    VALUES(3,3042003,3040003,"testing_content");
-- INSERT INTO Comment_Create_Follows    VALUES(4,3042004,3040004,"testing_content");
-- INSERT INTO Comment_Create_Follows    VALUES(5,3042005,3040005,"testing_content");