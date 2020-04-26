<?php 
		session_start();
		if(!isset($_SESSION['user'])) {
			header("location: loginPage.php");
		  }		  
		else {
			$user = $_SESSION['user']['username'];
		}
		?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>We Sell Art</title>
		<style>
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
			.error{
          		color: #FF0000;
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
				width: 150px;
			}
			.main{
				position: relative;
				border-style: solid;
				border-width:5px;
				margin: auto;
				right:5px;
				width: 100%;
				height: 1000px;
				top:201px;
				text-align:center;
			}
			
			
		</style>
  
</head>

<body>
<?php
    if(isset($_POST['Continue'])){
		
      	$password = sanitizeString($_POST['password']);
	  	$confirmPassword = sanitizeString($_POST['confirmpass']);
	 	$address = sanitizeString($_POST['address']);
	 	$city = sanitizeString($_POST['city']);
	 	$state = sanitizeString($_POST['state']);
	 	$zipCode = sanitizeString($_POST['zip']);
	  
	  	$correct = TRUE;
		
	  
	  if ($password != $confirmPassword) {
			$passError = "Your passwords do not match!";
			$correct = FALSE;
	  }
	  if ($correct === TRUE) {
		  	$userID = $_SESSION['user']['userID'];
			$password = encrypt($password);
			  
			require_once 'login.php';
			$connection = new mysqli($hn, $un, $pw, $db);

        if ($connection->connect_error)
			die($connection->connect_error);
			
		$query = "UPDATE users SET password='$password', address='$address', city='$city', state='$state', zip='$zipCode' WHERE userID='$userID'";
		$result = $connection->query($query);
		
        if (!$result)
			die($connection->error);
			
		header("location: logoutPage.php");
		}

	}

	function encrypt($pass) {
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        $token = hash('ripemd128', "$salt1$pass$salt2");
        return $token;
	}
	
    function sanitizeString($data) {
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = htmlentities($data);
    return $data;
	}
	
  ?>
	<div class="header">
		<div class="title">
		<a href="index.php" ><h1>WeSellArt.com</h1></a>
		<h3>We here at WeSellArt.com are dedicated to selling you quality* art at unreasonable prices.</h3>
		<h6>*We do not ensure the quality of any artwork.</h6>
		</div>
		<div class="useroptions">
		

		<input class="submit" type="submit" onclick="window.location.href='loginPage.php'" value="Login"></input>

	
	
	</div>
	<div class="main">
	<?php
	$password = $_SESSION['user']['password'];
	$address = $_SESSION['user']['address'];
	$city = $_SESSION['user']['city'];
	$state = $_SESSION['user']['state'];
	$zipCode = $_SESSION['user']['zip'];

	?>
	<form method="post" action="editaccntdetails.php">
		<br>You must fill out the password and comfirm password blanks.<br>
		If you wish to keep the same password, enter it into the blanks below.<br><br>
		Please Enter New Password:
		<br>
		<input type="text" name="password" style="width:200px;"></input><br>
		<br>
		Please Confirm New Password:
		<br>
		<input type="text" name="confirmpass" style="width:200px;"></input>
		<span class="error"><br><?php echo $passError; ?></span>
		<br>
		<br>
		Please Enter Shipping Address:
		<br>
		<br>
		Street:
		<br>
		<input type="text" name="address" value="<?php echo $address;?>" style="width:200px;"></input>
		<br>
		City:
		<br>
		<input type="text" name="city" value="<?php echo $city;?>" style="width:200px;"></input>
		<br>
		State:
		<br>
		<input type="text" name="state" value="<?php echo $state;?>" style="width:200px;"></input>
		<br>
		Zipcode:
		<br>
		<input type="text" name="zip" value="<?php echo $zipCode;?>" style="width:200px;"></input>
		<br>
		<br>
		You must log back in for changes to take affect.
		<br><br><input class="submit" name="Continue" type="submit" style="width:200px;" value="Continue"></input>
		<br><br>
		</form>
		<input class="submit" name="Delete Account" type="submit"  onclick="window.location.href='deleteAccount.php'" style="width:200px;" value="Delete Account"></input>

	</div>
</body>

</html>
