function underline(champ, erreur){
    if(erreur){
        champ.style.backgroundColor = "#fba";
    }else{
        champ.style.backgroundColor = "";  
    }  
}

function verifyPassLength(){
    var pass = document.getElementById('pass').value;
    var length = pass.length;
    var msgLength = document.getElementById("msgLength"); 
    msgLength.style.color = "red";
    if(length < 4)
        msgLength.innerHTML = "Le mot de passe doit faire plus de 4 caractères";
    else
        msgLength.innerHTML = "";
}

function verifyPassAgreement(){
    var pass = document.getElementById("pass").value;
    var passValidation = document.getElementById("pass_validation").value;
    var msgAgreement = document.getElementById("msgAgreement");
    msgAgreement.style.color = "red";

    if(pass != passValidation)
        msgAgreement.innerHTML = "Les deux mots de passe doivent être identiques";
    else
        msgAgreement.innerHTML = "";
}

function validMail(champ){
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    var msgMail = document.getElementById("msgMail");
    msgMail.style.color = "red";
    if(!regex.test(champ.value))
        msgMail.innerHTML = mail.value + " n'est pas une adresse mail valide";
    else
        msgMail.innerHTML = "";    
}

function verifyChecked(checks){

    if(checks.service[0] == false 
        && checks.service[1] == false
        && checks.service[2] == false
        && checks.service[3] == false
        && checks.service[4] == false
        && checks.service[5] == false
        && checks.service[6] == false
        && checks.service[7] == false){
        alert("Vous devez selectionner au moins une activité");
        return false;
    }else{
        alert("ok");
        return true;
    }    
}