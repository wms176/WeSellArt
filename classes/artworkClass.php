<?php
class Artwork{
	private $artID;
	private $artTitle;
	private $artist;
	private $artCreationDate;
	private $artMedium;
	private $artPrice;
	private $artQuantity;
	private $conn;
	
	//note that this constructor queries the database on the provided ArtID,
	//and populates the other methods using it.
	//initialize with -1 to not do this.
	public function __construct($artID){
		require_once('login.php');
		$this->conn = new mysqli($hn, $un, $pw, $db);
			
		if($this->conn->connect_error)
				die($this->conn->connect_error);
		if($artID != -1){
			$query = "SELECT * FROM art WHERE artID = '$artID'";
			$result = $this->conn->query($query);
			while($row = $result->fetch_array()){
				$this->artID = $artID;
				$this->artTitle = $row['title'];
				$this->artist = $row['artist'];
				$this->artCreationDate = $row['creationDate'];
				$this->artMedium = $row['media'];
				$this->artPrice = $row['price'];
				$this->artQuantity = $row['quantity'];	
			}
		}
	}
	
	//updates price based on the local value of price and artid, and pushes it to the DB.
	public function updatePrice(){
		$price = $this->artPrice;
		$id = $this->artID;
		
		$sqlquery = "UPDATE art SET price = $price where artID = $id";
		$result = $this->conn->query($sqlquery);
		return $result;
		
	}
	
	//updates quantity based on the local value of price and artid, and pushes it to the DB.
	public function updateQuantity(){
		$price = $this->artPrice;
		$artID = $this->artID;
		$query = "UPDATE art SET price=$price WHERE artID = $artID";
		return $this->conn->query($query);
		
	}
	
	//All of the getters and setters. Don't @ me.
	
	public function getID(){
		return $this->artID;
	}
	
	//I don't think we should need this, but its here anyway.
	public function setID($artID){
		$this->artID = $artID;
		
	}
	
	//title
	public function getTitle(){
		return $this->artTitle;
	}
	
	public function setTitle($artTitle){
		$this->artTitle = $artTitle;
	}
	
	//artist
	public function getArtist(){
		return $this->artist;
	}
	
	public function setArtist($artist){
		$this->artist = $artist;
	}
	
	//artdate
	public function getArtDate(){
		return $this->artCreationDate;
	}
	
	public function setArtDate($artCreationDate){
		$this->artCreationDate = $artCreationDate;
	}
	
	//art medium
	public function getMedium(){
		return $this->artMedium;
	}
	
	public function setMedium($artMedium){
		$this->artMedium = $artMedium;
	}
	
	//price
	public function getPrice(){
		return $this->artPrice;
	}
	
	public function setPrice($artPrice){
		$this->artPrice = $artPrice;
	}
	//quantity
	public function getQuantity(){
		return $this->artQuantity;
	}
	
	public function setQuantity($artQuantity){
		$this->artQuantity = $artQuantity;
	}
}
?>