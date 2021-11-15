<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Password</title>
</head>
<body>
    
<form method = "POST" action="findPassword.php">
    <h1> Find Password
        <li>
            <label >Email:</label>
            <input type="text" name = "email" placeholder = "email">
            <input type="submit" value="confirm" name="confirm">
        </li>
    </h1>
</form>

<?php
$email = $_REQUEST["email"];

include "connect.php";
if(isset($_POST['confirm'])){
    //echo $email;
    if(connectToDB()){
        $cmd = "SELECT * FROM SecurityInfo_Of WHERE email = '$email'";
        $result = executePlainSQL($cmd);
        $row = OCI_Fetch_Array($result, OCI_BOTH);
        //echo $row[1];
        if(stringIsEqual($row[1], $email)){
            echo "email does not exists!";
        }else{
            $cmd = "SELECT * FROM SecurityInfo_Of WHERE email = '$email'";
            $result = executePlainSQL($cmd);
            $row = OCI_Fetch_Array($result, OCI_BOTH);
            //echo $row[3];
            session_id("abc");
            session_start();
            $_SESSION['email'] = $email;
            echo $_SESSION['email'];

            header("refresh:3;url=answerSecurityQuestion.php");
            
        }
    }
}
?>

</body>
</html>
