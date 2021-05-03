<?php
    // To logout, remove the SESSION variables
    // To destory a session, must start a session
    session_start();
    session_destroy();
    header("Location: index.php");
?>