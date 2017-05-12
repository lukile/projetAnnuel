<?php
  
    require_once(__DIR__. '/class/DatabaseManager.php');

    session_start();

    $error_msg = null;
    $message = null;

    $pseudo = filter_input(INPUT_POST, 'pseudo');
    $pass = filter_input(INPUT_POST, 'pass');

    if(isset($pseudo, $pass)){
        $pseudo = trim($pseudo) != '' ? $pseudo : null;
        $pass = trim($pass) != '' ? $pass : null;

        if(isset($pseudo, $pass)){
               /*$hostname = "localhost";
               $database = "aen";
               $username = "root";
               $password = "";

               $pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;
               $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
               $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
 
               try{
                    $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password, $pdo_options);
               }catch (PDOException $e){
                    exit('problème de connexion à la base');
               }
*/
            $manager = DatabaseManager::getsharedInstance();

            $requete = "SELECT id, pseudo, pass FROM user WHERE pseudo = :pseudo";
            $connect = $manager->connect();
            $query = $connect->prepare($requete);
            $query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetch();    

        
            if($data['pass'] == md5($_POST['pass'])){
                $_SESSION['pseudo'] = $data['pseudo'];
                $_SESSION['id'] = $data['id'];
                $message = '<p> Bienvenue '.$data['pseudo'].', vous êtes maintenant connecté !';
            }else{
                $message = 'Le pseudo et/ou le mot de passe est incorrect';
            }
            $query->CloseCursor();
        }else{
            $message = 'Tous les champs doivent être renseignés';
        }
    }
?>


