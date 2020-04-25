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
			.editsubmit{
				height: 50px;
				width: 300px;
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
			.info{
				left:20px;
				position:absolute;
				margine:auto;
			}
			
		</style>
  
</head>

<body>
	<div class="header">
		<div class="title">
		<a href="index.php" ><h1>WeSellArt.com</h1></a>
		<h3>We here at WeSellArt.com are dedicated to selling you quality* art at unreasonable prices.</h3>
		<h6>*We do not ensure the quality of any artwork.</h6>
		</div>
		<div class="useroptions">
		
		<!--IF NOT LOGGED IN:
		<input class="submit" type="submit" value="Login"></input>-->
		<!--IF LOGGED IN:-->
		<h3>Hello, <?php echo $_SESSION['user']['username']?></h3>

		<input class="submit" type="submit" onclick="window.location.href = 'cartview.php'" value="Cart"></input>
		
		<input class="submit" type="submit" onclick="window.location.href='logoutPage.php'" value="Logout"></input>
		<br><br>
		
		<input class="submit" type="submit" onclick="window.location.href='vieworders.php'" value="View Orders"></input>
		
		</div>
	
	</div>
	<div class="main">
	<div class="info">
		<!-- IF NOT LOGGED IN REDIRECT TO LOGIN-->
		<h2><?php echo $_SESSION['user']['username']?>'s Account:</h2>
		<br>
		<h3>Name:</h3>
		<p><?php echo $_SESSION['user']['firstName']?> <?php echo $_SESSION['user']['lastName']?></p>
		<br>
		<h3>Email:</h3>
		<p><?php echo $_SESSION['user']['email']?></p>
		<br>
		<h3>Shipping Address:</h3>
		<p><?php echo $_SESSION['user']['address']?><br><?php echo $_SESSION['user']['city']?>, <?php echo $_SESSION['user']['state']?><br><?php echo $_SESSION['user']['zipCode']?> </p>
		<br>
		<input class="editsubmit" type="submit" onclick="window.location.href='editaccntdetails.php'" value="Edit Account"></input>
		<br>
		
	</div>
	</div>
</body>

</html>
