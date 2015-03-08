<html>
<head>
  <title>Members only</title>
</head>
</body>
  <h1>Members only</h1>
<?php
  session_start();

  // check session variable
  if (isset($_SESSION['valid_user'])) {
    echo '<p>You are logged in as '.$_SESSION['valid_user'].'</p>';
?>
<?php
  } else {
?>
    <p>You are not logged in.</p>
    <p>Only logged in members may see this page.</p>
<?php
  }
?>
<a href="user_login.php">Back to main page</a>
</body>
</html>
