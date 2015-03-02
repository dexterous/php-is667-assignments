<?php
  $name = $_POST['name'];
  $password = $_POST['password'];

  if ((!isset($name)) || (!isset($password))) {
  //Visitor needs to enter a name and password
?>
    <h1>Please Log In</h1>
    <p>This page is secret.</p>
    <form method="post" action="user_authenticate.php">
      <p>Username: <input type="text" name="name"></p>
      <p>Password: <input type="password" name="password"></p>
      <p><input type="submit" name="submit" value="Log In"></p>
    </form>

<?php

    exit;
  }

  // connect to mysql
  @ $db = new mysqli('localhost', 'auth_admin', 'rootakses', 'auth');

  if($db->connect_errno) {
    echo "Cannot connect to database.";
    exit;
  }

  // query the database to see if there is a record which matches
  $query = "select count(*) from authorized_users where name = '".$name."' and password = sha1('".$password."')";
  $result = $db->query($query);

  if(!$result) {
    echo "Cannot run query.";
    exit;
  }

  $row = $result->fetch_row();
  $count = $row[0];

  if ($count > 0) {
    // visitor's name and password combination are correct
    echo "<h1>Here it is - the secret code is </h1>";
    echo "user password :". sha1($password);
    echo " <p>I bet you are glad you can see this secret page.</p>";
  } else {
    // visitor's name and password combination are not correct
    echo "<h1>Go Away!</h1>";
    echo "<p>You are not authorized to use this resource.</p>";
  }

  $result->free();
  $db->close();
?>
