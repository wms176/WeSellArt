<?php 
     session_start();
     require_once 'login.php';
     $connection = new mysqli($hn, $un, $pw, $db);
 
     if (isset($_SESSION['user']) && $_SESSION['user']['admin'] === TRUE ) {
       header('location: index.php'); // replace with admin homepage
     }
 
     if (isset($_SESSION['user']) && $_SESSION['user']['admin'] === FALSE ) {
       header('location: index.php');
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
			.title{
				align: left;
				position: absolute;
				left: 5px;
			}
			.error{
          		color: #FF0000;
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
				text-align:center;
			}
			
			
		</style>
  
</head>

<body>
	<?php
		if(isset($_POST['loginButton'])){
			$myUsername = sanitizeString($_POST['username']);
    		$myPassword = sanitizeString($_POST['password']);

			$token = encrypt($myPassword);
			  
			require_once 'login.php';
    		$connection = new mysqli($hn, $un, $pw, $db);
      
      		$query = "SELECT * FROM users WHERE username= '$myUsername' AND password= '$token' LIMIT 1"; // change $myPassword to $token to encrypt
      		$result = $connection->query($query);
     
      		if (mysqli_num_rows($result) == 1) {
       			$logged_in_user = mysqli_fetch_assoc($result);
          		$_SESSION['user'] = $logged_in_user;
          		$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
				
      		} else {
        		$loginError = "Wrong username/password combination";
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
		We here at WeSellArt.com are dedicated to selling you quality* art at unreasonable prices.
		<h6>*We do not ensure the quality of any artwork.</h6>
		</div>
		<div class="useroptions">
		
		
		<input class="submit" type="submit" onclick="window.location.href='createaccnt.php'" value="Create Account"></input>
		
		</div>
	
	</div>
	<div class="main">
	<form method="post" action="loginPage.php">
		Please Enter Username:
		<br>
		<input type="text" name = "username" style="width:200px;"></input>
		<br>
		Please Enter Password:
		<br>
		<input type="text" name = "password" style="width:200px;"></input>
		<br>
		<br>
		<span class="error"><?php echo $loginError; ?></span>
		<input class="submit" type="submit" name = "loginButton" style="width:200px;" value="Login"></input>
		</form>
	</div>
</body>

</html>
