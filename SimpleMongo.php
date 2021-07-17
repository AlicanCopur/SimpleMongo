<?php

class SimpleMongo {

    private static $host = "localhost";
    private static $port = "27017";
    private static $username = "admin";
    private static $password = "password";
    private static $dbName = "admin";

    private static $db = null;

    public static function init(){
        if(self::$db == null){
            self::$db = new MongoDB\Driver\Manager(
                "mongodb://". self::$username . ":" . self::$password . "@" . self::$host . ":" . self::$port . "/" . self::$dbName
            );
        }
    }

    public static function getAll(string $collection): array{
        $query = new MongoDB\Driver\Query([]);
        $result = self::$db->executeQuery(self::$dbName . '.' . $collection, $query);
        return json_decode(json_encode($result->toArray()), true);
    }

    public static function get($collection, $queryKey, $queryValue, $key){
        $all = self::getAll($collection);
        foreach($all as $row){
            if(isset($row[$queryKey]) && $row[$queryKey] == $queryValue && isset($row[$key])){
                return $row[$key];
            }
        }
        return null;
    }

    public static function exists($collection, $key, $value): bool{
        foreach(self::getAll($collection) as $row){
            if(isset($row[$key]) && $row[$key] == $value){
                return true;
            }
        }
        return false;
    }

    public static function remove($collection, $key, $value){
        $data = new MongoDB\Driver\BulkWrite();
        $data->delete([$key => $value]);
        self::$db->executeBulkWrite(self::$dbName . '.' . $collection, $data);
    }

    public static function add($collection, $array){
        $data = new MongoDB\Driver\BulkWrite();
        $data->insert($array);
        self::$db->executeBulkWrite(self::$dbName . '.' . $collection, $data);
    }

    public static function update($collection, $queryKey, $queryValue, $key, $value){
        $data = new MongoDB\Driver\BulkWrite();
        $data->update([$queryKey => $queryValue], ['$set' => [$key => $value]]);
        self::$db->executeBulkWrite(self::$dbName . '.' . $collection, $data);
    }
}