<?php
//mysql> describe placeorder;
// +----------------+--------------+------+-----+---------+----------------+
// | Field          | Type         | Null | Key | Default | Extra          |
// +----------------+--------------+------+-----+---------+----------------+
// | idOrder        | int(11)      | NO   | PRI | NULL    | auto_increment |
// | IdCompanyOrder | int(11)      | YES  | MUL | NULL    |                |
// | IdUserOrder    | int(11)      | YES  | MUL | NULL    |                |
// | IdMenuOrder    | int(11)      | NO   | PRI | NULL    |                |
// | Quantity       | int(11)      | YES  |     | NULL    |                |
// | TotalPrice     | decimal(5,0) | YES  |     | NULL    |                |
// +----------------+--------------+------+-----+---------+----------------+

class PlaceOrderMapper{

    // Start create order

    function createOrder($postdata){
        // $order needs the following data:
        //  $order['companyID'], $order['userID'], $order['menuID']
        //  $order['qty'], $order['totalPrice'].

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("INSERT INTO PlaceOrder (IdCompanyOrder, IdUserOrder, IdMenuOrder, idAddressOrder, OrderDate, Quantity, TotalPrice) 
        VALUES (:companyId, :userId, :menuId, :addressId, :orderDate, :quantity, :totalPrice);");

        // $orderID = 1;
        // // if(isset($order['orderID'])){
        // //     $orderID = $order['orderID'];
        // // }
        // // else{
        //      $orderID = $this->getLastID();
        // // }

        //$pdoAgent->bind('orderID', $orderID);
        $pdoAgent->bind('companyId',$postdata['companyId']);
        $pdoAgent->bind('userId',$postdata['userId']);
        $pdoAgent->bind('menuId',$postdata['menuId']);
        $pdoAgent->bind('addressId',$postdata['addressId']);
        $pdoAgent->bind('orderDate',date("Y-m-d H:i:s"));
        $pdoAgent->bind('quantity',$postdata['quantity']);
        $pdoAgent->bind('totalPrice',$postdata['totalPrice']);

        $pdoAgent->execute();

        return $pdoAgent->lastInsertId();
    }

    // End create order

    // This function returns the a full order
    function getOrderByID($orderID){
        $order = null;

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("SELECT * FROM placeorder WHERE idOrder = :id;");

        $pdoAgent->bind(':id',$orderID);

        $order = $pdoAgent->resultset();

        return $order;
    }

    function getOrdersFromCustomer($id){
        $order = null;

        $pdoAgent = new DatabaseAgent;

        $pdoAgent->query("SELECT * FROM placeorder WHERE IdUserOrder = :id;");

        $pdoAgent->bind(':id',$id);

        $order = $pdoAgent->resultset();

        return $order;
    }

    function getOrdersFromBusiness($id){
        $order = null;

        $pdoAgent = new DatabaseAgent;

        // $pdoAgent->query("SELECT idOrder, Item, Description, OrderDate, Quantity, TotalPrice  
        // FROM placeorder, menu
        // WHERE IdMenuOrder = idMenu AND IdCompanyOrder=:id;");
        $pdoAgent->query("SELECT C.Name, C.PhoneNumber, C.Email, PO.idOrder, PO.OrderDate, PO.Quantity, PO.TotalPrice, M.Item, A.Line1, A.Line2, A.City, A.StateProvince, A.PostalCode
                            FROM PlaceOrder PO
                            INNER JOIN User C ON C.idUser = PO.IdUserOrder
                            INNER JOIN Menu M ON M.idMenu = PO.IdMenuOrder
                            INNER JOIN Address A ON A.idAddress = PO.IdAddressOrder
                            WHERE IdCompanyOrder = :id;");

        $pdoAgent->bind('id',$id);

        $order = $pdoAgent->resultset();

        return $order;
    }

    function getLastID(){
        $id = 0;
        $pdoAgent = new DatabaseAgent;
        $pdoAgent->query("SELECT MAX(idOrder) FROM placeorder;");
        $id = $pdoAgent->single();
        return $id['MAX(idOrder)']+1;
    }
}

?>