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

$actorname = $_POST['newactorname'];
echo "Values being inserted into database:<br>";
echo " - Actor Name = $actorname<br><br>";

$run = true;

if (strlen($actorname) < 3) {
    echo "Name too short<br>";
    $run = false;
}
if (empty($actorname)) {
    echo "Empty Input<br>";
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
        echo "$actorname already exists in the database<br><br>";
        $run = false;
    } else {
        $run = true;
    }
}

if($run == true) {
    $sql = "INSERT INTO Actor (actName) VALUES ('$actorname')";
    $rs = mysqli_query($con, $sql);
    if($rs) {
        echo "$actorname inserted into database<br>";
    } else {
        echo "Error when inserting $actorname into database<br>";
    }
} else {
    echo "Addition Unsuccessful";
}

mysql_close();
?>

