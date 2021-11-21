<html>
    <head>
        <title>Community List</title>
    </head>

    <body>
        <h2>Enter Community ID to view Blogs</h2>
        <form method="GET" action="community_list.php"> 
            <input type="hidden" id="viewCommunityRequest" name="viewCommunityRequest">
            ID: <input type="text" name="communityID"> <br /><br />

            <input type="submit" value="Submit" name="submit"></p>
        </form>

        <hr />

        <h2>Community List</h2>
        <p>If you want to view the community list, press on the view botton</p>
        <form method="GET" action="community_list.php"> 
            <input type="hidden" id="listCommunityRequest" name="listCommunityRequest">
            <input type="submit" value="View" name="listSubmit"></p>
        </form>
        <?php
        include "connect.php";
        
        function handleViewRequest() {
            $communityID = $_GET['communityID'];
                    
            if ($communityID !== '') {
                $result = executePlainSQL("SELECT * FROM Community WHERE communityID = $communityID");
                $row = OCI_Fetch_Array($result, OCI_BOTH); 
                if ($row[0]){
                    $_SESSION['community'] = $row[0];
                    header("refresh:0;url=blog_list.php");
                } else {
                    echo "<br>Result not found.<br>";
                }
            }else {
                echo "<br>Please enter ID.<br>";
            }
        }

        function handleListRequest() {
            $result = executePlainSQL("SELECT * FROM Community");

            echo "<br>Community List:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Level</th><th>Topics</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td>"; 
                $communityID = $row[0];
                $topics = executePlainSQL("SELECT topic_name FROM About WHERE communityID = $communityID");
                while ($topic = OCI_Fetch_Array($topics, OCI_BOTH)) {
                    echo "<td>" . $topic[0] . "</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        }

        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('viewCommunityRequest', $_GET)) {
                    handleViewRequest();
                } else if (array_key_exists('listCommunityRequest', $_GET)) {
                    handleListRequest();
                }

                disconnectFromDB();
            }
        }
        
        session_save_path('/home/r/rjin02/public_html');
        session_start();

		if (isset($_GET['submit']) || isset($_GET['listSubmit'])) {
            handleGETRequest();
        } 

	?>
	</body>
</html>
