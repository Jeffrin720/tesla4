<?php
$mysqli1 = new mysqli("localhost","jeffrin","Jeffrin@2002","tesla");

// Check connection
if ($mysqli1 -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli1 -> connect_error;
  exit();
}
?>