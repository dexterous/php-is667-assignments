<html>
<head>
  <title>Book-O-Rama Search Results</title>
</head>
<body>
<h1>Book-O-Rama Search Results</h1>
<?php
  // create short variable names
  $searchtype=$_POST['searchtype'];
  $searchterm=trim($_POST['searchterm']);

  if (!$searchtype || !$searchterm) {
     echo 'You have not entered search details.  Please go back and try again.';
     exit;
  }

  if (!get_magic_quotes_gpc()){
    $searchtype = addslashes($searchtype);
    $searchterm = addslashes($searchterm);
  }

  @ $db = new mysqli('localhost', 'librarian', 'readmorebooks', 'bookorama');

  if ($db->connect_errno) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

  $query = "select * from customers where ".$searchtype." like '%".$searchterm."%'";
  $result = $db->query($query);

  $num_results = $result->num_rows;

  echo "<p>Number of customers found: ".$num_results."</p>";

  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetch_assoc();
     echo "<p><strong>".($i+1).". Name: ";
     echo htmlspecialchars(stripslashes($row['name']));
     echo "</strong><br />Address: ";
     echo stripslashes($row['address']);
     echo "<br />City: ";
     echo stripslashes($row['city']);
     echo "</p>";
  }

  $result->free();
  $db->close();

?>
</body>
</html>
