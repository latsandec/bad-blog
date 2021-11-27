<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Powerful Admin</title>
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
  <div class="top-container">
    <img class="top-code" src="binary-code.png" alt="code-img">
    <h1>Welcome</h1>
    <h2 id: "admin">Our <span class="power">power</span>ful Admin</h2>
    <img class="bottom-code" src="binary-code.png" alt="code-img">
    <img class="programming-gif" src="programming.png" alt="animation-img">
  </div>

  <div class="middle-container">
    <h2>Enter User ID to Ban the User</h2>
    <p>If this user violates the regualtion, press on the BAN botton to ban the user</p>
    <form method="POST" action="admin.php"> 
    <input type="hidden" id="banUserRequest" name="banUserRequest">
    User ID: <input type="text" name="userID"> <br /><br />
    <input class = "btn" type="submit" value="Change Ban Status" name="ban"></p>
    </form>
  </div>

  <div class="top-container">
    <h2>User List</h2>
    <p>If you want to view the user list, press on the view botton</p>
    <form method="POST" action="admin.php"> 
      <input type="hidden" id="listUserRequest" name="listUserRequest">
      <input class = "btn" type="submit" value="View" name="listuser"></p>
    </form>
  </div>

  <div class="middle-container">
  <h2>Community List</h2>
    <p>If you want to view the community list, press on the view botton</p>
    <form method="POST" action="admin.php"> 
      <input type="hidden" id="listCommunityRequest" name="listCommunityRequest">
      <input class = "btn" type="submit" value="View" name="listcomm"></p>
    </form>
  </div>

  <div class="top-container">
    <h2>Loyal User List</h2>
    <p>If you want to view the loyal user who subscribed all communities, press on the view botton</p>
    <form method="POST" action="admin.php"> 
      <input type="hidden" id="listLoyalUserRequest" name="listLoyalUserRequest">
      <input class = "btn" type="submit" value="View" name="listloyaluser"></p>
    </form>
  </div>

  <div class="middle-container">
  <h2>yyyyyyyyyyyyyyyy</h2>
    <p>If you want to view the count the number of vip users, in which there are more than x users in the vip_level, press on the view botton</p>
    <form method="POST" action="admin.php"> 
      <input type="hidden" id="countingVIP" name="countingVIP">
      <input class = "btn" type="submit" value="View" name="countingVIP"></p>
    </form>
  </div>

  <div class="top-container">
      <h2>Go To Super Admin</h2>
      <p>If you want to view the Super Admin page, press on the button</p>
      <form method="GET" action="superAdmin.php">
        <input type="hidden" id="superAdminRequest" name="superAdminRequest">
        <input class = "btn" type="submit" value="Go" name="superAdminSubmit"></p>
      </form>
    </div>


  <?php
        include "connect.php";

        function handleBanRequest() {
          global $db_conn;
            $userID = $_REQUEST['userID'];
            settype($userID, "integer");
            //echo var_dump($userID);
            //echo $userID;
            if ($userID !== '') {
              $result = executePlainSQL("SELECT ban_status from blog_users where userID = '$userID'");
              $row = OCI_Fetch_Array($result, OCI_BOTH);
              echo $row[0];
              if ($row[0] == 0) {
                //echo "UPDATE blog_users SET ban_status = 1 WHERE userID = $userID";
                $result = executePlainSQL("UPDATE blog_users SET ban_status = 1 WHERE userID = $userID");
                OCICommit($db_conn);
                $row = OCI_Fetch_Array($result, OCI_BOTH);
                echo $row[0];
              } else {
                echo "else";
                //executePlainSQL("UPDATE blog_users SET ban_status = 0 WHERE userID = '$userID'");
                $result = executePlainSQL("UPDATE blog_users SET ban_status = 0 WHERE userID = $userID");
                OCICommit($db_conn);
                $row = OCI_Fetch_Array($result, OCI_BOTH);
                echo $row[0];
              }
            } else {
              echo "<br>Please enter ID.<br>";
            }
            $cmd = "select ban_status from Blog_Users where userID = 3040001";
            $result = executePlainSQL($cmd);
            $row = OCI_Fetch_Array($result, OCI_BOTH);
            echo "AAAAAAAAAAAAAAA";
            echo $row[0];
          }
        
        function handleListCommRequest() {
            $result = executePlainSQL("SELECT * FROM Community");

            echo "<br>Community List:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Level</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>"; 
            }

            echo "</table>";
        }

        function handleListUserRequest() {
          $result = executePlainSQL("SELECT userID, userName, birthday,ban_status FROM blog_users");

          echo "<br>User List:<br>";
          echo "<table>";
          echo "<tr><th>ID</th><th>Name</th><th>BD</th><th>Ban status</th></tr>";

          while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
              echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td></tr>"; 
          }

          echo "</table>";
      }

      function handleListLoyalUserRequest() {
        $result = executePlainSQL("SELECT B.userID
                                    FROM Blog_Users B
                                    WHERE NOT EXISTS ((SELECT C.communityID
                                    FROM Community C)
                                    MINUS 
                                    (SELECT S.communityID
                                    FROM Subscribe S
                                    WHERE S.userID = B.userID))");

        echo "<br>Loyal User List:<br>";
        echo "<table>";
        echo "<tr><th>ID</th></tr>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row[0] . "</td></tr>"; 
        }

        echo "</table>";
      }


      function handlecountingVIPRequest() {
        $result = executePlainSQL("SELECT v1.vip_level, COUNT(*) as ct
                                   FROM VIP v1
                                   GROUP BY vip_level
                                   HAVING 3 < (SELECT COUNT(*)
                                               FROM VIP v2
                                               WHERE v.vip_level = v2.vip_level)");

        echo "<br>YYYYYYY List:<br>";
        echo "<table>";
        echo "<tr><th>ID</th></tr>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row[0] . "</td></tr>"; 
        }

        echo "</table>";
      }
      function handlesuperAdminRequest() {
        header("refresh:0;url=superAdmin.php");
    }

        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('ban', $_POST)) {
                    handleBanRequest();
                } else if (array_key_exists('listcomm', $_POST)) {
                  handleListCommRequest();
                } else if (array_key_exists('listuser', $_POST)) {
                  handleListUserRequest();
                } else if (array_key_exists('listloyaluser', $_POST)) {
                  handleListLoyalUserRequest();
                } else if (array_key_exists('countingVIP', $_POST)) {
                  handlecountingVIPRequest();
                } else if (array_key_exists('superAdminRequest', $_POST)) {
                  handlesuperAdminRequest();
                }
              //OCICommit($db_conn);
              disconnectFromDB();
            }
        }

		if (isset($_POST['ban']) || isset($_POST['listuser']) || isset($_POST['listcomm']) || isset($_POST['listloyaluser']) || isset($_POST['listyyyyyyyyyyyuser'])|| isset($_POST['superAdminRequest'])) {
            handlePOSTRequest();
        } 

	?>

</body>


</html>
