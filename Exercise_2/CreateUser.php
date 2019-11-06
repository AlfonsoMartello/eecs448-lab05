<?php
  $username = $_POST["username"];
  $mysqli = new mysqli("mysql.eecs.ku.edu", "alfonsomarte110", "Xubeub3E", "alfonsomarte110");

  if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }

  $query1 = "INSERT INTO Users (user_id) VALUES ('$username')";

  if ($result = $mysqli->query($query1)) {
    echo "The new user was created successfully<br>";
  }
  else {
    echo "The new user already exists<br>";
  }

$mysqli->close();
?>
