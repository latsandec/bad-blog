-- selection 
SELECT * FROM blog_users WHERE userID = $username
SELECT * FROM BID WHERE blogId = $blogID AND communityID = $communityID
SELECT * FROM Community WHERE communityID = $communityID
SELECT * FROM Community
SELECT * FROM answer
SELECT * FROM SecurityInfo_Of WHERE email = $email
SELECT * FROM blog_users WHERE userID = $username
SELECT * FROM blog_users WHERE userID = $userID

-- projection
SELECT userID FROM BID WHERE blogId = $blogID
SELECT userID FROM Comment_Create_Follows WHERE blogId = $blogID AND comment_order = $order
SELECT Count(*) FROM Comment_Create_Follows WHERE blogID = $blogID
SELECT comment_order FROM Comment_Create_Follows WHERE blogID = $blogID
SELECT Count(*) FROM BID WHERE communityID = $communityID
SELECT topic_name FROM About WHERE communityID = $communityID

-- insertion
INSERT INTO Comment_Create_Follows    VALUES($order, $blogID, $userID, '$content')
INSERT INTO blog_users    VALUES($userID,'$username','$birthday','$password',0)
INSERT INTO SecurityInfo_Of    VALUES($userID,'$email','$security_question','$answer')

-- deletion 
DELETE FROM BID WHERE blogId = $blogID
DELETE FROM Comment_Create_Follows WHERE blogId = $blogID AND comment_order = $order

-- Update
UPDATE blog_users SET ban_status = 1 WHERE userID = $userID
UPDATE blog_users SET ban_status = 0 WHERE userID = $userID

-- Nested loop
SELECT comment_order FROM Comment_Create_Follows C2 WHERE NOT EXISTS
                        (SELECT * FROM Comment_Create_Follows C1 WHERE C1.comment_order > C2.comment_order OR C2.blogID <> $blogID)

-- Join
SELECT B.blogId, U.title, B.DATETIME_record FROM BID B, UID_CID_DATETIME U WHERE B.communityID = $communityID AND B.DATETIME_record = U.DATETIME_record AND B.userID = U.userID AND B.communityID = U.communityID

-- Aggregation Group BY
select ban_status, COUNT(*) 
from Blog_Users 
where userID in (select vipID from VIP where vip_level > 5)
group by ban_status;

SELECT topic_name, COUNT(*)
    from Community C, About A
    WHERE C.CommunityID = A.CommunityID and C.community_level > '$level'
    GROUP BY topic_name

-- Aggregation with having 
SELECT C.topic_name, COUNT(*)
    from Community C, About A
    GROUP BY C.topic_name 
    Having community_level > (select AVG(community_level) from community);

-- Nested aggregation with group by
SELECT B.ban_status, COUNT(*) as cont
from Blog_Users B
Group BY ban_status
Having 5 < (select COUNT(*) from Blog_Users where ban_status=0);

-- division
SELECT B.userID
FROM Blog_Users B
WHERE NOT EXISTS ((SELECT C.communityID
  FROM Community C)
  MINUS 
  (SELECT S.communityID
  FROM Subscribe S
  WHERE S.userID = B.userID));