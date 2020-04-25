<?php 

class Account {
    private $userID;
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

    public function __Construct($username, $email, $password, $firstName, $lastName, $address, $city, $state, $zipCode){
        $this->userID = NULL; 
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->password = encrypt($password);
        $this->email = $email;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->admin = NULL;
        
        require_once 'login.php';
        $connection = new mysqli($hn, $un, $pw, $db);
        if ($connection->connect_error)
            die($connection->connect_error);
		$query = "INSERT INTO users (username, email, password, 
            firstName, LastName, address, city, state, zip) 
            VALUES ('$username', '$email', '$password', '$firstName', '$lastName', '$address', '$city', '$state', '$zipCode')";
        $result = $connection->query($query);
        if (!$result)
            die($connection->error);
    }
    
    public function encrypt($pass) {
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        $token = hash('ripemd128', "$salt1$pass$salt2");
        return $token;
    }

    public function deleteAccount($username) {
        require_once 'login.php';
        $connection = new mysqli($hn, $un, $pw, $db);
        $query = "DELETE * from users WHERE username = '$username'";
        $connection->query($query);    }

    public function editAccount($username, $firstName, $lastName, $email, $address, $city, $state, $zipCode) {
        require_once 'login.php';
        $connection = new mysqli($hn, $un, $pw, $db);
        $query = "UPDATE users SET firstName = '$firstname', lastName = '$lastName', email = '$email', address = '$address', city = '$city', state = '$state', zip = '$zipCode' WHERE username = '$username'";
        $connection->query($query);    }

    public function changePassword($username, $password) {
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        $token = hash('ripemd128', "$salt1$Password$salt2");
        require_once 'login.php';
        $connection = new mysqli($hn, $un, $pw, $db);

        $query = "UPDATE users SET password = '$token' WHERE username = '$username'";
        $result = $connection->query($query);    }
}