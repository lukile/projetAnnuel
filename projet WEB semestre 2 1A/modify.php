<?php
    
    require "init.php";
    if(!isConnected()){
        header("Location: index.php");
        die();
    }
    include "header.php";
    $msg_error = "";
    $error = false;
    $list_of_country = ["fr"=>"France", "es"=>"Espagne", "pl"=>"Pologne"];
  
    if(isset($_GET["id"]) ){
        $db = connectDb();
        $query = $db->prepare("SELECT id, name, surname, country FROM users WHERE id=:id");
        $query->execute(['id'=>$_GET['id']]);
        $_POST = $query->fetch();
        
    if(
        isset( $_POST['name'] ) && 
        isset( $_POST['surname'] ) && 
        isset( $_POST['password'] ) && 
        isset( $_POST['password2'] ) && 
        isset( $_POST['country'] )  
        
        ){
            $_POST['name'] = trim($_POST['name']);
            $_POST['surname'] = trim($_POST['surname']);

            //Le nom doit faire plus d'un caractère
            if( strlen($_POST['name']) < 2 ){
                $msg_error .= "<li>Le nom doit faire plus d'un caractère";
                $error = true;
            }
            //Le prénom doit faire plus d'un caractère
            if( strlen($_POST['surname']) < 2 ){
                $msg_error .= "<li>Le prénom doit faire plus d'un caractère";
                $error = true;
            }
            if(!empty($_POST['password'])) {
                //Le mot de passe doit faire en 8 et 32 caractères
                if( strlen($_POST['password']) < 8 || strlen($_POST['password']) > 12 ){
                    $msg_error .= "<li>Le mot de passe doit faire entre 8 et 32 caractères";
                    $error = true;
                }
                //Les mots de passe doivent correspondre
                else if( $_POST['password'] != $_POST['password2'] ){
                    $msg_error .= "<li>Les mots de passe sont différents";
                    $error = true;
                }   
            }
            
        }   
        
    }
    // Je fais toutes les verifications
    // S'il n'y a pas d'erreurs et que password est vite on met tout a jour sauf le mdp
    // Sinon on met a jour le mot de passe
    // UPDATE NomTable SET column=:name, column2=:surname WHERE id=:id  
    // Et on redirige l'internaute a l'index
    // Ou on affiche les erreurs
    //  
?>
    <form method="POST" action="modify.php" id="formmodify">
        <input type="hidden" name="id" value="<?php echo (isset( $_POST["id"] ))? $_POST["id"]:"";?>">
        <input type="text" name="name" placeholder="Votre nom" value="<?php echo (isset( $_POST["name"] ))? $_POST["name"]:"";?>"><br>
        <input type="text" name="surname" placeholder="Votre prénom" value="<?php echo (isset( $_POST["surname"] ))? $_POST["surname"]:"";?>"><br>
        <input type="password" name="password" placeholder="Votre mot de passe"><br>
        <input type="password" name="password2" placeholder="Confirmation du mot de passe"><br>
        
        <select name="country">
            <?php 
               foreach ($list_of_country as $key => $value) {
                       
                     echo "<option ".(( isset($_POST["country"]) && $_POST["country"] == $id)?
                                           "selected='selected'":'')."value='" .$key."'>".$value."</option>";
               }
           ?>
<?php
         if ( !$error ) {
            if (!empty($_POST['password'])) {
                $db = connectDb();
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $update = $db->prepare('UPDATE users SET name=:name, surname=:surname, password=:password, country=:country WHERE id=:id');
                $update->execute(['name' => $_POST['name'] , 'surname' => $_POST['surname'] , 'id' => $_POST['id'], 'password' => $password, 'country'=>$_POST['country'] ]);
            } else {
                $db = connectDb();
                $update = $db->prepare('UPDATE users SET name=:name, surname=:surname, country=:country WHERE id=:id');
                $update->execute(['name' => $_POST['name'] , 'surname' => $_POST['surname'], 'id' => $_POST['id'], 'country'=>$_POST['country'] ]);
            }
          }

            ?>
        </select><br>
        <input type="submit">
<?php

if($error) {
    echo $msg_error;
    
}/*else{
	header("Location: index.php");
}*/
?>     
    </form>
<?php
include "footer.php";
?>