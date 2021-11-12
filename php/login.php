<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    
<form action="login.php" method="post">
    <fieldset>
        <legend>用户登录</legend>
        <ul>
            <li>
                <label>用户名:</label>
                <input type="text" name="username">
            </li>
            <li>
                <label>密   码:</label>
                <input type="password" name="password">
            </li>
            <li>
                <label> </label>
                <input type="checkbox" name="remember" value="yes">7天内自动登录
            </li>
            <li>
                <label> </label>
                <input type="submit" name="login" value="登录">
            </li>
			<li>
                <label> </label>
                <input type="submit" name="reset" value="reset">
            </li>
        </ul>
    </fieldset>
</form> -->

    <?php 
	include "connect.php";
	header('Content-type:text/html; charset=utf-8');
	// start Session
	session_start();
	
	// retrive user data
	
	if(connectToDB()){
		if (isset($_POST['login'])) {
			
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			
			$cmd = "SELECT * FROM blog_users WHERE userID = $username";
			// echo "<br> .$cmd . <br>";
			$result = executePlainSQL($cmd);
			$row = OCI_Fetch_Array($result, OCI_BOTH);
			// echo "<br> $row[3] <br>";
			// echo var_dump($password);
			// echo var_dump($row[3]);
			// if(stringIsEqual($password,$row[3])){
			// 	echo "True";
			// }else{
			// 	echo "False";
			// }
			// echo var_dump($password);
			// while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            //     "<tr><td>" . $row["COMMUNITYID"] . "</td><td>" . $row["TOPIC_NAME"] . "</td></tr>";
            // }

			OCICommit($db_conn);
			
			if (($username == '') || ($password == '')) {
				// if it is blank, go back to the login page
				header('refresh:3; url=login.html');
				echo "Wrong username or password!";
				exit;
			}elseif (stringIsEqual($password,$row[3])) {
				# 用户名和密码都正确,将用户信息存到Session中
				$_SESSION['username'] = $username;
				$_SESSION['islogin'] = 1;
				echo "succeed";
				header("refresh:0;url=index.html");
				// 处理完附加项后跳转到登录成功的首页
				// header('location:index.php');
			}else {
				# wrong password, same as the first case
				header('refresh:3; url=login.html');
				echo "Wrong username or password!";
				exit;
			} 
		}
		disconnectFromDB();
	}

	
 ?>
</body>
</html>
