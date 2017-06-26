<?php
require_once("DatabaseManager.php");

class LoginManager {
    private static $instance;

    public static function getSharedInstance() {
        if(LoginManager::$instance == null) {
            LoginManager::$instance = new LoginManager();
        }
        return LoginManager::$instance;
    }

    public function login($mail, $pass) {
        $query = connect()->prepare("SELECT pass FROM user WHERE mail=:mail");
        $query->execute(["mail"=>$mail]);
        $result = $query->fetch();
        $pass = md5($pass);
        $pwd = $result["pass"];

        if(!empty($pwd) && $pwd == $pass){
            $_SESSION["activation_key"] = generateactivation_key($mail);
            $_SESSION["mail"] = $mail;

            return true;
        }else{
            return false;
        }    
    }

    private function connect(){
        $manager = DatabaseManager::getsharedInstance();
        $connect = $manager->connect();

        return $connect;
    }

}
?>