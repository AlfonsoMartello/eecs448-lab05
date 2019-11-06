<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "alfonsomarte110", "Xubeub3E", "alfonsomarte110");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT user_id FROM Users";

if ($result = $mysqli->query($query)) {
    echo "List of current users:";
    echo "<table border='1'>";
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["user_id"] . "</td></tr>";
    }
    echo "</table>";

    /* free result set */
    $result->free();
}
else {
  echo "There are no users<br>";
}

/* close connection */
$mysqli->close();
?>
