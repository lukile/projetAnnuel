function caca(idMsg) {

    var tdList = document.getElementsByName("msg" + idMsg); 
    for(var i = 0; i < tdList.length; i++) {
        var td = tdList[i];
        var str = td.innerHTML;     
        td.innerHTML="";        
        var input = document.createElement("input");     
        input.value = str;  
        input.name = "input_animal_" + idAnimal;  
        td.appendChild(input);    
    }

    var buttonModify = document.getElementById("button_animal_" + idAnimal);
    buttonModify.innerHTML = "validate";
    buttonModify.setAttribute("onclick", "validateAnimal(" + idAnimal + ")");
}

function readMsg(idMsg) {
     var request = new XMLHttpRequest();
     var id = document.getElementById("msg" + idMsg);
     var body = id;
     var body = "msg" + idMsg;  
     request.onreadystatechange = function() {
        //if(request.readyState == 4) {
          //  displayAnimal();
        }
    
    };
    request.open("POST", "modifyMsg.php");
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(body);
}