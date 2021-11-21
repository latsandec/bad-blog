INSERT INTO blog_users    VALUES(3040001,'Amy','2000-01-01','password3040001',0);
INSERT INTO blog_users    VALUES(3040002,'Bob','2000-01-02','password3040002',1);
INSERT INTO blog_users    VALUES(3040003,'Cindy','2000-01-03','password3040003',0);
INSERT INTO blog_users    VALUES(3040004,'Darwin','2000-01-04','password3040004',0);
INSERT INTO blog_users    VALUES(3040005,'Grace','2000-01-05','password3040005',0);
INSERT INTO blog_users    VALUES(3040006,'John','2000-01-06','password3040006',0);
INSERT INTO blog_users    VALUES(3040007,'Cindy','2000-01-02','password3040007',1);
INSERT INTO blog_users    VALUES(3040008,'Darwin','1998-01-01','password3040008',1);

INSERT INTO Birthday_Age    VALUES('2000-01-01',21);
INSERT INTO Birthday_Age    VALUES('2000-01-02',21);
INSERT INTO Birthday_Age    VALUES('2000-01-03',21);
INSERT INTO Birthday_Age    VALUES('2000-01-04',21);
INSERT INTO Birthday_Age    VALUES('2000-01-05',21);
INSERT INTO Birthday_Age    VALUES('2000-01-06',21);
INSERT INTO Birthday_Age    VALUES('1998-01-01',23);


INSERT INTO VIP    VALUES(3040001,3,'blue');
INSERT INTO VIP    VALUES(3040002,8,NULL);
INSERT INTO VIP    VALUES(3040003,7,'green');
INSERT INTO VIP    VALUES(3040004,5,'red');
INSERT INTO VIP    VALUES(3040008,4,'purple');

INSERT INTO SecurityInfo_Of    VALUES(3040001,'jim1@gmail.com','What is the favorite food?','apple');
INSERT INTO SecurityInfo_Of    VALUES(3040002,'jim2@gmail.com','What is the favorite color?','blue');
INSERT INTO SecurityInfo_Of    VALUES(3040003,'jim3@gmail.com','What is the favorite animal?','dog');
INSERT INTO SecurityInfo_Of    VALUES(3040004,'jim4@gmail.com','What is the favorite singer?','Jay Chou');
INSERT INTO SecurityInfo_Of    VALUES(3040005,'jim5@gmail.com','What is the favorite subject?','computer science');
INSERT INTO SecurityInfo_Of    VALUES(3040006,'jim6@gmail.com','What is the favorite weather?','snow');
INSERT INTO SecurityInfo_Of    VALUES(3040007,'jim7@gmail.com','What is the favorite flower?','rose');
INSERT INTO SecurityInfo_Of    VALUES(3040008,'jim8@gmail.com','What is the favorite weather?','sunny');

INSERT INTO Community    VALUES(3045001, 1);
INSERT INTO Community    VALUES(3045002, 1);
INSERT INTO Community    VALUES(3045003, 2);
INSERT INTO Community    VALUES(3045004, 3);
INSERT INTO Community    VALUES(3045005, 4);
INSERT INTO Community    VALUES(3045006, 5);

INSERT INTO Admin_Monitor    VALUES(3044001,'autobot1','adminpassword1',3045001);
INSERT INTO Admin_Monitor    VALUES(3044002,'autobot2','adminpassword2',3045002);
INSERT INTO Admin_Monitor    VALUES(3044003,'autobot3','adminpassword3',3045003);
INSERT INTO Admin_Monitor    VALUES(3044004,'autobot4','adminpassword4',3045004);
INSERT INTO Admin_Monitor    VALUES(3044005,'autobot5','adminpassword5',3045005);

INSERT INTO Ban    VALUES(3040007,3044001);
INSERT INTO Ban    VALUES(3040008,3044002);
INSERT INTO Ban    VALUES(3040002,3044003);

INSERT INTO Topic VALUES('Sports');
INSERT INTO Topic VALUES('Music');
INSERT INTO Topic VALUES('Cook');
INSERT INTO Topic VALUES('Anime');
INSERT INTO Topic VALUES('IT');

INSERT INTO About    VALUES(3045001, 'Anime');
INSERT INTO About    VALUES(3045001, 'Music');
INSERT INTO About    VALUES(3045002, 'Music');
INSERT INTO About    VALUES(3045003, 'Cook');
INSERT INTO About    VALUES(3045004, 'Sports');
INSERT INTO About    VALUES(3045005, 'IT');
INSERT INTO About    VALUES(3045006, 'IT');

INSERT INTO Subscribe    VALUES(3040001,3045001);
INSERT INTO Subscribe    VALUES(3040001,3045002);
INSERT INTO Subscribe    VALUES(3040002,3045002);
INSERT INTO Subscribe    VALUES(3040002,3045003);
INSERT INTO Subscribe    VALUES(3040003,3045003);
INSERT INTO Subscribe    VALUES(3040004,3045004);
INSERT INTO Subscribe    VALUES(3040004,3045006);
INSERT INTO Subscribe    VALUES(3040005,3045001);
INSERT INTO Subscribe    VALUES(3040005,3045002);
INSERT INTO Subscribe    VALUES(3040005,3045003);
INSERT INTO Subscribe    VALUES(3040005,3045004);
INSERT INTO Subscribe    VALUES(3040005,3045005);
INSERT INTO Subscribe    VALUES(3040005,3045006);
INSERT INTO Subscribe    VALUES(3040006,3045005);
INSERT INTO Subscribe    VALUES(3040007,3045004);
INSERT INTO Subscribe    VALUES(3040008,3045002);


INSERT INTO CID_DATETIME_Title    VALUES(3045001,to_date(0001-01-01 00:00:00.0000001,'YYYY-MM-DD HH24:MI:SS'),'New Anime Song Release Today!','This one is so cool.');
INSERT INTO CID_DATETIME_Title    VALUES(3045002,to_date(0001-01-01 00:00:00.0000002,'YYYY-MM-DD HH24:MI:SS'),'Where to find the piano version of this song?','Thanks for any help');
INSERT INTO CID_DATETIME_Title    VALUES(3045003,to_date(0001-01-01 00:00:00.0000003,'YYYY-MM-DD HH24:MI:SS'),'I tried an easy recipe but...','I do not know why everything went wrong..');
INSERT INTO CID_DATETIME_Title    VALUES(3045004,to_date(0001-01-01 00:00:00.0000004,'YYYY-MM-DD HH24:MI:SS'),'Got ticket for World Cup!!','So excited!!');
INSERT INTO CID_DATETIME_Title    VALUES(3045005,to_date(0001-01-01 00:00:00.9999999,'YYYY-MM-DD HH24:MI:SS'),'Finished my first personal project','I spent a month on it');
INSERT INTO CID_DATETIME_Title    VALUES(3045006,to_date(0001-01-01 00:00:01.0000000,'YYYY-MM-DD HH24:MI:SS'),'Got Fired from Amazon','still have a lot to learn...');

INSERT INTO UID_CID_DATETIME    VALUES(3040001,3045001,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'),'New Anime Song Release Today!');
INSERT INTO UID_CID_DATETIME    VALUES(3040002,3045002,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'),'Where to find the piano version of this song?');
INSERT INTO UID_CID_DATETIME    VALUES(3040003,3045003,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'),'I tried an easy recipe but...');
INSERT INTO UID_CID_DATETIME    VALUES(3040004,3045004,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'),'Got ticket for World Cup!!');
INSERT INTO UID_CID_DATETIME    VALUES(3040005,3045005,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'),'Finished my first personal project');
INSERT INTO UID_CID_DATETIME    VALUES(3040006,3045005,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'),'Got Fired from Amazon');

-- INSERT INTO BID    VALUES(3042001,3040001,3045001,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'));
-- INSERT INTO BID    VALUES(3042002,3040002,3045002,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'));
-- INSERT INTO BID    VALUES(3042003,3040003,3045003,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'));
-- INSERT INTO BID    VALUES(3042004,3040004,3045004,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'));
-- INSERT INTO BID    VALUES(3042005,3040005,3045005,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'));
-- INSERT INTO BID    VALUES(3042006,3040005,3045006,to_date('0001-01-01 00:00:00','YYYY-MM-DD HH24:MI:SS'));

-- INSERT INTO Comment_Create_Follows    VALUES(1,3042001,3040005,'Amazing!');
-- INSERT INTO Comment_Create_Follows    VALUES(1,3042002,3040008,'check this link');
-- INSERT INTO Comment_Create_Follows    VALUES(1,3042003,3040002,'lol');
-- INSERT INTO Comment_Create_Follows    VALUES(1,3042004,3040005,'I also want one!!');
-- INSERT INTO Comment_Create_Follows    VALUES(1,3042006,3040006,'Sorry to hear that');
-- INSERT INTO Comment_Create_Follows    VALUES(2,3042006,3040004,'You will find a better job!');