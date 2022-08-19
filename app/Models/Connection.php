<?php

namespace App\Models;

class Connection
{
    protected static $connection;
    protected function __construct() { }
    public static function getConnection(){
        if (!self::$connection){
            self::$connection = 'Some connection';
        }
        return self::$connection;
    }

}

function clientCode()
{
    $s1 = Connection::getConnection();
    $s2 = Connection::getConnection();
    if ($s1 === $s2) {
        echo "Singleton works, both variables contain the same instance.";
    } else {
        echo "Singleton failed, variables contain different instances.";
    }
}

clientCode();
