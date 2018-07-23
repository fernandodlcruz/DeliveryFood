<?php

class PageSetup {


    public $title = "Group Project";


    static function header()    {?>


            
   <!DOCTYPE html>
        <html>
            <head>
            <!--Import Google Icon Font-->
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!--Import materialize.css-->
            <link type="text/css" rel="stylesheet" href="style.css"/>
            
            <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

            <!--Let browser know website is optimized for mobile-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            
            <title>Sign-up</title>
            </head>

            <body id="body-color">

            <!--JavaScript at end of body for optimized loading-->
            <script type="text/javascript" src="js/materialize.min.js"></script>
            <div class="container" id="Sign-Up">
            
            <fieldset style="width:30%"><legend>Register</legend>
            <table border ="0">
            <tr>
            <form method="POST" action="connectivity-sign-up.php">
            <td>Name</td><td><input type="text" name="name"></td>
            </tr>
            <tr>
            <td>Email</td><td> <input type="text" name="email"</td>
            </tr>
            <tr>
            <td>Phone Number</td><td>   <input type="text" name="phone number"></td>
            </tr>
            <tr>
            <td>Password</td><td><input type="password" name="passw"></td>
            </tr>
            <tr>
            <td>Confirm Password</td><td><input type="password" name="cpassw"></td>
            </tr>
            <tr>
            <td><input id="button" type="submit" name="submit" value="Sign-Up"></td>
            </tr>
            </form>
            </table>
            </fieldset>
            </div>
            </body>
            </html>
    
        
    <?php }

static function footer()    { ?>
    </div>
        </body>
    </html>
<?php }

}
static function navbar()    {   ?>
        
    <nav>
        <div class="nav-wrapper">
        <a href="#" class="brand-logo">&emsp;<?php echo self::$title; ?></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php
            //Check if the user is logged in
            if (isset($_SESSION['logged']) && $_SESSION['logged']) {
                    //If they are show a logout button that sends them to logout.php
                    echo '<li><a href="logout.php">Logout</a></li>';
            } else {
                    //If they arent show a login button (link to the controller file)
                    echo '<li><a href="Lab09FCr_63758.php">Login</a></li>';
            }
            ?>
        </ul>
        </div>
    </nav>
        
    <?php }



?>