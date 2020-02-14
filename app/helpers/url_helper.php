<?php


function redirect($page){
	header('location: ' . URLROOT . '/' . $page);
}

 function isloggedIn(){
    if(isset($_SESSION['user_id'])){
        return true;
    }else {
        return false;
    }
}

function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_firstname']);
        unset($_SESSION['user_lastname']);
        unset($_SESSION['user_email']);
        unset($_SESSION['notif']);
        session_destroy();
        redirect('users/login');
    }

    