<?php 

class Account {
    private $accountID;
    private $firstName;
    private $lastName;
    private $username;
    private $password;
    private $token;
    private $email;
    private $address;
    private $city;
    private $state;
    private $zipCode;
    private $admin;

    private $token;
    private $salt1;
    private $salt2;

        require_once 'login.php';
        $connection = new mysqli($hn, $un, $pw, $db);

        $salt1    = "qm&h*";
        $salt2    = "pg!@";

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->password = hash('ripemd128', "$salt1$password$salt2")
        $this->email = $email;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->admin = $admin;
        
        $token = $this->password;

        $query = "INSERT INTO users (username, email, password, firstName, LastName, address, city, state, zip, admin) VALUES ($username, $email, $token, $firstName, $lastName, $address, $city, $state, $zipCode, $admin)";
        $result = $connection->query($query);

        public function __construct($userID){
            require_once('login.php');
            $this->conn = new mysqli($hn, $un, $pw, $db);

            $this->token = hash('ripemd128', "$this->salt1$this->Password$this->salt2");
                
            if($this->conn->connect_error)
                    die($this->conn->connect_error);
            if($userID != -1){
                $query = "SELECT * FROM users WHERE userID = '$userID'";
                $result = $this->conn->query($query);
                while($row = $result->fetch_array()){
                    $this->userID = $userID;
                    $this->firstName = $row['firstName'];
                    $this->lastName = $row['lastName'];
                    $this->username = $row['username'];
                    $this->password = $row['password'];
                    $this->email = $row['email'];
                    $this->address = $row['address'];
                    $this->city = $row['city'];
                    $this->state = $row['state'];
                    $this->zipCode = $row['zipCode'];
                    $this->admin = $row['admin'];	
                }
            }
        }
    }

    function isAdmin() {
        if ($this->admin === TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function createAccount(){
		$query = "INSERT INTO users (userID, username, email, password, 
            firstName, LastName, address, city, state, zip, admin) 
            VALUES ($this->userID, $this->username, $this->email, $this->token, 
            $this->firstName, $this->lastName, $this->address, $this->city, 
            $this->state, $this->zipCode, $this->admin)";

		$return = $this->conn->query($query);
		if(!$return){
			echo ("Query is: $query");
			echo("Error description: " . $this->conn->error);
		}
		return $return;
	}

    function deleteAccount($username) {
        $query = "DELETE * from users WHERE username = '$username'";
        $result = $this->conn->query($query);    }

    function editAccount($username, $firstName, $lastName, $email, $address, $city, $state, $zipCode,) {
        $query = "UPDATE users SET firstName = '$firstname', lastName = '$lastName', email = '$email', address = '$address', city = '$city', state = '$state', zip = '$zipCode' WHERE username = '$username'";
        $result = $this->conn->query($query);    }

    function changePassword($username, $password) {
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        $token = hash('ripemd128', "$salt1$Password$salt2");

        $query = "UPDATE users SET password = '$token' WHERE username = '$username'";
        $result = $this->conn->query($query);    }
}