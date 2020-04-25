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
			.main{
				position: relative;
				border-style: solid;
				border-width:5px;
				margin: auto;
				right:5px;
				width: 100%;
				height: 1000px;
			}
			.sidebar{
				position: absolute;
				border-style: solid;
				border-width:5px;
				width: 15%;
				height: 100%;
				margin: auto;
				left:0;
				
			}
			.listingtable{
				position: absolute;
				border-style: solid;
				border-width:5px;
				width: 83.5%;
				height: 100%;
				margin: auto;
				right:0;
			}
			.addtocart{
				width: 100%;
				height:50px;
			}
			td{
				border-top-style:solid;
				border-bottom-style:solid;
				border-width:5px;
				width:18%;
				height:100px;
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
		<h3>Hello, $username</h3>

		<input class="submit" type="submit" onclick="window.location.href = 'cartview.php'" value="Cart"></input>
		
		<input class="submit" type="submit" onclick="window.location.href='logoutPage.php'" value="Logout"></input>
		<br><br>
		
		<input class="submit" type="submit" onclick="window.location.href='account.php'" value="View Account"></input>
		
		</div>
	
	</div>
	<div class="main">
		<!-- IF NOT LOGGED IN REDIRECT TO LOGIN-->
		<div class="sidebar">
			<h3 style="text-align:center;"> Search </h3>
			<input type="text" style="width:80%; margin:auto; position: relative; right:2px; left:2px;"></input>
			<input type="submit" value="search" style="width:80%; margin: auto; position: relative;  right:2px; left:2px;"></input>
			<br><br><br>
			<h3 style="text-align:center;"> Sort </h3>
			<form>
			    <select id="ascdec">
				  <option value="ascend">Ascending</option>
				  <option value="descend">Descending</option>
				</select><br>
			  <input type="radio" id="orderid" name="sort" value="orderid">
			  <label for="orderid">Order ID</label><br>
			  <input type="radio" id="orderdate" name="sort" value="orderdate">
			  <label for="price">Order Date</label><br>
			  
			  <!--IFF ADMIN-->
			  <input type="radio" id="username" name="sort" value="username">
			  <label for="username">Username/*ONLY IF ADMIN*/</label><br>
			</form>
		</div>
		<div class="listingtable">
			<table class="actualtable">
				
				<tr>
					<td class="orderid">Order ID</td>
					<td class="orderdate">Order Date</td>
					<!--IFF ADMIN-->
					<td class="username">Username<br>/*ONLY IF ADMIN*/</td>
					<!--end admin-->
					<td class="itemcount">Number of Items</td>
					<td class="orderdetails">Order Details</td>
					<td class="ordertotal">Order Total Price</td>
					<td class="carttable"><input class="addtocart" type="submit" onclick="window.location.href = 'vieworderid.php'" value="View Order"></input></td>
				</tr>				
				
			</table>
		</div>
	</div>
</body>

</html>
