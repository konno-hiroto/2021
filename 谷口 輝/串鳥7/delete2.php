<?php
    session_start();

    $session_name = session_name();

    $_SESSION = array();

    // クッキーを削除
    if (isset($_COOKIE[$session_name]) === TRUE) {
        setcookie($session_name, '', time() - 3600);
    }

    session_destroy();

    header('Location: Thanks.php');

    exit;