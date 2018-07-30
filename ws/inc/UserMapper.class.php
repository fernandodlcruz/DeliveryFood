<?php
// describe user;
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

// UserType 'C' for customer. 'B' for Business
// Pwd holds the password hash

class UserMapper    {
    // Create
    function createUser($postdata){

        $pdoAgent = new DatabaseAgent;

        if (isset($postdata['idCuisine'])) {
            $pdoAgent->query("INSERT INTO user (Name, PhoneNumber, Email, Usertype, Pwd, IdCuisine) 
            VALUES (:name, :phone, :email, :type, :passw, :idCuisine);");
        } else {
            $pdoAgent->query("INSERT INTO user (Name, PhoneNumber, Email, Usertype, Pwd) 
            VALUES (:name, :phone, :email, :type, :passw);");
        }

        // postdata is declared in the login file for testing
        $pdoAgent->bind('name',$postdata['Name']);
        $pdoAgent->bind('phone',$postdata['PhoneNumber']);
        $pdoAgent->bind('email',$postdata['Email']);
        $pdoAgent->bind('type',$postdata['UserType']);
        $pdoAgent->bind('passw',$postdata['Pwd']);
        
        if (isset($postdata['idCuisine'])) {
            $pdoAgent->bind('idCuisine',$postdata['idCuisine']);
        }

        $pdoAgent->execute();

        return $pdoAgent->lastInsertId();
    }
    //End create

    // Read functions:

    function getAllUsers() {
        $users = null;

        //Create a new PDOAgent
        $pdoAgent = new DatabaseAgent();

        //Setup the query()
        $pdoAgent->query("SELECT * FROM user");

        //Pull the resultset
        $users = $pdoAgent->resultset();

        //var_dump($users);
        return $users;
    }

    function getAllUsersByType($type, $cuisineId = null) {
        // Type is "C" for customer and
        // "B" for business
        $users = null;

        //Create a new PDOAgent
        $pdoAgent = new DatabaseAgent();

        //Setup the query()
        if (is_null($cuisineId)) {
            $pdoAgent->query("SELECT * FROM user WHERE UserType = :type;");
        } else {
            $pdoAgent->query("SELECT * FROM user WHERE UserType = :type AND idCuisine = :idCuisine;");
        }

        //Setup the bind parameters
        $pdoAgent->bind(':type',$type);

        if (!is_null($cuisineId)) {
            $pdoAgent->bind(':idCuisine',$cuisineId);
        }

        //Pull the resultset
        $users = $pdoAgent->resultset();

        //var_dump($users);
        return $users;
    }

    function getUserById($id) {
        $user = null;

        $pdoAgent = new DatabaseAgent();

        $pdoAgent->query("SELECT * FROM user WHERE  idUser = :id;");

        $pdoAgent->bind(':id',$id);

        $user = $pdoAgent->single();

        //var_dump($user);
        return $user;
    }

    function getUserByEmail($email) {
        $user = null;

        $pdoAgent = new DatabaseAgent();

        $pdoAgent->query("SELECT * FROM user WHERE Email = :email;");

        $pdoAgent->bind('email',$email);

        $user = $pdoAgent->single();

        //var_dump($user);
        return $user;
    }
    // End read functions

    // Update

    // End update

    // Delete

    // End delete
}

?>