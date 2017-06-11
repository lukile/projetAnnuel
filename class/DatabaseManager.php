<?php 

class DatabaseManager{
    private $connect;
    private static $sharedInstance_;


    public function __construct(){
        $hostname = "localhost";
        $database = "aen";
        $username = "root";
        $password = "";
        
        try{
            $this->connect = new PDO("mysql:host=".$hostname.";dbname=".$database, $username, $password);
        }catch(PDOException $e){
            exit('problème de connexion à la base');
            print_r($e);
        }
    }      

    public function connect(){
        $hostname = "localhost";
        $database = "aen";
        $username = "root";
        $password = "";

        try{
            $this->connect = new PDO("mysql:host=".$hostname.";dbname=".$database, $username, $password);
            return $this->connect;
        }catch(PDOException $e){
            exit('problème de connexion à la base');
            print_r($e);
        }
       //return new PDO("mysql:host=".$hostname.";dbname=".$database, $username, $password);
    
    }
    public static function getSharedInstance(){
        if(!isset(DatabaseManager::$sharedInstance_)){
            DatabaseManager::$sharedInstance_ = new DatabaseManager();
        }
        return DatabaseManager::$sharedInstance_;
    }

    public function exec($sql, $params){
        $statement = $this->connect->prepare($sql);
        if($statement && $statement->execute($params)){
            return true;
        }
            return false;
    }
}

?>