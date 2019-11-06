<?php
  $selection = $_POST["selection"];
  $mysqli = new mysqli("mysql.eecs.ku.edu", "alfonsomarte110", "Xubeub3E", "alfonsomarte110");
  /* check connection */
  if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
  }

  $query= "SELECT content FROM Posts WHERE author_id = '". $selection ."';";

  if (mysqli_num_rows($mysqli->query($query)) > 0) {
    if ($result = $mysqli->query($query)) {
        echo "List of posts by ".$selection.":";
        echo "<table border='1'>";
        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["content"] . "</td></tr>";
        }
        echo "</table>";

        /* free result set */
        $result->free();
    }
  }
  else {
    echo $selection." has no posts.";
  }

  /* close connection */
  $mysqli->close();
?>
