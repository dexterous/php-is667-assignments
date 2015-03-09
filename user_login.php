<?php
session_start();

if (isset($_POST['userid']) && isset($_POST['password']))
{
  // if the user has just tried to log in
  $userid = $_POST['userid'];
  $password = $_POST['password'];

  $db = new mysqli('localhost', 'auth_admin', 'rootakses', 'auth');

  if ($db->connect_errno) {
    echo 'Connection to database failed:'.mysqli_connect_error();
    exit();
  }

  $query = "select * from authorized_users where name='$userid' and password=sha1('$password')";

  $result = $db->query($query);
  if ($result->num_rows >0 ) {
    // if they are in the database register the user id
    $_SESSION['valid_user'] = $userid;
  }

  $db->close();
}
?>
<html>
<body>
  <h1>Home page</h1>
<?php
  if (isset($_SESSION['valid_user'])) {
    echo 'You are logged in as: '.$_SESSION['valid_user'].' <br />';
    echo '<a href="user_logout.php">Log out</a><br />';
  } else {
    if (isset($userid)) {
      // if they've tried and failed to log in
      echo 'Could not log you in.<br />';
    } else {
      // they have not tried to log in yet or have logged out
      echo 'You are not logged in.<br />';
    }
?>
  <form method="post" action="user_login.php">
    <table>
      <tr>
        <td>Userid:</td>
        <td><input type="text" name="userid"></td>
      </tr>
      <tr>
        <td>Password:</td>
        <td><input type="password" name="password"></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
        <input type="submit" value="Log in"></td>
      </tr>
    </table>
  </form>
<?php
  }
?>
  <br />
  <a href="user_profile.php">Members section</a>
</body>
</html>
