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
			.error{
          		color: #FF0000;
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
      $username = sanitizeString($_POST['username']);
	  $firstName = sanitizeString($_POST['firstName']);
	  $lastName = sanitizeString($_POST['lastName']);
	  $email = sanitizeString($_POST['email']);
	  $confirmEmail = sanitizeString($_POST['confirmEmail']);
      $password = sanitizeString($_POST['password']);
	  $confirmPassword = sanitizeString($_POST['confirmPass']);
	  $address = sanitizeString($_POST['address']);
	  $city = sanitizeString($_POST['city']);
	  $state = sanitizeString($_POST['state']);
	  $zipCode = sanitizeString($_POST['zip']);
	  
	  $correct = TRUE;
	  
	  if ($email != $confirmEmail) {
			$emailError = "Your email addresses do not match!";
			$correct = FALSE;
	  }
	  if ($password != $confirmPassword) {
			$passError = "Your passwords do not match!";
			$correct = FALSE;
	  }
	  if ($correct === TRUE) {
		  	$password = encrypt($password);
			require_once 'accountClass.php';
			$account = new Account($username, $email, $password, $firstName, $lastName, $address, $city, $state, $zipCode);
			header("location: loginPage.php");
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
		

		<input class="submit" type="submit" onclick="window.location.href='loginPage.php'" value="Login"></input>

	
	
	</div>
	<div class="main">
	<form method="post" action="createaccnt.php">
		Please Enter Username:
		<br>
		<input type="text" name= "username" style="width:200px;"></input>
		<br>
		<br>

		Please Enter First Name:
		<br>
		<input type="text" name= "firstName" style="width:200px;"></input>
		<br>
		<br>

		Please Enter Last Name:
		<br>
		<input type="text" name= "lastName" style="width:200px;"></input>
		<br>
		<br>

		Please Enter Email:
		<br>
		<input type="text" name= "email" style="width:200px;"></input>
		<br>
		<br>

		Please Confirm Email:
		<br>
		<input type="text" name= "confirmEmail" style="width:200px;"></input>
		<span class="error"><br><?php echo $emailError; ?></span>
		<br>
		<br>

		Please Enter Password:
		<br>
		<input type="text" name="password" style="width:200px;"></input>
		<br>
		<br>

		Please Confirm Password:
		<br>
		<input type="text" name="confirmPass" style="width:200px;"></input>
		<span class="error"><br><?php echo $passError; ?></span>
		<br>
		<br>

		Please Enter Shipping Address:
		<br>
		<br>
		Street:
		<br>
		<input type="text" name="address" style="width:200px;"></input>
		<br>
		<br>

		City:
		<br>
		<input type="text" name="city" style="width:200px;"></input>
		<br>
		<br>

		State:
		<br>
		<input type="text" name="state" style="width:200px;"></input>
		<br>
		<br>

		Zip Code:
		<br>
		<input type="text" name="zip" style="width:200px;"></input>
		<br>
		<br>
		<input class="submit" name="Continue" type="submit" style="width:200px;" value="Continue"></input>
	</form>
		
	</div>
</body>

</html>
