<?php
//All utility of the viewOrder method was present elsewhere, so I removed it.

//CLASS NOT YET DEBUGGED.


class Order{
	private $orderID;
	private $timeStamp;
	private $itemsBought;
	private $userID;
	private $conn;
	
	//note that this constructor queries the database on the provided orderID,
	//and populates the other methods using it.
	//initialize with -1 to not do this.
	public function __construct($orderID){
		require_once('login.php');
		$this->conn = new mysqli($hn, $un, $pw, $db);
			
		if($this->conn->connect_error)
			die($this->conn->connect_error);
		if($orderID != -1){			
			$query = "SELECT * FROM orders WHERE orderID = '$orderID'";
			$result = $this->conn->query($query);
			while($row = $result->fetch_array()){
				$this->orderID = $row['orderID'];
				$this->timeStamp = $row['timeoforder'];
				$this->userID = $row['userID'];
				$this->itemsBought = $row['itemsBought'];
				
			}
		}
	}
	
	//ALTERED FROM DESIGN DOC FOR EASE OF USE.
	//takes in all of the current info from the class and creates an entry in the database.
	//requires reinitialization to get new data like timestamp or orderID.
	//returns the ID of the inserted function.
	public function insertOrder(){
		$userID = $this->userID;
		$itemsBought = $this->itemsBought;

		$query = "INSERT INTO orders (timeoforder,userID, itemsBought) VALUES (now() , $this->userID ,'$itemsBought')";
		$return = $this->conn->query($query);
		if(!$return){
			echo("Error description: " . $this->conn->error);
		}
		return $this->conn->insert_id;
	}
	
	//returns an array of all OrderId's 
	public function viewOrderList(){
		$query = "SELECT orderID FROM orders";
		$response = $this->conn->query($query);
		$iterator = 0;
		$orderlist = array();
		while($row = $response->fetch_array()){
			//$orderlist[$iterator] = $row['orderID'];
			array_push($orderlist, $row['orderID']);
			$iterator++;
		}
		return $orderlist;
	}
	
	//returns an array of all OrderId's matching the provided UserID.
	public function searchByAccount($userID){
		$query = "SELECT orderID FROM orders WHERE userID = '$userID'";
		$response = $this->conn->query($query);
		$iterator = 0;
		$orderlist = array();
		while($row = $response->fetch_array()){
			//$orderlist[$iterator] = $row['orderID'];
			array_push($orderlist, $row['orderID']);
			$iterator++;
		}
		return $orderlist;
	}
	
	//returns all OrderId's within the date range between timestamp1 and timestamp2. 
	//in compliance with the design doc, returns all in the date range, regardless of user.
	public function searchByDate($timestamp1,$timestamp2){
		$query = "SELECT orderID FROM orders WHERE timeoforder >= $timestamp1 AND timeoforder <= $timestamp2";
		$response = $this->conn->query($query);
		$iterator = 0;
		$orderlist = array();
		while($row = $response->fetch_array()){
			//$orderlist[$iterator] = $row['orderID'];
			array_push($orderlist, $row['orderID']);
			$iterator++;
		}
		return $orderlist;
	}
		
		

	
	public function getuserID(){
		return $this->userID;
	}
	

	public function setuserID($userID){
		$this->userID = $userID;
	}
	
	public function getorderID(){
		return $this->orderID;
	}
	

	public function setorderID($orderID){
		$this->orderID = $orderID;
	}
	
	public function getitemsBought(){
		return $this->itemsBought;
	}
	

	public function setitemsBought($itemsBought){
		$this->itemsBought = $itemsBought;
	}
	
	public function gettimeStamp(){
		return $this->timeStamp;
	}
	
	
}
?>