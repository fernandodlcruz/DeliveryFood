<?php

class LoginMapper    {

    function validatelogin($postdata) {
        $user = null;

        //Create a new PDOAgent
        $pdoAgent = new DatabaseAgent();

        //Setup the query()
        $pdoAgent->query("SELECT * FROM authorized_users WHERE userid=:userid");

        //Setup the bind parameters
        $pdoAgent->bind('userid', $postdata['username']);

        //Pull the resultset
        $user = $pdoAgent->single();

        //Check password_verify against the password the user entered and the password in the database, if true return 1 if false return 0
        if (!empty($user)) {
            if (password_verify($postdata['password'], $user['passwd'])) {
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