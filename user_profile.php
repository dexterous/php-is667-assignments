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
    $user_name = $_SESSION['valid_user'];
?>
  <p>You are logged in as <?= $user_name ?></p>
<?php
    $image_dir = "./images";

    require 'database.php';
    @ $db = db_connect($db_url['auth']);

    if ($db->connect_errno) {
      echo 'Connection to database failed:'.$db->connect_error;
      exit();
    }

    // if user has just submitted profile image
    if (isset($_FILES['profile_pic'])) {
      $image = $_FILES['profile_pic'];

      // copy it to images dir
      if (is_uploaded_file($image["tmp_name"])) {
        move_uploaded_file($image["tmp_name"],  "$image_dir/${image['name']}") or die ("Couldn't copy");
      }

      // update image path in db
      $result = $db->query( "update authorized_users set image='${image['name']}' where name='$user_name'");
      if (!$result) {
        echo "Failed to update profile";
      }
    }

    // if user has already submitted profile image
    // read image path from db
    $result = $db->query( "select image from authorized_users where name='$user_name'");
    if ($result) {
      $image_file = $result->fetch_assoc()['image'];
      $image_path = "$image_dir/$image_file";
      if (is_file($image_path)) {
?>
  <img width="200" src="<?= $image_path ?>" />
<?php
      }
    }

    $result->free();
    $db->close();
?>
  <form action="user_profile.php" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="204800"/>
    <p>
      <strong>Pick profile picture</strong>&nbsp;
      <input type="file" name="profile_pic"/>&nbsp;
      <input type="submit" value="Upload!" /></p>
  </form>
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
