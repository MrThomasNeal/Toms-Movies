<?php

$db_host = "";
$db_name = "";
$db_user = "";
$db_pass = "";
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if ($con) {
    echo "Connected to the database<br><br>";
} else {
    echo "Not Connected to the database<br><br>";
}

$run = true;

$moviename = $_POST['deletemoviename'];

echo "Values being deleted from the database:<br>";
echo " - Movie Name = $moviename<br><br>";

if(empty($moviename)) {
    echo "Movie Name: Empty Input<br>";
    $run = false;
}

if(strlen($moviename) < 3) {
    echo "Movie name is too short<br>";
    $run = false;
}

if(preg_match("/^[a-zA-Z\s]+$/", $actorname)) {
    $run = true;
} else {
    $run = false;
    echo "Movie name contains non alphabet characters<br>";
}

if ($run == true) {
    $findmovie = "SELECT * FROM Movie WHERE Title = '$moviename'";
    $rs = mysqli_query($con, $findmovie);
    if (mysqli_num_rows($rs) > 0) {
        $run = true;
    } else {
        echo "$moviename does not exist in the database<br><br>";
        $run = false;
    }
}

if($run == true) {
    $sql = "DELETE FROM Movie WHERE Title = '$moviename'";
    $rs = mysqli_query($con, $sql);
    if($rs) {
        echo "$moviename has been deleted from the database<br><br>";
    } else {
        echo "Failed to delete $moviename from the database<br><br>";
    }
} else {
    echo "Deletion unsuccessful";
}

mysql_close();
?>