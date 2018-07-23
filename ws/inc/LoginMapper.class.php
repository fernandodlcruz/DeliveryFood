<?php

// +-------------+--------------+------+-----+---------+----------------+
// | Field       | Type         | Null | Key | Default | Extra          |
// +-------------+--------------+------+-----+---------+----------------+
// | idUser      | int(11)      | NO   | PRI | NULL    | auto_increment |
// | Name        | varchar(45)  | YES  |     | NULL    |                |
// | PhoneNumber | varchar(15)  | YES  |     | NULL    |                |
// | Email       | varchar(80)  | YES  |     | NULL    |                |
// | UserType    | char(1)      | YES  |     | NULL    |                |
// | Pwd         | varchar(255) | YES  |     | NULL    |                |
// | IdCuisine   | int(11)      | YES  | MUL | NULL    |                |
// +-------------+--------------+------+-----+---------+----------------+

class LoginMapper    {

    function validatelogin($postdata) {
        $user = null;

        //Create a new PDOAgent
        $pdoAgent = new DatabaseAgent();

        //Setup the query()
        $pdoAgent->query("SELECT * FROM user WHERE idUser=:userid");

        //Setup the bind parameters
        $pdoAgent->bind('userid', $postdata['username']);

        //Pull the resultset
        $user = $pdoAgent->single();

        //Check password_verify against the password the user entered and the password in the database, if true return 1 if false return 0
        if (!empty($user)) {
            if (password_verify($postdata['password'], $user['Pwd'])) {
                //Set the user to be logged in
                $_SESSION['logged'] = true;

                //Return true
                return true;
            } else {        
                //Return false if the user was not logged in.
                return false;
            }            
        }
    }

}

?>