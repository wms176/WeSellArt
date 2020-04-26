<?php 
		session_start();
		if(!isset($_SESSION['user'])) {
			header('location: loginPage.php');
		}	  
		else {
			$user = $_SESSION['user']['username'];
		}
		$search=$_GET['search'];

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
				width:30%;
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
		<?php 
			$query = "SELECT * FROM art WHERE title like '%$search%' ORDER BY '$sort';" 
			
		?>
		<div class="sidebar">
			<form method="GET" action="index.php">
			<h3 style="text-align:center;"> Search </h3>
			<input type="text" name="search" searchstyle="width:80%; margin:auto; position: relative; right:2px; left:2px;"></input>
			<input type="submit" value="search" style="width:80%; margin: auto; position: relative;  right:2px; left:2px;"></input>
			<br><br><br>
			<!--<h3 style="text-align:center;"> Sort </h3>
			
			    <select name="ascdec" id="ascdec">
				  <option value="ASC">Ascending</option>
				  <option value="DESC">Descending</option>
				</select><br>
			  <input type="radio" id="name" name="sort" value="artTitle">
			  <label for="name">Name</label><br>
			  <input type="radio" id="price" name="sort" value="artPrice">
			  <label for="price">Price</label><br>
			  <input type="radio" id="artist" name="sort" value="artist">
			  <label for="artist">Artist</label>
			  <input type="submit"style="width:80%; margin: auto; position: relative;  right:2px; left:2px;"></input>-->
			</form>
		</div>
		<div class="listingtable">
		<?php
			require_once('login.php');
				
			$conn = new mysqli($hn, $un, $pw, $db);
			
			if($conn->connect_error)
				die($conn->connect_error);
				
			echo "<table class='actualtable'>";

				
				$result = $conn->query($query);
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				echo "<tr><th>Image</th><th>Title</th><th>Artist</th><th>Price</th></tr>";
				$photo = $row['photo'];
				echo "<tr> <td class='image'>";
				echo "<img src='$photo' alt='Picture of Art' width='100%'></td>";
					echo "<td class='artname'>".$row['title']."</td>";
					//<td class="artname">Artname</td>
					echo "<td class='artistname'>".$row['artist']."</td>";					
					//<td class="artistname">Artist</td>
					
//					<td class="artdesc">description</td>
					echo "<td class='artprice'>".$row['price']."</td>";
//					<td class="artprice">Price</td>
					$artID = $row['artID'];
					echo "<td class='carttable'><input class='addtocart' type='submit' onclick=\"window.location.href = 'itemview.php?ID=$artID'\" value='View Item'></input>";
					if($_SESSION['user']['admin'] == 0)
						echo "<br><input class='addtocart' type='submit' value='Add to Cart'></input></td></tr>";
				}					
				echo "</table>";
			?>
		</div>
	</div>
</body>

</html>
