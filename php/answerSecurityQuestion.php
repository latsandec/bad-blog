<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Question</title>
</head>
<body>
    <h1> Please answer this question: <br> $row[2]  </h1>
    <form method = "POST" action="">
        <input type="text" name = "answer" placeholder = "answer">
        <input type="submit" value="confirm" name="confirm_answer">
    </form>

<?php
session_start();
$email = $_SESSION["email"];
session_regenerate_id(true);
exit;
?>
</body>
</html>