<html>
    <head>
        <title>Blog List</title>
    </head>

    <body>
        <h2>Search</h2>
        <p>enter the blog id to view detail</p>
        <form method="GET" action="blog_list.php"> 
            <input type="hidden" id="blogDetailRequest" name="blogDetailRequest">
            ID: <input type="text" name="blogID"> <br /><br />
            <input type="submit" value="View" name="detailSubmit"></p>
        </form>

        <hr />

        <h2>Blog List</h2>
        <p>If you want to refresh the blog list, press on the refresh botton</p>
        <form method="GET" action="blog_list.php"> 
            <input type="hidden" id="refreshRequest" name="refreshRequest">
            <input type="submit" value="Refresh" name="refreshSubmit"></p>
        </form>

        <hr />

        <h2>New Post</h2>
        <p>Enter title and content and click Post to create a new blog</p>
        <form method="POST" action="blog_list.php"> 
            <input type="hidden" id="addBlogRequest" name="addBlogRequest">
            title: <input type="text" name="title"> <br /><br />
            content: <input type="text" name="content"> <br /><br />
            time(YYYY-MM-DD HH:MI:SS): <input type="text" name="time"> <br /><br />
            <input type="submit" value="Post" name="postSubmit"></p>
        </form>
        <?php
        include "connect.php";
        $db_conn = OCILogon("ora_rjin02", "a61496774", "dbhost.students.cs.ubc.ca:1522/stu");

        function handleBlogDetailRequest() {
            $communityID = $_SESSION['community'];
            $blogID = $_GET['blogID'];
            
                    
            if ($blogID !== '') {
                $result = executePlainSQL("SELECT * FROM BID WHERE blogId = $blogID AND communityID = $communityID");
                $row = OCI_Fetch_Array($result, OCI_BOTH); 
                if ($row[0]){
                    echo $row[0]." blog detail to do";
                } else {
                    echo "<br>Result not found.<br>";
                }
            }else {
                echo "<br>Please enter ID.<br>";
            }
        }

        function handleRefreshRequest() {
            $communityID = $_SESSION['community'];
            $result = executePlainSQL("SELECT B.blogId, U.title, B.DATETIME_record FROM BID B, UID_CID_DATETIME U WHERE B.communityID = $communityID AND B.DATETIME_record = U.DATETIME_record AND B.userID = U.userID AND B.communityID = U.communityID");
            echo "<br>Blog List:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Title</th><th>Posted Time</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>"; 
            }
            $total = oci_fetch_row(executePlainSQL("SELECT Count(*) FROM BID WHERE communityID = $communityID"));
            echo "<tr><td>Total:</td><td>" . $total[0] . "</td></tr>"; 
            echo "</table>";
        }
        

        function handleAddBlogRequest() {
            global $db_conn;
            $communityID = $_SESSION['community'];
            $userID = 3040001;
            //$userID = $_SESSION['userID'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $time = $_POST['time'];
            $total = oci_fetch_row(executePlainSQL("SELECT Count(*) FROM BID"));
            $blogID = $total[0] + 3042001;

            if ($title !== '' && $content !== '' && $time !== '') {
                executePlainSQL("INSERT INTO CID_DATETIME_Title    VALUES($communityID,to_date('$time','YYYY-MM-DD HH24:MI:SS'), '$title', '$content')");
                OCICommit($db_conn);
                executePlainSQL("INSERT INTO UID_CID_DATETIME    VALUES($userID, $communityID, to_date('$time','YYYY-MM-DD HH24:MI:SS'), '$title')");
                OCICommit($db_conn);
                executePlainSQL("INSERT INTO BID    VALUES($blogID, $userID, $communityID, to_date('$time','YYYY-MM-DD HH24:MI:SS'))");
                OCICommit($db_conn);
                echo "The blog has been posted successfully";
            } else {
                echo "<br>Make sure to input all title content and time.<br>";
            }
        }

        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('blogDetailRequest', $_GET)) {
                    handleBlogDetailRequest();
                } else if (array_key_exists('refreshRequest', $_GET)) {
                    handleRefreshRequest();
                }

                disconnectFromDB();
            }
        }

        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('addBlogRequest', $_POST)) {
                    handleAddBlogRequest();
                }

                disconnectFromDB();
            }
        }

        session_save_path('/home/o/opkisky/public_html');
        session_start();
        if ($_SESSION['community'] == '') {
            echo "Error, back to community list page";
            header("refresh:3;url=community_list.php");
        }
		if (isset($_GET['detailSubmit']) || isset($_GET['refreshSubmit'])) {
            handleGETRequest();
        } else if (isset($_POST['postSubmit'])) {
            handlePOSTRequest();
        }

	?>
	</body>
</html>
