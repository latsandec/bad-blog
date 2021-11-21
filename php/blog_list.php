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
            <input type="submit" value="Post" name="postSubmit"></p>
        </form>
        <?php
        include "connect.php";
        session_start();

        function handleBlogDetailRequest() {
            //$communityID = $_SESSION['communityID'];
            $communityID = 3045001;
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
            //$communityID = $_SESSION['communityID'];
            $communityID = 3045001;
            $result = executePlainSQL("SELECT B.blogId, U.title, B.DATETIME_record FROM BID B, UID_CID_DATETIME U WHERE B.communityID = $communityID AND B.DATETIME_record = U.DATETIME_record AND B.userID = U.userID AND B.communityID = U.communityID");

            echo "<br>Blog List:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Title</th><th>Posted Time</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>"; 
            }

            echo "</table>";
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
                    //handleAddBlogRequest();
                }

                disconnectFromDB();
            }
        }

		if (isset($_GET['detailSubmit']) || isset($_GET['refreshSubmit'])) {
            handleGETRequest();
        } else if (isset($_POST['postSubmit'])) {
            handlePOSTRequest();
        }

	?>
	</body>
</html>
