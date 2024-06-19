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

$movietitle = $_POST['movietitle'];

echo "Values being search in the database:<br>";
echo " - Movie Name = $movietitle<br><br>";

if(empty($movietitle)) {
    echo "Movie Name: Empty Input<br>";
    $run = false;
}

if(strlen($movietitle) < 3 ) {
    echo "Movie name is too short<br>";
    $run = false;
}

if(preg_match("/^[a-zA-Z\s]+$/", $movietitle)) {
    $run = true;
} else {
    $run = false;
    echo "Movie name contains non alphabet characters<br>";
}

if ($run == true) {
    $findmovie = "SELECT * FROM Movie WHERE Title = '$movietitle'";
    $rs = mysqli_query($con, $findmovie);
    if (mysqli_num_rows($rs) > 0) {
        $run = true;
    } else {
        echo "'$movietitle' does not exist in the database<br><br>";
        $run = false;
    }
}

if ($run == true) {
    $sql = "SELECT * FROM Movie WHERE title = '$movietitle'";
    $rs = mysqli_query($con, $sql);
    if ($rs) {
        echo "Returned rows are: " . mysqli_num_rows($rs);
        echo "<br>";
        echo "<table>";
        echo "<th>Movie ID</th>";
        echo "<th>Actor ID</th>";
        echo "<th>Title</th>";
        echo "<th>Year</th>";
        echo "<th>Genre</th>";
        echo "<th>Price</th>";
        foreach($rs as $row) {
            echo "<tr><td>" . $row['mvID'] . "</td><td>" . $row['actID'] . "</td><td>" . $row['Title'] . "</td><td>" . $row['Year'] . "</td><td>" . $row['Genre'] . "</td><td>" . $row['Price'] . "</td></tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
      }
}

mysql_close();
?>