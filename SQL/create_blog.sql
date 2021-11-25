CREATE TABLE Blog_Users(
    userID INTEGER,
    userName CHAR(250) NOT NULL,
    birthday CHAR(10),
    userPassword CHAR(250) NOT NULL,
    ban_status INTEGER NOT NULL,
    PRIMARY KEY(userID)
);


CREATE TABLE VIP(
    vipID INTEGER,
    vip_level INTEGER NOT NULL,
    preferred_color CHAR(250),
    PRIMARY KEY(vipID),
    FOREIGN KEY(vipID) REFERENCES Blog_Users(userID) ON DELETE CASCADE
);

CREATE TABLE SecurityInfo_Of(
    userID INTEGER NOT NULL,
    email CHAR(250),
    security_question CHAR(250) NOT NULL,
    answer CHAR(250) NOT NULL,
    PRIMARY KEY(email),
    FOREIGN KEY(userID) REFERENCES Blog_Users(userID) ON DELETE CASCADE
);

CREATE TABLE Community(
    communityID INTEGER,
    community_level INTEGER NOT NULL,
    PRIMARY KEY(communityID)
);

CREATE TABLE Admin_Monitor(
    adminID INTEGER,
    avatar CHAR(10) NOT NULL,
    adminPassword CHAR(250) NOT NULL,
    communityID INTEGER NOT NULL,
    PRIMARY KEY(adminID),
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE
);

CREATE TABLE Ban(
    userID INTEGER,
    adminID INTEGER,
    PRIMARY KEY(userID,adminID),
    FOREIGN KEY(userID) REFERENCES Blog_Users(userID) ON DELETE CASCADE,
    FOREIGN KEY(adminID) REFERENCES Admin_Monitor(adminID) ON DELETE CASCADE
);


CREATE TABLE Topic(
    topic_name CHAR(250),
    PRIMARY KEY(topic_name)
);

CREATE TABLE Subscribe(
    userID INTEGER,
    communityID INTEGER,
    PRIMARY KEY(userID,communityID),
    FOREIGN KEY(userID) REFERENCES Blog_Users(userID) ON DELETE CASCADE,
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE
);

CREATE TABLE CID_DATETIME_Title(
    communityID INTEGER,
    DATETIME_record DATE,
    title CHAR(250),
    content CHAR(250) NOT NULL,
    PRIMARY KEY(communityID,DATETIME_record,title),
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE
);

CREATE TABLE UID_CID_DATETIME(
    userID INTEGER,
    communityID INTEGER,
    DATETIME_record DATE,
    title CHAR(250) NOT NULL,
    PRIMARY KEY(userID,communityID,DATETIME_record),
    FOREIGN KEY(userID) REFERENCES Blog_Users(userID) ON DELETE CASCADE,
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE
    -- FOREIGN KEY(DATETIME_record) REFERENCES CID_DATETIME_Title(DATETIME_record) ON DELETE CASCADE,
    -- FOREIGN KEY(title) REFERENCES CID_DATETIME_Title(title) ON DELETE CASCADE These two does not work since DATETIME_record and title  is not unique in the CID_DATETIME_Title.
);

CREATE TABLE BID(
    blogId INTEGER,
    userID INTEGER NOT NULL,
    communityID INTEGER NOT NULL,
    DATETIME_record DATE NOT NULL,
    PRIMARY KEY(blogId),
    FOREIGN KEY(userID) REFERENCES Blog_Users(userID) ON DELETE CASCADE,
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE
    -- FOREIGN KEY(DATETIME_record) REFERENCES CID_DATETIME_Title(DATETIME_record) ON DELETE CASCADE This one does not work since DATETIME_record is not unique in UID_CID_DATETIME.
);

CREATE TABLE Comment_Create_Follows(
    comment_order INTEGER,
    blogID INTEGER,
    userID INTEGER NOT NULL,
    content CHAR(250) NOT NULL,
    PRIMARY KEY(comment_order,blogID),
    FOREIGN KEY(blogID) REFERENCES BID(blogID) ON DELETE CASCADE,
    FOREIGN KEY(userID) REFERENCES Blog_Users(userID) ON DELETE CASCADE
);


CREATE TABLE About(
    communityID INTEGER,
    topic_name CHAR(250),
    PRIMARY KEY(communityID,topic_name),
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE,
    FOREIGN KEY(topic_name) REFERENCES Topic(topic_name) ON DELETE CASCADE
);

-- select table_name from user_tables;

-- INSERT INTO Blog_Users    VALUES(1,'a','2000-02-01','abc',0);

-- select * from Blog_Users where userID = 1 and userPassword = 'abc';
-- select * from Blog_Users where  userName = 'a' and userPassword = 'abc';
-- INSERT INTO Blog_Users    VALUES(2,'b','2000-01-01','a',0)
-- INSERT INTO Blog_Users    VALUES(3,'b','2000-01-01','a',0)
-- INSERT INTO SecurityInfo_Of    VALUES(3,'jim1@gmail.com','What is the favorite food?','apple');
-- create table temp(
--     answer CHAR(250) PRIMARY KEY
-- );

-- INSERT INTO temp    VALUES('a');
-- SELECT * FROM SecurityInfo_Of WHERE email = 'jim1@gmail.com';
-- SELECT * FROM Blog_Users WHERE userID = 3040001;
-- select ban_status from Blog_Users where userID = 3040001;
-- select userID
-- from Blog_Users
-- where userID in (select vipID from VIP where vip_level > 5)
-- group by ban_status
-- -- having 
