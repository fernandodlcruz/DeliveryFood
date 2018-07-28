<?php 
// mysql> describe menu;
// +-------------+--------------+------+-----+---------+----------------+
// | Field       | Type         | Null | Key | Default | Extra          |
// +-------------+--------------+------+-----+---------+----------------+
// | idMenu      | int(11)      | NO   | PRI | NULL    | auto_increment |
// | Item        | varchar(80)  | YES  |     | NULL    |                |
// | Description | varchar(255) | YES  |     | NULL    |                |
// | Unit        | varchar(45)  | YES  |     | NULL    |                |
// | Price       | decimal(5,0) | YES  |     | NULL    |                |
// | IdCompany   | int(11)      | YES  | MUL | NULL    |                |
// +-------------+--------------+------+-----+---------+----------------+

class MenuMapper{

    // $IDbusiness refers to `idUser` from `user`
    function getMenuByBusiness($IDbusiness){
        $menu = null;

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("SELECT * FROM menu WHERE IdCompany = :id;");

        $pdoAgent->bind(':id',$IDbusiness);

        $menu = $pdoAgent->resultset();

        return $menu;
     }

     function getMenuByIds($arrIds) {
        $menu = null;
        $in  = str_repeat('?,', count($arrIds) - 1) . '?';

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("SELECT * FROM menu WHERE idMenu IN (".$in.");");

        $menu = $pdoAgent->resultset($arrIds);

        return $menu;
     }
}

?>