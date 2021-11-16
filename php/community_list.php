<html>
    <head>
        <title>Community List</title>
    </head>

    <body>
        <h2>Enter Community ID to view Blogs</h2>
        <form method="POST" action="community_list.php"> 
            <input type="hidden" id="viewCommunityRequest" name="viewCommunityRequest">
            ID: <input type="text" name="communityID"> <br /><br />

            <input type="submit" value="Submit" name="submit"></p>
        </form>

        <hr />

        <h2>Community List</h2>
        <p>If you want to view the community list, press on the view botton</p>
        <form method="POST" action="community_list.php"> 
            <input type="hidden" id="listCommunityRequest" name="listCommunityRequest">
            <input type="submit" value="View" name="listSubmit"></p>
        </form>
        <?php
        include "connect.php";

        function handleViewRequest() {
            $communityID = $_POST['communityID'];
                    
            if ($communityID !== '') {
                $result = executePlainSQL("SELECT * FROM Community WHERE communityID = $communityID");
                $row = OCI_Fetch_Array($result, OCI_BOTH); 
                if ($row[0]){
                    echo $row[0]." blog list to do";
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
            echo "<tr><th>ID</th><th>Level</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>"; 
            }

            echo "</table>";
        }

        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('viewCommunityRequest', $_POST)) {
                    handleViewRequest();
                } else if (array_key_exists('listCommunityRequest', $_POST)) {
                    handleListRequest();
                }

                disconnectFromDB();
            }
        }

		if (isset($_POST['submit']) || isset($_POST['listSubmit'])) {
            handlePOSTRequest();
        } 

	?>
	</body>
</html>
