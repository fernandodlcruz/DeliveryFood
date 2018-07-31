<?php

class NewItemPage extends Page {
    static function jsBundle() { ?>
        <!--JavaScript at end of body for optimized loading-->
        <!--script type="text/javascript" src="js/materialize.min.js"></script-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
        <script src="js/config.js"></script>
        <script src="js/newitem.js"></script>
    <?php }


    static function showNewItemForm() {?>
        <div class="container">
            <div class="row">
                <h4 class="header">Add a new item to your menu</h4>
            </div>

            <div class="row">
                <div class="col s6">
                    <form class="col s12" method="POST" action="">                        
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="name" name="name" type="text" class="validate">
                                <label for="description">Item name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="description" name="description" type="text" class="validate">
                                <label for="description">Description</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="unit" name="unit" type="text" class="validate">
                                <label for="unit">Unit</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="price" name="price" type="text" class="validate">
                                <label for="price">Price</label>
                            </div>
                        </div>                     
                    </form>
                </div>
            </div>
            <div class="row left">
                <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="button" name="btnItem" id="btnItem">Add Item
                    <i class="material-icons right">add</i>
                </button>
                </div>
            </div>
        </div>
    <?php }

    static function createModal() {?>
        <div id="modalFinish" class="modal">
            <div class="modal-content">
                <h4>All Done!</h4>
                <i class="large material-icons">check_circle_outline</i>
                <p>You´ve added your item!</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
            </div>
        </div>
    <?php }

}