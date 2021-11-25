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

CREATE TABLE Blog_Create_In(
    blogId INTEGER,
    userID INTEGER NOT NULL,
    blogTime DATE NOT NULL,
    communityID INTEGER NOT NULL,
    title CHAR(250) NOT NULL,
    content CHAR(250) NOT NULL,
    PRIMARY KEY(blogId),
    FOREIGN KEY(userID) REFERENCES Blog_Users(userID),
    FOREIGN KEY(communityID) REFERENCES Community(communityID)
);

CREATE TABLE Comment_Create_Follows(
    comment_order INTEGER,
    blogID INTEGER,
    userID INTEGER NOT NULL,
    content CHAR(250) NOT NULL,
    PRIMARY KEY(comment_order,blogID),
    FOREIGN KEY(blogID) REFERENCES Blog_Create_In(blogId) ON DELETE CASCADE,
    FOREIGN KEY(userID) REFERENCES Blog_Users(userID) ON DELETE CASCADE
);


CREATE TABLE About(
    communityID INTEGER,
    topic_name CHAR(250),
    PRIMARY KEY(communityID,topic_name),
    FOREIGN KEY(communityID) REFERENCES Community(communityID) ON DELETE CASCADE,
    FOREIGN KEY(topic_name) REFERENCES Topic(topic_name) ON DELETE CASCADE
);


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
