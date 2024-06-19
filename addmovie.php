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

$moviename = $_POST['newmoviename'];
$actorname = $_POST['newactorname'];
$year = $_POST['newyear'];
$genre = $_POST['newgenre'];
$price = $_POST['newprice'];
echo "Values being inserted into database:<br>";
echo " - Movie Name = $moviename<br>";
echo " - Actor Name = $actorname<br>";
echo " - Year = $year<br>";
echo " - Genre = $genre<br>";
echo " - Price = $price<br><br>";

if (strlen($moviename) < 3 ) {
    echo "Movie name too short<br>";
    $run = false;
    }

if (empty($moviename)) {
    echo "Movie name: Empty Input<br>";
    $run = false;
    }

if (empty($actorname)) {
    echo "Movie name: Empty Input<br>";
    $run = false;
    }

if(preg_match("/^[a-zA-Z\s]+$/", $actorname)) {
    $run = true;
} else {
    $run = false;
    echo "Actor name contains non alphabet characters<br>";
}

if (strlen($actorname) < 3) {
    echo "Actor name too short<br>";
    $run = false;
}


if(empty($year) == false) {
    if (is_numeric($year)) {
        $run = true;
    } else {
        echo "Year of release contains non numeric characters<br>";
        $run = false;
    }
}

if (empty($genre)) {
    echo "Genre: Empty Input<br>";
    $run = false;
}

if(preg_match("/^[a-zA-Z\s]+$/", $genre)) {
    $run = true;
} else {
    $run = false;
    echo "Genre contains non alphabet characters<br>";
}

if (strlen($genre) < 3) {
    echo "Genre name too short<br>";
    $run = false;
}

if (empty($price)) {
    echo "Price: Empty Input<br>";
    $run = false;
}

if ($run == true) {
    $findactor = "SELECT * FROM Movie WHERE Title = '$moviename'";
    $rs = mysqli_query($con, $findactor);
    if (mysqli_num_rows($rs) > 0) {
        echo "$moviename already exists in the database<br><br>";
        $run = false;
    } else {
        $run = true;
    }
}

if ($run == true) {
    $findactor = "SELECT * FROM Actor WHERE actName = '$actorname'";
    $rs = mysqli_query($con, $findactor);
    if (mysqli_num_rows($rs) > 0) {
        foreach($rs as $row) {
            $foundID = $row['actID'];
        }
        $run = true;
    } else {
        echo "Actor $actorname, doesn't exist<br><br>";
        $run = false;
    }
}

if ($run == true) {
    $sql = "INSERT INTO Movie (actID, title, year, price, genre) VALUES ('$foundID', '$moviename', '$year', '$price', '$genre')";
    $rs = mysqli_query($con, $sql);
    if($rs) {
        echo "$moviename inserted into database<br>";
    } else {
        echo "Error when inserting $moviename into database <br>";
    }
} else {
    echo "Addition Unsuccessful";
}

mysql_close();
?>