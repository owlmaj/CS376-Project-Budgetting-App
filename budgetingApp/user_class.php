<?php
require('query_class.php');

class User{
    private $cost = array('cost' => 10);
    private $login_page = "login.php";   //
    private $dashboard = "index.php";    //user page after login

    private $email = "";
    private $password = "";
    private $pin = 0;
    private $isAdmin = 0;

    public function __construct($e, $p, $n){
        $this->email = $e;
        $this->password = $p;
        $this->pin = $n;
    }

    /**
     * Tries to register a user into DB
     * 
     * @param mixed $email 
     * @param mixed $password 
     * @param mixed $pin 
     */
    public function register(){
        //add default budget?

        $query = new Query();
        $result = $query->register($this->email, $this->encrypt($this->password), $this->pin, $this->isAdmin);

        if($result === true){
            header("Location: " . $this->login_page);
        }
        else{
            return false;
        }
    }

    /**
     * Tries to login a user
     * Start a session if success
     * 
     * @param mixed $email 
     * @param mixed $password 
     * @param mixed $pin 
     */
    public function login(){

        $query = new Query();
        $result = $query->authenticate($this->email, $this->encrypt($this->password), $this->pin);

        //if successful login?
        if(sizeof($result) > 0){

            session_start();
            $_SESSION["email"] = $result["email"];
            $_SESSION["isAdmin"] = $result["isAdmin"];
            header("Location: " . $this->dashboard);

            return true;    //shouldnt
        }
        else{
            //handle login fail
            //return a false if fail?
            return false;
        }
    }

    /**
     * Encrypt text
     * 
     * @param mixed $text 
     * @return string
     */
    public function encrypt($text)
    {
    	//return password_hash($text, PASSWORD_BCRYPT, $this->cost);
        //encrypt function needs work

    	return $text;
    }

    /**
     * Logs out user
     */
    public function logout(){

        //add check if not logged in?
        session_start();
        session_unset();
        session_destroy();

        //redirect to login page?
        header("Location: " . $this->login_page);
        exit();
    }
}
?>
