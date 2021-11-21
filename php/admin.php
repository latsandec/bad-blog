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
    <input class = "btn" type="submit" value="BAN" name="ban"></p>
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


  <?php
        include "connect.php";

        function handleBanRequest() {
            $userID = $_POST['userID'];
            if ($userID !== '') {
              executePlainSQL("UPDATE blog_users SET ban_status = 1 WHERE userID = $userID");
            } else {
              echo "<br>Please enter ID.<br>";
            }
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
          $result = executePlainSQL("SELECT * FROM blog_users");

          echo "<br>User List:<br>";
          echo "<table>";
          echo "<tr><th>ID</th><th>Name</th><th>BD</th><th>Ban status</th></tr>";

          while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
              echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[4] . "</td></tr>"; 
          }

          echo "</table>";
      }

        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('ban', $_POST)) {
                    handleBanRequest();
                } else if (array_key_exists('listcomm', $_POST)) {
                  handleListCommRequest();
                } else if (array_key_exists('listuser', $_POST)) {
                  handleListUserRequest();
              }

                disconnectFromDB();
            }
        }

		if (isset($_POST['ban']) || isset($_POST['listuser']) || isset($_POST['listcomm'])) {
            handlePOSTRequest();
        } 

	?>

</body>


</html>
