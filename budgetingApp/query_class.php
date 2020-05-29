<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
class Query{
    private $server_name = "localhost";
    private $username = "zorn200j"; //replace these
    private $password = "skstorm";
    private $db_name = "zorn200j";

    private $db;    //connection to db
    private $user_table_name = "user_logins";
    private $budget_table_name = "user_budgets";

    //public function __construct(){}

    /**
     * Checks user credentials
     * Password must be hashed
     *
     * @param string $email
     * @param string $pass
     * @param string $pin
     */
    public function authenticate($email, $pass, $pin){

        $this->connect();

        $q = "SELECT * FROM " . $this->user_table_name
            . " WHERE email='" . $this->escape($email) . "'"
            . " AND password='" . $this->escape($pass) . "'"
            . " AND pin=" . $this->escape($pin);

        $r = $this->db->query($q);
        $result = array();

        if($r->num_rows > 0){
            $row = $r->fetch_assoc();
            $result["email"] = $row["email"];
            $result["isAdmin"] = $row["isAdmin"];
        }
        //else return empty array

        $this->db->close();
        return $result;
    }

    /**
     * Inserts new user into database
     *
     * @param string $email
     * @param string $pass
     * @param int $pin
     * @param boolean $admin
     * @return boolean
     */
    public function register($email, $pass, $pin, $admin){

        $this->connect();
        
        $email = $this->escape($email);
        //$pass = $this->escape($pass);     //possibly not needed if password is hashed?
        $pin = $this->escape($pin);

	$q1 = "INSERT INTO user_logins(email, password, isAdmin, pin) VALUES ('$email', '$pass', ".$admin.", ".$pin.")";
        $r1 = $this->db->query($q1);
	
	$r2 = false;
	if($r1 != false){
        $q2 = "INSERT INTO " . $this->budget_table_name . "(email) VALUES ('$email')";
        $r2 = $this->db->query($q2);
	}	

        $this->db->close();

		if($r1 === true && $r2 === true){
			return true;
		}
		else{
			return false;
		}
    }

    /**
     * Gets 2D array of all user budget percentages
     *
     * @return array[]
     */
    public function getAllUserBudgets(){

        $this->connect();

        $q = "SELECT entertainment, housing, recreation, nutrition, transportation, workstudy, savings, other FROM " . $this->budget_table_name;
        $r = $this->db->query($q);
        $result = array();

        if($r->num_rows > 0){
            while($row = $r->fetch_assoc()){
                $temp = array(
                    "entertainment" => $row["entertainment"],
                    "housing" => $row["housing"],
                    "recreation" => $row["recreation"],
                    "nutrition" => $row["nutrition"],
                    "transportation" => $row["transportation"],
                    "workstudy" => $row["workstudy"],
                    "savings" => $row["savings"],
                    "other" => $row["other"]
                    );

                $result[] = $temp;
            }
        }
        else{
            //handle error
            //return empty array
        }

        $this->db->close();

        return $result;
    }

    /**
     * Query budget data using email
     *
     * @param string $email
     * @return array
     */
    public function getUserBudget($email){

        $this->connect();

        $q = "SELECT * FROM " . $this->budget_table_name . " WHERE email='" . $this->escape($email) . "'";
        $r = $this->db->query($q);
        $result = array();

        if($r->num_rows > 0){
            while($row = $r->fetch_assoc()){
                $result["email"] = $row["email"];
                $result["totalMonthlyIncome"] = $row["totalMonthlyIncome"];
                $result["currentMonthlyIncome"] = $row["currentMonthlyIncome"];
                $result["entertainment"] = $row["entertainment"];
                $result["housing"] = $row["housing"];
                $result["recreation"] = $row["recreation"];
                $result["nutrition"] = $row["nutrition"];
                $result["transportation"] = $row["transportation"];
                $result["workstudy"] = $row["workstudy"];
                $result["savings"] = $row["savings"];
                $result["other"] = $row["other"];
            }
        }

        $this->db->close();

        return $result;
    }

    /**
     * Updates user budget
     * Require assoc array of budgets
     *
     * @param string $email
     * @param array $new_budget
     * @return boolean
     */
    public function updateBudget($email, $new_budget){

        //$old_budget = $this->getUserBudget($email);

        $this->connect();

        $q = "UPDATE " . $this->budget_table_name
            . " SET totalMonthlyIncome=" . $this->escape($new_budget["totalMonthlyIncome"])
            . ", currentMonthlyIncome=" . $this->escape($new_budget["currentMonthlyIncome"])
            . ", entertainment=" . $this->escape($new_budget["entertainment"])
            . ", housing=" . $this->escape($new_budget["housing"])
            . ", recreation=" . $this->escape($new_budget["recreation"])
            . ", nutrition=" . $this->escape($new_budget["nutrition"])
            . ", transportation=" . $this->escape($new_budget["transportation"])
            . ", workstudy=" . $this->escape($new_budget["workstudy"])
            . ", savings=" . $this->escape($new_budget["savings"])
            . ", other=" . $this->escape($new_budget["other"])
            . " WHERE email='" . $this->escape($email) . "'";

        $r = $this->db->query($q);

        return $r;
    }

    public function connect(){

        $this->db = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);

        if($this->db->connect_error)
        {
            die("Connection failed: " . $this->db->connect_error);
        };
    }

    /**
     * Escapes special characters to protect against SQL injects
     *
     * @param mixed $text
     * @return string
     */
    public function escape($text){
        return mysqli_real_escape_string($this->db, $text);
    }

}
?>
