<?php

    session_start();
    session_unset();
    session_destroy();

    if (isset($_GET['session_expired']) && $_GET['session_expired'] == '1') {
        header("Location: /home/?msg=Session Expired. Please login again.");
    }
    else {
        header("Location: /home/");
    }
    
    exit();

?>

<p>You are being logged out...</p>