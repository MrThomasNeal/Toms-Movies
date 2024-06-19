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

$actorname = $_POST['actorname'];

echo "Values being search in the database:<br>";
echo " - Actor Name = $actorname<br><br>";

if(empty($actorname)) {
    echo "Actor Name: Empty Input<br>";
    $run = false;
}

if(strlen($actorname) < 3 ) {
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
    $findmovie = "SELECT * FROM Actor WHERE actName = '$actorname'";
    $rs = mysqli_query($con, $findmovie);
    if (mysqli_num_rows($rs) > 0) {
        $run = true;
    } else {
        echo "'$actorname' does not exist in the database<br><br>";
        $run = false;
    }
}

if ($run == true) {
    $sql = "SELECT * FROM Actor WHERE actName = '$actorname'";
    $rs = mysqli_query($con, $sql);
    if ($rs) {
        echo "Returned rows are: " . mysqli_num_rows($rs);
        echo "<br>";
        echo "<table>";
        echo "<th>Actor ID</th>";
        echo "<th>Actor Name</th>";
        foreach($rs as $row) {
            echo "<tr><td>" . $row['actID'] . "</td><td>" . $row['actName'] . "</td></tr>";
        }
        echo "</table>";
      }
}

mysql_close();
?>