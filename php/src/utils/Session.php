<?php
function session(): void
{
// Check if session is active
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Resume the session
        session_start();
    }

    //check if session variable is set
    if (!isset($_SESSION['time'])) {
        //set session variable
        $_SESSION['time'] = '00:00';
    }

    //check if session variable is set
    if (!isset($_SESSION['animals'])) {
        //set session variable
        $_SESSION['animals'] = array();
    }
}