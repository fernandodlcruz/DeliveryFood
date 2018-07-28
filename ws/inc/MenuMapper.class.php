<?php 
// mysql> describe menu;
// +-------------+--------------+------+-----+---------+----------------+
// | Field       | Type         | Null | Key | Default | Extra          |
// +-------------+--------------+------+-----+---------+----------------+
// | idMenu      | int(11)      | NO   | PRI | NULL    | auto_increment |
// | Item        | varchar(80)  | YES  |     | NULL    |                |
// | Description | varchar(255) | YES  |     | NULL    |                |
// | Unit        | varchar(45)  | YES  |     | NULL    |                |
// | Price       | decimal(5,2) | YES  |     | NULL    |                |
// | IdCompany   | int(11)      | YES  | MUL | NULL    |                |
// +-------------+--------------+------+-----+---------+----------------+

class MenuMapper{

    // Start Create Menu Item
    function createItem($item){
        // $item is an array
        // $item should contain:
        //  $item['name'] (e.g. "Chorizo" )
        //  $item['description'] ("Chorizo is made from coarsely chopped pork and pork fat, seasoned with pimentón – a smoked paprika – and salt.")
        //  $item['unit'] ("200g")
        //  $item['price'] (10.50)
        //  $item['businessID']  ( Id from the business that is logged in)

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("INSERT INTO menu (Item, Description, Unit, Price, IdCompany) 
        VALUES (:name, :description, :unit, :price, :businessID);");

        $pdoAgent->bind('name',$item['name']);
        $pdoAgent->bind('description',$item['description']);
        $pdoAgent->bind('unit',$item['unit']);
        $pdoAgent->bind('price',$item['price']);
        $pdoAgent->bind('businessID',$item['businessID']);

        $pdoAgent->execute();

        return $pdoAgent->lastInsertId();
    }
    // End Create

    // Start Read
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

     // End Read


     // Start update

     function updateItem($item){
        // $item is an array
        // $item should contain:
        //  $item['idMenu'] (id of the item to be updated)
        //  $item['businessID']  ( Id from the business that is logged in)
        //  $item['name'] (e.g. "Chorizo" )
        //  $item['description'] ("Chorizo is made from coarsely chopped pork and pork fat, seasoned with pimentón – a smoked paprika – and salt.")
        //  $item['unit'] ("200g")
        //  $item['price'] (10.50)
        $pdoAgent = new DatabaseAgent;
        //Name = :Name, Address = :Address, City = :City WHERE CustomerID = :Id;
        $pdoAgent->query("UPDATE menu SET Item=:name, Description=:description, Unit=:unit,
         Price=:price WHERE idMenu=:id AND idCompany=:businessID;");

        $pdoAgent->bind('id',$item['id']);
        $pdoAgent->bind('businessID',$item['businessID']);
        $pdoAgent->bind('name',$item['name']);
        $pdoAgent->bind('description',$item['description']);
        $pdoAgent->bind('unit',$item['unit']);
        $pdoAgent->bind('price',$item['price']);

        $pdoAgent->execute();

        return $pdoAgent->lastInsertId();

     }

     // End update


     // Start delete
     function deleteItem($idItem){
        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("DELETE FROM menu WHERE idMenu=:id;");

        $pdoAgent->bind('id',$idItem);

        $pdoAgent->execute();

        return $idItem;
     }

     // End delete

}

?>