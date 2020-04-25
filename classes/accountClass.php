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

    public function __construct(){ 
        $this->userID = $userID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->password = hash('ripemd128', "$salt1$password$salt2");
        $this->email = $email;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->admin = $admin;	
    }
                

    public function isAdmin() {
        if ($this->admin === TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function setAccount($username, $email, $password, $firstName, $lastName, $address, $city, $state, $zipCode){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->password = hash('ripemd128', "$password");
        $this->email = $email;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->admin = FALSE;
    }

    public function createAccount(){
        require_once 'login.php';
        $connection = new mysqli($hn, $un, $pw, $db);
		$query = "INSERT INTO users (username, email, password, 
            firstName, LastName, address, city, state, zip, admin) 
            VALUES ($this->username, $this->email, $this->password, 
            $this->firstName, $this->lastName, $this->address, $this->city, 
            $this->state, $this->zipCode, $this->admin)";
        $result = $connection->query($query);
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