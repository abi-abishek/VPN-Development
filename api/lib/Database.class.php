<?php

class Database {
    static $db;
    public static function getConnection(){
        $config_json = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../env.json');
        $config = json_decode($config_json, true);
        if (Database::$db != NULL) {
            return Database::$db;
        } else {
            Database::$db = mysqli_connect($config['server'],$config['username'],$config['password'], $config['database']);
            if (!Database::$db) {
                die("Connection failed: ".mysqli_connect_error());
            } else {
                return Database::$db;
            }
        }
    }

    public static function getCurrentDB() {
        $config_json = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../env.json');
        $config = json_decode($config_json, true);
        return $config['database'];
    }
    
}