<?php

// a class for querying the inventory.
//Search by ID ommitted due to a change in architecture.
class Inventory{
	private $conn;
	
	public function __construct(){
		require_once('login.php');
		$this->conn = new mysqli($hn, $un, $pw, $db);
			
		if($this->conn->connect_error)
			die($this->conn->connect_error);
		
	}
	//returns a list of all the art pieces in the inventory.
	public function getArtInventory(){
		$query = "SELECT artID FROM art";
		$response = $this->conn->query($query);
		$iterator = 0;
		$artlist = array();
		
		while($row = $response->fetch_array()){
			array_push($artlist,$row['artID']);
			$iterator++;
		}
		return $artlist;
	}
	
	//returns a list of artworks that have the provided title in the title.
	//A primitive search, but good enough.
	public function searchArtwork($title){
		$query = "SELECT artID FROM art WHERE title LIKE '%$title%'";
		$response = $this->conn->query($query);
		$iterator = 0;
		$artlist = array();
		while($row = $response->fetch_array()){
			array_push($artlist,$row['artID']);
			$iterator++;
		}
		return $artlist;
	}
	
	public function filterByArtist($artist){
		$query = "SELECT artID FROM art WHERE artist LIKE '%$artist%'";
		$response = $this->conn->query($query);
		$iterator = 0;
		$artlist = array();
		while($row = $response->fetch_array()){
			array_push($artlist,$row['artID']);
			$iterator++;
		}
		return $artlist;
	} 
	
	public function filterByMedium($medium){
		$query = "SELECT artID FROM art WHERE artist LIKE '%$medium%'";
		$response = $this->conn->query($query);
		$iterator = 0;
		$artlist = array();
		while($row = $response->fetch_array()){
			array_push($artlist,$row['artID']);
			$iterator++;
		}
		return $artlist;
	} 
	
	//Art ID ommitted due to it being made sequential in the db.
	public function addArtwork($price, $medium, $quantity, $title, $artist){
		//"INSERT INTO art (artist,title,media,price, quantity) VALUES ("uhhhh","The Defense of Rorkes Drift","pastel on tile.",197,398)
		$query = "INSERT INTO art (artist,title,media,price, quantity) VALUES ('$artist', '$title', '$medium', $price, $quantity)";
		$result =  $this->conn->query($query);
		return $result;
	}
}
?>