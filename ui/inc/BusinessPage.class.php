<?php

class BusinessPage extends Page {
    static function jsBundle() { ?>
        <!--JavaScript at end of body for optimized loading-->
        <!--script type="text/javascript" src="js/materialize.min.js"></script-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
        <script src="js/config.js"></script>
        <script src="js/companies.js"></script>
    <?php }

    static function showAllOrders() {?>
        <div class="container">
            <ul id="login_signup" class="tabs tabs-fixed-width">
                <li class="tab col s3"><a class="active" href="#orders">Work Orders</a></li>
                <li class="tab col s3"><a href="#menu">Menu Maintenance</a></li>
            </ul>
            <div id="orders" class="col s12">
                <div class="row">
                    <h3 class="header">All orders placed</h3>
                </div>
                <div class="row">                    
                    <table>
                        <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Item</th>
                            <th>Date</th>
                            <th>Quantity</th>
                            <th>Total price</th>
                        </tr>
                        </thead>
                        <tbody id="ordersList">
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="menu" class="col s12">
                <div class="row">
                    <h3 class="header">All items in the menu</h3>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                    <button class="btn waves-effect waves-light" type="button" name="btnInsert" id="btnInsert">Insert New Item
                        <i class="material-icons right">input</i>
                    </button>
                    </div>
                </div>
                <div class="row">
                    <table>
                        <thead>
                        <tr>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="menuItems">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php }

    static function showMenu() {?>
        <div class="container">
            
        </div>
    <?php }


   

}