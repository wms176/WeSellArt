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
    echo "<span class='error'>Please Login to access this page.</span>";
    echo "<br><br><a href='loginPage.php'>Login</a>";
  }

  else if($_SESSION['user']['type'] != 'admin') {
    echo "<span class='error'>Please login as an Admin to access this page</span>";
    echo "<br><br><a href='logoutPage.php'>Logout</a>";
  } 

  else {
    $user = $_SESSION['user']['username'];

    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);

    $query = "SELECT * FROM lab5_orders";
    $result = $connection->query($query);

    echo "<table style='width:30%'>";
		  echo "<tr><th>Name</th><th>Category</th><th>Cost</th><th>City</th><th>State</th></tr>";
		  while($row = $result->fetch_array()){
  			echo "<tr><td>";
	  		echo $row['orderID'];
		  	echo "</td><td>";
			  echo $row['username'];
  			echo "</td><td>";
	  		echo $row['orderTotal'];
		  	echo "</td><td>";
  			echo $row['quantity'];
	  		echo "</td><td>";
		  	echo $row['shipping'];
			  echo "</td></tr>";
		  }
    echo "</table>";
  echo "<br><br><a href='logoutPage.php'>Logout</a>";
  }
?>
</body>

</html>
