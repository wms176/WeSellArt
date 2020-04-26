<!DOCTYPE html>
<html lang="en">
		<?php   
		session_start();
		if(!isset($_SESSION['user'])) {
			header('location: loginPage.php');
		}
		else if ($_SESSION['user']['admin'] == 0) {
			header('location: index.php');
		}	  
		else {
			$user = $_SESSION['user']['username'];
		}
		?>
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
	.header{
				border-style: solid;
				border-width:5px;
				margin: auto;
				position: relative;
				right: 5px;
				width: 100%;
				height: 200px;
				background-color: dodgerblue;
			}
			a:link{
				color:black;
				text-decoration:none;
			}
			a:visited{
				color:black;
				text-decoration:none;

			}
			.title{
				align: left;
				position: absolute;
				left: 5px;
			}	
			.useroptions{
				position: absolute;
				right:0;
				margin: 5px;
			}
			.submit{
				height: 50px;
				width: 100px;
			}
			.main{
				position: relative;
				border-style: solid;
				border-width:5px;
				margin: auto;
				right:5px;
				width: 100%;
				height: 1000px;
			}
	</style>
</head>

<body>
	<div class="header">
		<div class="title">
		<a href="index.php" ><h1>WeSellArt.com</h1></a><h2>Administrator Page</h2>
		<h3>We here at WeSellArt.com are dedicated to selling you quality* art at unreasonable prices.</h3>
		<h6>*We do not ensure the quality of any artwork.</h6>
		</div>
		<div class="useroptions">
		
		
		<h3>Hello, <?php echo $_SESSION['user']['username']; ?></h3>

		<?php 
		if($_SESSION['user']['admin'] == 1){
			echo "<input class='submit' type='submit' onclick=\"window.location.href='adminPage.php'\" value='Admin Page'></input>";
		} else {
			echo "<input class='submit' type='submit' onclick=\"window.location.href = 'cartview.php'\" value='Cart'></input>";	
		}
		?>		
		<input class="submit" type="submit" onclick="window.location.href='logoutPage.php'" value="Logout"></input>
		<br><br>
		<input class="submit" type="submit" onclick="window.location.href='account.php'" value="View Account"></input>
		
		<input class="submit" type="submit" onclick="window.location.href='vieworders.php'" value="View Orders"></input>
		
		</div>
	
	</div>
	<div class="main">
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
		$userID = $row['userID'];
		echo "</td><td>";
		echo "<input class='submit' name='Delete' type='submit'  onclick=\"window.location.href = 'adminDelete.php?userID=$userID'\" value='Delete Account'></input>";
		echo "</td></tr>";
		  }
    echo "</table>";
  echo "<br><br><a href='inventory.php'>View/Edit inventory</a>";
  echo "<br><br><a href='logoutPage.php'>Logout</a>";
  }
?>
</div>
</body>

</html>
