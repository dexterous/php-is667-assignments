<?php

if (isset($_ENV['CLEARDB_DATABASE_URL'])) {
  $cleardb_url = $_ENV['CLEARDB_DATABASE_URL'];

  $db_url = array(
    'book' => $cleardb_url,
    'auth' => $cleardb_url
  );
} else {
  $db_url = array(
    'book' => 'mysql://librarian:readmorebooks@localhost/bookorama',
    'auth' => 'mysql://auth_admin:rootakses@localhost/auth',
  );
}

function db_connect($url) {
  $url = parse_url();

  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"], 1);

  return new mysqli($server, $username, $password, $db);
}

?>
