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
	<?php
    	if(isset($_POST['submit'])){
			



	?>
	<div class="header">
		<div class="title">
		<a href="index.php" ><h1>WeSellArt.com</h1></a>
		<h3>We here at WeSellArt.com are dedicated to selling you quality* art at unreasonable prices.</h3>
		<h6>*We do not ensure the quality of any artwork.</h6>
		</div>
		<div class="useroptions">
		

		<input class="submit" type="submit" onclick="window.location.href='login.php'" value="Login"></input>

	
	
	</div>
	<div class="main">
		<h3>Please Enter Username:</h3>
		<br>
		<input type="text" name= "username" style="width:200px;"></input>
		<br>
		<h3>Please Enter First Name:</h3>
		<br>
		<input type="text" name= "firstName" style="width:200px;"></input>
		<br>
		<h3>Please Enter Last Name:</h3>
		<br>
		<input type="text" name= "lastName" style="width:200px;"></input>
		<br>
		<h3>Please Enter Email:</h3>
		<br>
		<input type="text" name= "email" style="width:200px;"></input>
		<br>
		<h3>Please Confirm Email:</h3>
		<br>
		<input type="text" name= "confirmEmail" style="width:200px;"></input>
		<br>
		<h3>Please Enter Password:</h3>
		<br>
		<input type="text" name="password" style="width:200px;"></input>
		<br>
		<h3>Please Confirm Password:</h3>
		<br>
		<input type="text" name="confirmPass" style="width:200px;"></input>
		<br>
		<br>
		<input class="submit" name="Continue" type="submit" style="width:200px;" onclick="window.location.href='editaccntdetails.php'" value="Continue"></input>
		
	</div>
</body>

</html>
