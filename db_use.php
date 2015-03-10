<html>
<body>

<?php
require 'database.php';

?>

<ul>
  <li><?= $_ENV['CLEARDB_DATABASE_URL'] ?></li>
  <li><?= $db_url['book'] ?></li>
  <li><?= $db_url['auth'] ?></li>
</ul>

</body>
</html>
