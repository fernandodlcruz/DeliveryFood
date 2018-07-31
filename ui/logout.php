<?php
//Start the session
session_start();

//If the user is logged in then delete their session
if (isset($_SESSION['user']) && $_SESSION['user']['loggedIn']) {
    unset($_SESSION['user']);
    
    //Use the 'header()' function to redirect them back to the controller.
    header('Location: ./HAnFConsultants.php');
}
?>