<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Blog List</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=MonteCarlo&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Gowun+Dodum&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

    <body>
        <h2>Search</h2>
        <p>Enter the blog id to view detail</p>
        <form method="GET" action="blog_list.php"> 
            <input type="hidden" id="blogDetailRequest" name="blogDetailRequest">
            ID: <input type="text" name="blogID"> <br /><br />
            <input class = "btn" type="submit" value="View" name="detailSubmit"></p>
        </form>


        <h2>Blog List</h2>
        <p>If you want to refresh the blog list, press on the refresh botton</p>
        <form method="GET" action="blog_list.php"> 
            <input type="hidden" id="refreshRequest" name="refreshRequest">
            <input class = "btn" type="submit" value="Refresh" name="refreshSubmit"></p>
        </form>


        <h2>New Post</h2>
        <p>Enter title and content and click Post to create a new blog</p>
        <form method="POST" action="blog_list.php"> 
            <input type="hidden" id="addBlogRequest" name="addBlogRequest">
            title: <input type="text" name="title"> <br /><br />
            content: <input type="text" name="content"> <br /><br />
            <input class = "btn" type="submit" value="Post" name="postSubmit"></p>
        </form>
        <?php
        session_save_path('/home/r/rjin02/public_html');
        session_start();
        include "connect.php";
        $db_conn = OCILogon("ora_rjin02", "a61496774", "dbhost.students.cs.ubc.ca:1522/stu");

        function handleBlogDetailRequest() {
            $communityID = $_SESSION['community'];
            $blogID = $_GET['blogID'];
            
                    
            if ($blogID !== '') {
                $result = executePlainSQL("SELECT * FROM BID WHERE blogId = $blogID AND communityID = $communityID");
                $row = OCI_Fetch_Array($result, OCI_BOTH); 
                if ($row[0]){
                    $_SESSION['blog'] = $row[0];
                    header("refresh:0;url=blog_detail.php");
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
                    //$userID = 3040001;
                    $userID = $_SESSION['userID'];
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $time = date("Y-m-d H:i:s", time());
                    $total = oci_fetch_row(executePlainSQL("SELECT Count(*) FROM BID"));
                    if ($total[0] == 1) {
                        $newest = oci_fetch_row(executePlainSQL("SELECT blogId FROM BID"));
                        $order = $newest[0] + 1;
                    } else {
                        $newest = oci_fetch_row(executePlainSQL("SELECT blogId FROM BID B2 WHERE NOT EXISTS
                        (SELECT * FROM BID B1 WHERE B1.blogId > B2.blogId)"));
                        $order = $newest[0] + 1;
                    }
                    $blogID = $order;

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

        //echo $_SESSION['username'];
        if ($_SESSION['community'] == '') {
            //echo $_SESSION['username'];
            //echo $_SESSION['islogin'];
            echo "Error, back to community list page";
            header("refresh:3;url=community_list.php");
        } else if ($_SESSION['username'] == '') {
            echo "Error, back to login page";
            header("refresh:3;url=login.html");
        }
		if (isset($_GET['detailSubmit']) || isset($_GET['refreshSubmit'])) {
            handleGETRequest();
        } else if (isset($_POST['postSubmit'])) {
            handlePOSTRequest();
        }

	?>
	</body>
</html>
