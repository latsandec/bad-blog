<html>
    <head>
        <title>Blog Detail</title>
    </head>

    <body>
        <p>Enter content and click Post to create a new comment</p>
        <form method="POST" action="blog_detail.php"> 
            <input type="hidden" id="addCommentRequest" name="addCommentRequest">
            <input type="text" name="content"> <br /><br />
            <input type="submit" value="Post" name="postSubmit"></p>
        </form>

        <hr />

        <p>Enter the comment # to delete a comment, 0 represent the blog itself </p>
        <form method="POST" action="blog_detail.php"> 
            <input type="hidden" id="deleteRequest" name="deleteRequest">
            <input type="text" name="order"> <br /><br />
            <input type="submit" value="Delete" name="deleteSubmit"></p>
        </form>
        <small>Note: only the sender can delete their own comment or blog</small>
        <?php
        include "connect.php";
        $db_conn = OCILogon("ora_rjin02", "a61496774", "dbhost.students.cs.ubc.ca:1522/stu");

        function displayBlog() {
            global $db_conn;
            $blogID = $_SESSION['blog'];
            if (connectToDB()) {
                executePlainSQL("alter session set NLS_DATE_FORMAT='YYYY-MM-DD HH24:MI:SS'");
                OCICommit($db_conn);
                $blog = OCI_Fetch_Array(executePlainSQL("SELECT * FROM BID WHERE blogId = $blogID"), OCI_BOTH);
                $blog_userID = $blog[1];
                $blog_CommunityID = $blog[2];
                $blog_time = $blog[3];
                $blog_title = OCI_Fetch_Array(executePlainSQL("SELECT title FROM UID_CID_DATETIME WHERE userID = $blog_userID AND communityID = $blog_CommunityID AND DATETIME_record = '$blog_time'"), OCI_BOTH);
                $blog_title = $blog_title[0];
                $blog_content = OCI_Fetch_Array(executePlainSQL("SELECT content FROM CID_DATETIME_Title WHERE title = '$blog_title' AND communityID = $blog_CommunityID AND DATETIME_record = '$blog_time'"), OCI_BOTH);
                $blog_content = $blog_content[0];

                echo "<hr /><h2>". $blog_title ."</h2>
                <small>Posted by " . $blog_userID . ", " . $blog_time .  "</small>
                <p>" . $blog_content .  "</p><hr /><hr />";

                $comments = executePlainSQL("SELECT * FROM Comment_Create_Follows WHERE blogId = $blogID");
                while ($comment = OCI_Fetch_Array($comments, OCI_BOTH)) {
                    echo "<small>Comment #" . $comment[0] . " - Posted by " . $comment[2] . "</small>
                    <p>" . $comment[3] .  "</p><hr />";
                }
                disconnectFromDB();
            }
        }

        function handleDeleteRequest() {
            global $db_conn;
            $blogID = $_SESSION['blog'];
            $order = $_POST['order'];
            $userID = $_SESSION['userID'];
            if ($order == '0') {
                $senderID = oci_fetch_row(executePlainSQL("SELECT userID FROM BID WHERE blogId = $blogID"));
                if ($userID == $senderID[0]) {
                    executePlainSQL("DELETE FROM BID WHERE blogId = $blogID");
                    OCICommit($db_conn);
                    echo "The blog has been deleted successfully";
                    header("refresh:2;url=blog_list.php");
                } else {
                    echo "You don't have permission to do this";
                }
            } else if ($order !== '') {
                $senderID = oci_fetch_row(executePlainSQL("SELECT userID FROM Comment_Create_Follows WHERE blogId = $blogID AND comment_order = $order"));
                if ($userID == $senderID[0]) {
                    executePlainSQL("DELETE FROM Comment_Create_Follows WHERE blogId = $blogID AND comment_order = $order");
                    OCICommit($db_conn);
                    echo "The comment has been deleted successfully";
                    header("refresh:2;url=blog_detail.php");
                } else {
                    echo "You don't have permission to do this";
                }
            } else {
                echo "<br>Please enter order.<br>";
            }
        }

        function handleAddCommentRequest() {
            global $db_conn;
            $blogID = $_SESSION['blog'];
            $userID = $_SESSION['userID'];
            $content = $_POST['content'];
            $total = oci_fetch_row(executePlainSQL("SELECT comment_order FROM Comment_Create_Follows C2 WHERE NOT EXISTS
            (SELECT * FROM Comment_Create_Follows C1 WHERE C1.comment_order > C2.comment_order OR C2.blogID <> $blogID)"));
            $order = $total[0] + 1;

            if ($content !== '') {
                executePlainSQL("INSERT INTO Comment_Create_Follows    VALUES($order, $blogID, $userID, '$content')");
                OCICommit($db_conn);
                echo "The comment has been posted successfully";
                header("refresh:2;url=blog_detail.php");
            } else {
                echo "<br>Make sure to input the content.<br>";
            }
        }

        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('deleteRequest', $_POST)) {
                    handleDeleteRequest();
                } else if (array_key_exists('addCommentRequest', $_POST)) {
                    handleAddCommentRequest();
                } 

                disconnectFromDB();
            }
        }

        session_save_path('/home/r/rjin02/public_html');
        session_start();
        if ($_SESSION['community'] == '') {
            echo "Error, back to community list page";
            header("refresh:3;url=community_list.php");
        } else if ($_SESSION['username'] == '') {
            echo "Error, back to login page";
            header("refresh:3;url=login.html");
        }
		if (isset($_POST['postSubmit']) || isset($_POST['deleteSubmit'])) {
            handlePOSTRequest();
        }

	?>
	</body>
</html>
