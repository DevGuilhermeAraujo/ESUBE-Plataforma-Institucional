<?php
session_start();

//Constantes de ambiente
const SESSION_USER_RA_ID = "UserRaId";
const SESSION_USERNAME = "UserName";
const SESSION_USER_IDPERMISSION = "UserIdPermission";


//Funções para o Front-End
function Logued(){
    if(isset($_SESSION[SESSION_USER_RA_ID]) && $_SESSION[SESSION_USER_RA_ID] != ""){
        if(isset($_SESSION[SESSION_USERNAME]) || $_SESSION[SESSION_USERNAME] != "")
            if(isset($_SESSION[SESSION_USER_IDPERMISSION]) || $_SESSION[SESSION_USER_IDPERMISSION] != "")
                return true;
    }
    return false;
}


function requiredLogin()
{
    if(!Logued()){
        header("Location: ../Login/pagLogin.php");
    }
}

?>