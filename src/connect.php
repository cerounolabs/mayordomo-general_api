<?php
    function getConnectionDEFAULT(){
        $serverName = "localhost";
        $serverPort = "3306";
        $serverDb   = "mayordomo_default";
        $serverUser = "root";
        $serverPass = "tre3As5ePru_";
        
        try {
            $conn = new PDO("mysql:host=$serverName;port=$serverPort;dbname=$serverDb;charset=utf8", $serverUser, $serverPass,
                array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                )
            );
        } catch (PDOException $e) {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(array('code' => 204, 'status' => 'failure', 'message' => 'Error Connecting to MYSQL: '.$e), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
            die();
        }

        return $conn;
    }