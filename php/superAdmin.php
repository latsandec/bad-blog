<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Adminastrator</title>
</head>
<body>
    <form class="" action="superAdmin.php" method="GET">
            <h1>Super Adminastrator
            <p>You can access two attributes from any table you want</p>
                <input type="text" name ="attribute1" placeholder="attribute1">
                <input type="text" name ="attribute2" placeholder="attribute2">
                <input type="text" name ="table" placeholder="table name">
                <input type="text" name ="field1" placeholder="field1">
                <input type="text" name ="var1" placeholder="var1">
                <input type="submit" name="submit" value="confirm">
            </h1>
            <p>Input two attribute you want to select, the name of the table, and constraint of field1 = var1.</p>
        </form>
<<<<<<< HEAD
    </div>
    <div class="top-container">
    <form class="" action="superAdmin.php" method="GET">
            <h2>Change VIP</h2>
=======

        <form class="" action="superAdmin.php" method="GET">
            <h1>Change VIP
>>>>>>> 411ba03e3e943268d93ad0fadbefad093be66c2f
            <p>You can update the vip level the preferred color</p>
                <input type="text" name ="vipID" placeholder="vipID">
                <input type="text" name ="attribute5" placeholder="attribute you want to update">
                <input type="text" name ="value" placeholder="value">
                <input type="submit" name="submit2" value="confirm">
<<<<<<< HEAD
            
            <p>Input two attribute you want to select, the name of the table, and constraint of field1 = var1.</p>
        </form>
    </div>
    <div class="middle-container">
      <h2>Go To Admin</h2>
      <p>If you want to view the Admin page, press on the button</p>
      <form method="GET" action="admin.php">
        <input type="hidden" id="adminRequest" name="adminRequest">
        <input class = "btn" type="submit" value="Go" name="adminSubmit"></p>
      </form>
    </div>
    

    
=======
            </h1>
            <p>Input two attribute you want to select, the name of the table, and constraint of field1 = var1.</p>
        </form>
>>>>>>> 411ba03e3e943268d93ad0fadbefad093be66c2f

<?php
include "connect.php";
$attribute1 = $_REQUEST["attribute1"];
$attribute2 = $_REQUEST["attribute2"];
$table = $_REQUEST["table"];
$field1 = $_REQUEST["field1"];
$var1 = $_REQUEST["var1"];
$vipID = $_REQUEST["vipID"];
$attributeUpdate = $_REQUEST["attribute5"];
$value = $_REQUEST["value"];

if(isset($_GET['submit'])){
    // echo "Good";
    if(connectToDB()){
        $cmd = "SELECT $attribute1, $attribute2 FROM $table WHERE $field1 = $var1";
        $result = executePlainSQL($cmd);
        //echo $cmd;
        echo "<br>Result<br>";
        echo "<table>";
        echo "<tr><th>$attribute1</th><th>$attribute2</th></tr>";

        while($row = OCI_Fetch_Array($result, OCI_BOTH)){
            echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";
        }

        
    }
}elseif(isset($_GET['submit2'])){
    // echo $vipID;
    // echo $attributeUpdate;
    if(connectToDB()){
        $cmd = "UPDATE VIP SET $attributeUpdate = $value WHERE vipID = $vipID";
        $result = executePlainSQL($cmd);        
<<<<<<< HEAD
    }
}

function handleAdminRequest() {
    header("refresh:0;url=admin_list.php");
}

function handlePOSTRequest() {
    if (connectToDB()) {
        if (array_key_exists('adminRequest', $_GET)) {
            handleAdminRequest();
        }
        disconnectFromDB();
=======
>>>>>>> 411ba03e3e943268d93ad0fadbefad093be66c2f
    }
}
    disconnectFromDB();

?>
    
</body>
</html>