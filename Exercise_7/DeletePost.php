<?php
  //Used website to learn how to check multiple checkboxes at once: https://www.formget.com/php-checkbox/
  //Used website to learn about the foreach loop: https://www.php.net/manual/en/control-structures.foreach.php
  //Used website to learn about arrays in PHP: https://docstore.mik.ua/orelly/webprog/php/ch05_03.htm
  //Learned about the PHP "explode" function: https://stackoverflow.com/questions/3245967/can-an-option-in-a-select-tag-carry-multiple-values
  $arr = array();
  $post_id_arr = array();
  foreach($_POST['check'] as $selected) { //stores each selected value in the array
    $html_return = $selected;
    $inner_arr = explode('|', $html_return); //parses the string and stores the results into an array
    $arr[] = $inner_arr;
  }
  $mysqli = new mysqli("mysql.eecs.ku.edu", "alfonsomarte110", "Xubeub3E", "alfonsomarte110");
  /* check connection */
  if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
  }
  $i = 0;
  while ($i < sizeof($arr)) {
    $query= "SELECT author_id,content,post_id FROM Posts WHERE content = '". $arr[$i][0] ."' AND author_id = '". $arr[$i][1] ."';";
    $delete_query = "DELETE FROM Posts WHERE content = '". $arr[$i][0] ."' AND author_id = '". $arr[$i][1] ."';";
    if (mysqli_num_rows($mysqli->query($query)) > 0) {
      if ($result = $mysqli->query($query)) {
          /* fetch associative array */
          while ($row = $result->fetch_assoc()) {
              $post_id_arr[$i] = $row["post_id"]; //keep
              if ($mysqli->query($delete_query) === TRUE) {
                //do nothing
              }
              else {
                echo "The posts failed to delete. Something went wrong.<br>";
              }
          }

          /* free result set */
          $result->free();
      }
    }
    $i++;
  }
  echo "All posts were successfully deleted!<br>";
  echo "Deleted Post ID(s):<br>";
  $j = 0;
  while ($j < sizeof($post_id_arr)) {
    echo $post_id_arr[$j]."<br>";
    $j++;
  }
  /* close connection */
  $mysqli->close();
?>
