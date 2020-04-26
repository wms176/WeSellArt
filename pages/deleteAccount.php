<?php 
		session_start();
		if(!isset($_SESSION['user'])) {
			header("location: loginPage.php");
		  }		  
		else {
			$user = $_SESSION['user']['username'];
		}

		$userID = $_SESSION['user']['userID'];
		require_once 'login.php';
		$connection = new mysqli($hn, $un, $pw, $db);

        if ($connection->connect_error)
			die($connection->connect_error);
			
		$query = "DELETE FROM users WHERE userID='$userID'";
		$result = $connection->query($query);
		
        if (!$result)
			die($connection->error);
			
		header("location: loginPage.php");
?>