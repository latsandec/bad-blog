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
