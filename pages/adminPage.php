<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Administrator Page</title>
  <style>
    td, th {
		  border: 1px solid;
		  text-align: center;
		  padding: 0.5em;}
    .error {
      color: #FF0000;
    }
	</style>
</head>

<body>
  <h1>Administrator Page</h1>

  <!-- PHP to display admin information -->
  <?php
  session_start();

  if(!isset($_SESSION['user'])) {
    header("location: loginPage.php");
  }

  else if($_SESSION['user']['admin'] != 1) {
    header("location: index.php");
  } 

  else {
    $user = $_SESSION['user']['username'];

    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);

    $query = "SELECT * FROM users";
    $result = $connection->query($query);

    echo "<table style='width:100%'>";
		  echo "<tr><th>userID</th><th>Username</th><th>first Name</th><th>last Name</th><th>Address</th><th>City</th><th>State</th><th>Zipcode</th><th>Admin</th></tr>";
		  while($row = $result->fetch_array()){
  			echo "<tr><td>";
	  		echo $row['userID'];
		  	echo "</td><td>";
			  echo $row['username'];
  			echo "</td><td>";
	  		echo $row['firstName'];
		  	echo "</td><td>";
  			echo $row['lastName'];
	  		echo "</td><td>";
        echo $row['address'];
        echo "</td><td>";
        echo $row['city'];
        echo "</td><td>";
        echo $row['state'];
        echo "</td><td>";
        echo $row['zip'];
        echo "</td><td>";
        if($row['admin'] == 1)
          $admin = 'Yes';
        else
          $admin = 'No';
        echo $admin;
			  echo "</td></tr>";
		  }
    echo "</table>";

  echo "<br><br><a href='inventory.php'>View/Edit inventory</a>";
  echo "<br><br><a href='logoutPage.php'>Logout</a>";
  }
?>
</body>

</html>
