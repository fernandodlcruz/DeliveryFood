<?php 

// +---------------+-------------+------+-----+---------+----------------+
// | Field         | Type        | Null | Key | Default | Extra          |
// +---------------+-------------+------+-----+---------+----------------+
// | idAddress     | int(11)     | NO   | PRI | NULL    | auto_increment |
// | Line1         | varchar(45) | YES  |     | NULL    |                |
// | Line2         | varchar(45) | YES  |     | NULL    |                |
// | City          | varchar(45) | YES  |     | NULL    |                |
// | StateProvince | varchar(45) | YES  |     | NULL    |                |
// | PostalCode    | varchar(45) | YES  |     | NULL    |                |
// | IdUser        | int(11)     | YES  | MUL | NULL    |                |
// +---------------+-------------+------+-----+---------+----------------+


class AddressMapper{

    function getAddress($id){
        $address = null;

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("SELECT * FROM address WHERE IdUser = :id;");

        $pdoAgent->bind(':id',$id);

        $address = $pdoAgent->single();

        return $address;
    }

}

?>