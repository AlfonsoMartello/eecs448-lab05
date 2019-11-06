<?php
  $username = $_POST["username"];
  $post = $_POST["posts"];
  $mysqli = new mysqli("mysql.eecs.ku.edu", "alfonsomarte110", "Xubeub3E", "alfonsomarte110");

  if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }

  $query1 = "SELECT * FROM Users WHERE user_id = '". $username ."';";

  if (mysqli_num_rows($mysqli->query($query1)) == 0) { //Tell how many rows the query result has. From: https://www.php.net/manual/en/function.mysql-num-rows.php
    echo "The entered username does not exist.";
  }
  else {
    $query2 = "INSERT INTO Posts (author_id, content) VALUES ('$username', '$post')";
    if ($result = $mysqli->query($query2)) {
      echo "The post was created successfully<br>";
    }
    else {
      echo "The post was not created<br>";
    }
  }

$mysqli->close();
?>
