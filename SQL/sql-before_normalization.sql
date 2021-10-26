CREATE TABLE User(
    userID INTEGER,
    userName CHAR(250) NOT NULL,
    birthday CHAR(8),
    userPassword CHAR(250) NOT NULL,
    ban_status INTEGER NOT NULL,
    age INTEGER,
    PRIMARY KEY(userID)
)

CREATE TABLE VIP(
    vipID INTEGER,
    vip_level INTEGER NOT NULL,
    preferred_color CHAR(250),
    PRIMARY KEY(vipID),
    FOREIGN KEY(vipID) REFERENCES User(userID)
)

CREATE TABLE SecurityInfo_Of(
    userID INTEGER,
    email CHAR(250),
    security_question CHAR(250) NOT NULL,
    answer CHAR(250) NOT NULL,
    PRIMARY KEY(email),
    FOREIGN KEY(userID) REFERENCES User(userID)
)

CREATE TABLE Admin_Monitor(
    adminID INTEGER,
    avatar CHAR(10) NOT NULL,
    adminPassword CHAR(250) NOT NULL,
    communityID INTEGER NOT NULL,
    PRIMARY KEY(adminID),
    FOREIGN KEY(communityID) REFERENCES Community(communityID)
)

CREATE TABLE Ban(
    userID INTEGER,
    adminID INTEGER,
    PRIMARY KEY(userID,adminID),
    FOREIGN KEY(userID) REFERENCES User(userID),
    FOREIGN KEY(adminID) REFERENCES Admin_Monitor(adminID)
)

CREATE TABLE Community(
    communityID INTEGER,
    community_level INTEGER NOT NULL,
    PRIMARY KEY(communityID),
)

CREATE TABLE Topic(
    topic_name CHAR(250),
    PRIMARY KEY(topic_name),
)

CREATE TABLE About(
    communityID INTEGER,
    topic_name CHAR(250),
    PRIMARY KEY(communityID,topic_name),
    FOREIGN KEY(communityID) REFERENCES Community(communityID),
    FOREIGN KEY(topic_name) REFERENCES Topic(topic_name)

)

CREATE TABLE Subscribe(
    userID INTEGER,
    communityID INTEGER,
    PRIMARY KEY(userID,communityID),
    FOREIGN KEY(userID) REFERENCES User(userID),
    FOREIGN KEY(communityID) REFERENCES Community(communityID)
)

CREATE TABLE Blog_Create_In(
    blogId INTEGER,
    userID INTEGER NOT NULL,
    blogTime DATETIME NOT NULL,
    communityID INTEGER NOT NULL,
    title CHAR(250) NOT NULL,
    content CHAR(250) NOT NULL,
    PRIMARY KEY(blogId),
    FOREIGN KEY(userID) REFERENCES User(userID),
    FOREIGN KEY(communityID) REFERENCES Community(communityID)
)

CREATE TABLE Comment_Create_Follows(
    oder INTEGER,
    userID INTEGER NOT NULL,
    blogId INTEGER NOT NULL,
    content CHAR(250) NOT NULL,
    PRIMARY KEY(oder,blogId),
    FOREIGN KEY(userID) REFERENCES User(userID),
    FOREIGN KEY(blogId) REFERENCES Blog_Create_In(blogId)


)

INSERT INTO User    VALUES(1,'Jim','2000-01-01','password1',0)
TODO
INSERT INTO User    VALUES(1,'Jim','2000-01-01','password1',0)
INSERT INTO User    VALUES(1,'Jim','2000-01-01','password1',0)
INSERT INTO User    VALUES(1,'Jim','2000-01-01','password1',0)
INSERT INTO User    VALUES(1,'Jim','2000-01-01','password1',0)

INSERT INTO VIP    VALUES(1,3,'blue')
TODO
INSERT INTO VIP    VALUES(1,3,'blue')
INSERT INTO VIP    VALUES(1,3,'blue')
INSERT INTO VIP    VALUES(1,3,'blue')
INSERT INTO VIP    VALUES(1,3,'blue')

INSERT INTO SecurityInfo_Of    VALUES(1,'jim@gmail.com','What is the favorate food?','apple')
TODO
INSERT INTO SecurityInfo_Of    VALUES(1,'jim@gmail.com','What is the favorate food?','apple')
INSERT INTO SecurityInfo_Of    VALUES(1,'jim@gmail.com','What is the favorate food?','apple')
INSERT INTO SecurityInfo_Of    VALUES(1,'jim@gmail.com','What is the favorate food?','apple')
INSERT INTO SecurityInfo_Of    VALUES(1,'jim@gmail.com','What is the favorate food?','apple')

INSERT INTO Admin_Monitor    VALUES(1,'monitor1','adminpassword1',1)
TODO
INSERT INTO Admin_Monitor    VALUES(1,'monitor1','adminpassword1',1)
INSERT INTO Admin_Monitor    VALUES(1,'monitor1','adminpassword1',1)
INSERT INTO Admin_Monitor    VALUES(1,'monitor1','adminpassword1',1)
INSERT INTO Admin_Monitor    VALUES(1,'monitor1','adminpassword1',1)

INSERT INTO Ban    VALUES(1,1)
TODO
INSERT INTO Ban    VALUES(1,1)
INSERT INTO Ban    VALUES(1,1)
INSERT INTO Ban    VALUES(1,1)
INSERT INTO Ban    VALUES(1,1)

INSERT INTO Community    VALUES(1,'Foods')
TODO
INSERT INTO Community    VALUES(1,'Foods')
INSERT INTO Community    VALUES(1,'Foods')
INSERT INTO Community    VALUES(1,'Foods')
INSERT INTO Community    VALUES(1,'Foods')

INSERT INTO Subscribe    VALUES(1,1)
TODO
INSERT INTO Subscribe    VALUES(1,1)
INSERT INTO Subscribe    VALUES(1,1)
INSERT INTO Subscribe    VALUES(1,1)
INSERT INTO Subscribe    VALUES(1,1)

####################################################
INSERT INTO Blog_Create_In    VALUES(1,1)

INSERT INTO Comment_Create_Follows    VALUES(1,1)

INSERT INTO Time_Record    VALUES(1,1)
