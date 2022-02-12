<?php

# user logout
if(@$_GET['exit'] == "yes")
{
    session_start();
    session_destroy();
    header("Location: sign-in.php");
}