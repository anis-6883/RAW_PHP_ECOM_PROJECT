<?php

# admin logout
if(@$_GET['exit'] == "yes")
{
    session_start();
    session_destroy();
    header("Location: index.php");
}

# redirect unauthenticated user
if(empty($_SESSION['ECOM_login_time']))
{
    header("Location: index.php");  
}