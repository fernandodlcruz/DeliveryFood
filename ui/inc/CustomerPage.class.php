<?php

class CustomerPage extends Page {
    static function jsBundle() { ?>
        <!--JavaScript at end of body for optimized loading-->
        <!--script type="text/javascript" src="js/materialize.min.js"></script-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
        <script src="js/config.js"></script>
        <script src="js/customer.js"></script>
    <?php }

    static function showMenuSelection() {?>
        <div class="container">
            <div class="row">
                <div class="input-field col s12">
                    <select id="business" name="business">
                        <option value="" disabled selected>Choose your option</option>                                    
                    </select>
                <label>Select your restaurant</label>
                </div>
            </div>

            <div class="row">
                <div class="fixed-action-btn">
                    <a class="btn-floating btn-large red tooltipped disabled" data-position="top" data-tooltip="Add your items to the cart">
                        <i class="large material-icons">shopping_cart</i>
                    </a>
                </div>
                <div id="menuView" style="display: none">
                    <h3 class="header">Choose from menu</h3>
                    <ul class="collapsible popout" id="menuList">
                    </ul>
                </div>
            </div>
        </div>
    <?php }

    static function showConfirmation() {?>
        <div class="container">
            <div class="row">
                <h3 class="header">Confirm your order</h3>
            </div>

            <div class="row">
                <table>
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody id="menuItems">
                    </tbody>
                </table>                    
            </div>
        </div>        

    <?php }
}