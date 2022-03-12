<?php 
    require 'connection.php';

    session_destroy();

    header('location: index.php', true)
?>