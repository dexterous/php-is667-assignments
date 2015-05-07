<html>
<head>
  <title>Register User</title>
</head>
<body>
<h1>Register User</h1>
<?php
  // create short variable names
  $name=$_POST['name'];
  $password=$_POST['password'];

  if (!$name || !$password) {
    echo "You have not entered all the required details.<br />";
    echo "Please go back and try again.";
    exit;
  }

  if (!get_magic_quotes_gpc()) {
    $name = addslashes($name);
    $password = addslashes($password);
  }

  require 'database.php';
  @ $db = db_connect($db_url['auth']);

  if ($db->connect_errno) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
  }

  $query = "insert into authorized_users(name, password) values ('".$name."', sha1('".$password."'))";

  $result = $db->query($query);

  if ($result) {
    echo  $db->affected_rows." user inserted into database.";
  } else {
    echo "An error has occurred.  The item was not added.";
  }

  $db->close();
?>
</body>
</html>
