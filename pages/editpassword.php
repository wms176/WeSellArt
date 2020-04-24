<?php 
		if(!isset($_SESSION['user'])) {
			echo "<span class='error'>Please Login to access this page.</span>";
			echo "<br><br><a href='login_page.php'>Login</a>";
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
	<div class="header">
		<div class="title">
		<a href="index.html" ><h1>WeSellArt.com</h1></a>
		<h3>We here at WeSellArt.com are dedicated to selling you quality* art at unreasonable prices.</h3>
		<h6>*We do not ensure the quality of any artwork.</h6>
		</div>
		<div class="useroptions">
		

		<input class="submit" type="submit" onclick="window.location.href='login.html'" value="Login"></input>

	
	
	</div>
	<div class="main">
		<h3>Please Confirm Current Password:</h3>
		<br>
		<input type="text" style="width:200px;"></input>
		<br>
		<h3>Please Enter New Password:</h3>
		<br>
		<input type="text" style="width:200px;"></input>
		<br>
		<h3>Please Confirm New Password:</h3>
		<br>
		<input type="text" style="width:200px;"></input>
		<br>
		<br>
		<input class="submit" type="submit" style="width:200px;" onclick="window.location.href='account.html'" value="Continue"></input>
		
	</div>
</body>

</html>
