<?php
    $dsn = 'mysql:host=localhost;dbname=cs602db;unix_socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
