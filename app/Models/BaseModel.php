<?php

namespace App\Models;

class BaseModel
{
    protected static $fillable = [];

    protected static $tableName;
    protected static $connection;
//одно подключение к БД
    protected static function getConnection(){
        if (!self::$connection){
            self::$connection = new \mysqli('localhost', 'root', '', 'mvc');
        }
        return self::$connection;
    }

    protected static function getTableName(){
        if (empty(static::$tableName)){
            $className = static::class;
            $className = explode('\\', $className);
            $className = array_pop($className);
            $className = strtolower($className);
            $tableName = $className."s";
        }
        else {
            $tableName = static::$tableName;
        }
        return $tableName;
    }
    public static function selectAll(){
        $connection = self::getConnection();
        $tableName = static:: getTableName();
        $res = $connection->query("SELECT * FROM ".$tableName);
        $arr = [];
        while ($row = $res->fetch_object(static::class)){
            $arr[] = $row; // не хватает [] после $arr
        }
        return $arr;
    }

    public static function findById($id) {
        /**
         * @var \mysqli $connection
         */
        $connection = self::getConnection();
        $sql = "select * from ".(static::getTableName())." where id = ?";
        $smth = $connection->prepare($sql);
        $smth->bind_param("i", $id);
        $smth->execute();
        $result = $smth->get_result();
        return $result->fetch_object(static::class);
    }

    public function save() {
        $connection = self::getConnection();
        $tableName = static::getTableName();

        if (isset($this->id) && !empty($this->id)){
            // update query
        } else {
            $fields = implode(' , ', static::$fillable);
            $values = [];

            foreach (static::$fillable as $attributeName) {
                $values[] = $this->{$attributeName} ?? null;
            }
            $values = "'".implode("' , '", $values)."'";
            print_r($values);
            $sql = "INSERT INTO {$tableName} ({$fields}) VALUES ({$values})";
            $connection->query($sql);
//        print_r($connection->insert_id);
            if ($connection->insert_id) {
                $this->id = $connection->insert_id;
            }
        }
    }

}