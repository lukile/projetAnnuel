<?php 
require_once(__DIR__. '/class/DatabaseManager.php');
include"header.php";

         
    if($_GET['action']=="reset")
    {
        $encrypt = mysqli_real_escape_string($connection,$_GET['encrypt']);
        $query = "SELECT id FROM users where md5(90*13+id)='".$encrypt."'";
        $result = mysqli_query($connection,$query);
        $Results = mysqli_fetch_array($result);
        if(count($Results)>=1)
        {
 
        }
        else
        {
            $message = 'Invalid key please try again. <a href="http://localhost/projects/projetAnnuel/forgetpwd.php">Forget Password?</a>';
        }
    }

elseif(isset($_POST['action']))
{
 
    $encrypt      = mysqli_real_escape_string($connection,$_POST['action']);
    $password     = mysqli_real_escape_string($connection,$_POST['password']);
    $query = "SELECT id FROM users where md5(90*13+id)='".$encrypt."'";
 
    $result = mysqli_query($connection,$query);
    $Results = mysqli_fetch_array($result);
    if(count($Results)>=1)
    {
        $query = "update users set password='".md5($password)."' where id='".$Results['id']."'";
        mysqli_query($connection,$query);
 
        $message = "Your password changed sucessfully <a href=\"http://demo.phpgang.com/login-signup-in-php/\">click here to login</a>.";
    }
    else
    {
        $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
    }
}
else
{
    header("location: /login-signup-in-php");
}
?>

<script>
function mypasswordmatch()
{
    var pass1 = $("#password").val();
    var pass2 = $("#password2").val();
    if (pass1 != pass2)
    {
        alert("Passwords do not match");
        return false;
    }
    else
    {
        $( "#reset" ).submit();
    }
}
</script>

<script>
function mypasswordmatch()
{
    var pass1 = $("#password").val();
    var pass2 = $("#password2").val();
    if (pass1 != pass2)
    {
        alert("Passwords do not match");
        return false;
    }
    else
    {
        $( "#reset" ).submit();
    }
}
</script>