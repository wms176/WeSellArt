<?php


class Cart{
	//cartID should always equal the corresponding userID.
	private $cartID;
	private $userID;
	private $total;
	private $items;
	private $conn;
	
	//A note about Architecture: items is a json formatted list, where the keys specify ArtId's and the values specify quantities.
	
	//note that this constructor queries the database on the provided cartID,
	//and populates the other methods using it.
	//initialize with -1 to not do this.
	public function __construct($cartID){
		require_once('login.php');
		$this->conn = new mysqli($hn, $un, $pw, $db);
			
		if($this->conn->connect_error)
			die($this->conn->connect_error);
		if($cartID != -1){			
			$query = "SELECT * FROM cart WHERE cartID = '$cartID'";
			$result = $this->conn->query($query);
			if($result == FALSE){
				return FALSE;
			}
			while($row = $result->fetch_array()){
				$this->cartID = $row['cartID'];
				$this->userID = $row['userID'];
				$this->total = $row['total'];
				$this->items = $row['items'];
				
			}
		}
		if($cartID == -1){
			$this->items = array();
		}
		return TRUE;
	}
	
	//takes all of the elements, determines if there is enough of each artwork to fulfill the order, and returns a boolean indicating if checkout was successful.
	//also zereos out total and items for this class, and inserts an order with the prescribed methods.
	//Assumes authentication has already been done.
	public function checkout(){
		$itemarray = json_decode($this->items, TRUE);
		$ids = array_keys($itemarray);
		require_once("orderClass.php");
		
		//purpose of loop: to check and make sure theres anough of each artwork to satisfy the order.
		for($i = 0; $i<sizeof($itemarray);$i++){
			$query = "SELECT quantity FROM art WHERE artID = $ids[$i]";
			$result = $this->conn->query($query);
			if($result != FALSE){;
				$result = $result->fetch_array();
				//if this loop passes, then NOT theres enough of that item to satisfy the order., so return false.
				if(!($result['quantity'] >= $itemarray[$ids[$i]])){
					return FALSE;
				}
			}
		}
		//second loop in order to update quantities.
		for($i = 0; $i<sizeof($itemarray);$i++){
			$quantity = $itemarray[$ids[$i]];
			$id = $ids[$i];
			$query = "UPDATE art SET quantity=(quantity - $quantity) WHERE artID = $id";
			$result = $this->conn->query($query);
			if($result == FALSE){
				return FALSE;
			}
		}
		//final obligations.
		$query = "INSERT INTO orders (timeoforder,userID, itemsBought) VALUES (now() , $this->userID ,'$this->items')";
		$return = $this->conn->query($query);
		if(!$return){
			echo("Error description: " . $this->conn->error);
		}
		$orderID = $this->conn->insert_id;
		$this->items = array();
		$this->total = 0;
		return $orderID;
	}
	
	
	//ALTERED FROM DESIGN DOC FOR EASE OF USE.
	//takes in all of the current info from the class and creates an entry in the database.
	//necessitates reinitialization to get new data like timestamp or orderID.
	public function createCart(){
		$query = "INSERT INTO cart (cartID,userID, total, items) VALUES ($this->cartID, $this->userID ,$this->total,'$this->items')";
		$return = $this->conn->query($query);
		if(!$return){
			echo ("Query is: $query");
			echo("Error description: " . $this->conn->error);
		}
		return $return;
	}
	
	//updates db entry for cart
	public function updateCart(){
		$query = "UPDATE cart SET userID = $this->userID, total = $this->total, items = '$this->items' where cartID = $this->cartID";
		$return = $this->conn->query($query);
		if(!$return){
			echo("Error description: " . $this->conn->error);
		}
		return $return;
	}
	

	//adds an item to the cart. If element already exists, ups quantity by one.
	public function addItem($artID){
		$itemarray = json_decode($this->items,TRUE);
		
		/*
		print_r($itemarray);
		echo("artid: $artID");
		*/
		if(array_key_exists($artID,$itemarray)){
			$itemarray[$artID] = $itemarray[$artID] + 1;
		}else{
			$itemarray[$artID] = 1;
		}
		$this->items = json_encode($itemarray);
	}
	
	//removes item specified by artID from cart.
	public function removeItem($artID){
		$itemarray = json_decode($this->items, TRUE);
		unset($itemarray[$artID]);
		$this->items = json_encode($itemarray);
	}
	
	//updates the quantity of $artID in cart to $quantiy.
	public function updateQuantity($artID, $quantity){
		$itemarray = json_decode($this->items, TRUE);
		$itemarray[$artID] = $quantity;
		$this->items = json_encode($itemarray);	
	}
	//updates total to reflect items encoded in items.
	//Note that this only updates the local value. call updateCart if it needs to update the db.
	public function updateTotal(){
		$newtotal = 0;
		$itemarray = json_decode($this->items, TRUE);
		$ids = array_keys($itemarray);
		for($i = 0; $i<sizeof($itemarray);$i++){
			$query = "SELECT price FROM art WHERE artID = $ids[$i]";
			$result = $this->conn->query($query);
			if($result != FALSE){;
				$result = $result->fetch_array();
				$newtotal += ($result['price']*$itemarray[$ids[$i]]);
			}
		}
		$this->total = $newtotal;
	}
		
	
	public function getuserID(){
		return $this->userID;
	}
	

	public function setuserID($userID){
		$this->userID = $userID;
	}
	
	public function getcartID(){
		return $this->cartID;
	}
	

	public function setcartID($cartID){
		$this->cartID = $cartID;
	}
	
	public function getitems(){
		return $this->items;
	}
	

	public function setitems($items){
		$this->items = $items;
	}

	public function getTotal(){
		return $this->total;
	}
	
	public function setTotal($value){
		$this->total = $value;
	}
	
	
}
?>