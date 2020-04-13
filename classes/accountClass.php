<?php 

class Account {
    public $accountID;
    public $firstName;
    public $lastName;
    private $username;
    private $password;
    public $email;
    public $address;
    public $city;
    public $state;
    public $zipCode;
    private $admin;

    function __construct($firstName, $lastName, $username, $password, $email, $address, $city, $state, $zipCode, $admin) {
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

        $query = "INSERT INTO users (username, email, password, firstName, LastName, address, city, state, zip, admin) VALUES ($accountID, $username, $email, $token, $firstName, $lastName, $address, $city, $state, $zipCode, $admin)";
        $result = $connection->query($query);

        $query = "SELECT userID FROM users WHERE username= '$username'";
        $this->accountID = $connection->query($query);
    }

    function isAdmin() {
        if ($this->admin == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    function deleteAccount($username) {
        require_once 'login.php';
        $connection = new mysqli($hn, $un, $pw, $db);

        $query = "DELETE * from users WHERE username = '$username'";
        $result = $connection->query($query);
    }

    function editAccount($username, $firstName, $lastName, $email, $address, $city, $state, $zipCode,) {
        require_once 'login.php';
        $connection = new mysqli($hn, $un, $pw, $db);

        $query = "UPDATE users SET firstName = '$firstname', lastName = '$lastName', email = '$email', address = '$address', city = '$city', state = '$state', zip = '$zipCode' WHERE username = '$username'";
        $result = $connection->query($query);
    }

    function changePassword($username, $password) {
        require_once 'login.php';
        $connection = new mysqli($hn, $un, $pw, $db);

        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        $token = hash('ripemd128', "$salt1$Password$salt2");

        $query = "UPDATE users SET password = '$token' WHERE username = '$username'";
        $result = $connection->query($query);
    }
}