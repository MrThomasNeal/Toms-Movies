<?php

$db_host = "";
$db_name = "";
$db_user = "";
$db_pass = "";
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if ($con) {
    echo "Connected to database<br><br>";
} else {
    echo "Not Connected to database<br><br>";
}

$run = true;

$actorname = $_POST['deleteactorname'];
echo "Values being deleted from the database:<br>";
echo " - Actor Name = $actorname<br><br>";


if(empty($actorname)) {
    echo "Actor Name: Empty Input<br>";
    $run = false;
}

if(strlen($actorname) < 3) {
    echo "Actor name is too short<br>";
    $run = false;
}

if(preg_match("/^[a-zA-Z\s]+$/", $actorname)) {
    $run = true;
} else {
    $run = false;
    echo "Actor name contains non alphabet characters<br>";
}

if ($run == true) {
    $findactor = "SELECT * FROM Actor WHERE actName = '$actorname'";
    $rs = mysqli_query($con, $findactor);
    if (mysqli_num_rows($rs) > 0) {
        $run = true;
    } else {
        echo "$actorname does not exist in the database<br><br>";
        $run = false;
    }
}
if($run == true) {
    $sql = "DELETE FROM Actor WHERE actName = '$actorname'";
    $rs = mysqli_query($con, $sql);
    if($rs) {
        echo "$actorname has been deleted from the database<br><br>";
    } else {
        echo "Failed to delete $actorname from the database<br><br>";
    }
} else {
    echo "Deletion unsuccessful";
}

mysql_close();
?>