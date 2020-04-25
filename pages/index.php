<?php 
		session_start();
		if(!isset($_SESSION['user'])) {
			header('location: loginPage.php');
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
				width:20%;
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

		<input class="submit" type="submit" onclick="window.location.href = 'cartview.php'" value="Cart"></input>
		
		<input class="submit" type="submit" onclick="window.location.href='logoutPage.php'" value="Logout"></input>
		<br><br>
		<input class="submit" type="submit" onclick="window.location.href='account.php'" value="View Account"></input>
		
		<input class="submit" type="submit" onclick="window.location.href='vieworders.php'" value="View Orders"></input>
		
		</div>
	
	</div>
	<div class="main">
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
			  <input type="radio" id="name" name="sort" value="name">
			  <label for="name">Name</label><br>
			  <input type="radio" id="price" name="sort" value="price">
			  <label for="price">Price</label><br>
			  <input type="radio" id="artist" name="sort" value="artist">
			  <label for="artist">Artist</label>
			</form>
		</div>
		<div class="listingtable">
		<?php
			require_once('login.php');
				
			$conn = new mysqli($hn, $un, $pw, $db);
			
			if($conn->connect_error)
				die($conn->connect_error);
				
			echo "<table class='actualtable'>";
				$query = "SELECT * FROM art";
				$result = $conn->query($query);
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				echo "<tr> <td class='image'>";
				echo "<img src=".$row['photo']."alt='Picture of Art' width='100%'></td>"; // This is what isn't exactly correct
					echo "<td class='artname'>".$row['title']."</td>";
					//<td class="artname">Artname</td>
					echo "<td class='artistname'>".$row['artist']."</td>";					
					//<td class="artistname">Artist</td>
					
//					<td class="artdesc">description</td>
					echo "<td class='artprice'>".$row['price']."</td>";
//					<td class="artprice">Price</td>
					$artID = $row['artID'];
					echo "<td class='carttable'><input class='addtocart' type='submit' onclick=\"window.location.href = 'itemview.php?ID=$artID'\" value='View Item'></input><br><input class='addtocart' type='submit' value='Add to Cart'></input></td>
				</tr>";
				}					
				echo "</table>";
			?>
		</div>
	</div>
</body>

</html>
