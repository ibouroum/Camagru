<?php

function comment_sent_email($data)
    {
        
        $subject = "Your post has been commented" ;
        $email = $data['user_post']->email;
        
        $message = '
        <p>Welcome to Camagru,
            <br /><br />
            @'.$data[user_comment]->username.' commented your post
        </p>
        <p>
            <br />--------------------------------------------------------
            <br />This is an automatic mail , please do not reply.
        </p> ';
        
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: <ibouroum@Camagru.ma>' . "\r\n";
 
         mail($email, $subject, $message, $headers);
        

    }

    function activate_sent_email($email , $cle)
    {
        
        $subject = "Activate your account" ;
        
        
        $message = '
        <p>Welcome to Camagru,
            <br /><br />
            To verify your account, Please click on the link below or copy/paste it in your navigator :
        </p>
        <p>
            <br/>
            To activate your account click here 
            <a href="http://localhost/Camagru/users/verification/?email='.$email.'&cle='.$cle.'">
            <button type="button" class="btn btn-primary">Activate</button>
        </a>
        </p>
        <p>
            <br />--------------------------------------------------------
            <br />This is an automatic mail , please do not reply.
        </p> ';
       
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

     
        $headers .= 'From: <ibouroum@Camagru.ma>' . "\r\n";
 
        mail($email, $subject, $message, $headers);

    }

    function forget_sent_email($data)
    {
       
        
        $subject = "Recover your Password" ;
        $message = '
        <p>Welcome to Camagru,
            <br /><br />
            To reset your password, Please click on the link below or copy/paste it in your navigator :
        </p>
        <p>
            <br/>
            To recover your account click here 
            <a href="http://localhost/Camagru/users/recover/?email='.$data->email.'&cle='.$data->cle.'">
            <button type="button" class="btn btn-primary">Change Password</button>
        </a>
        </p>
        <p>
            <br />--------------------------------------------------------
            <br />This is an automatic mail , please do not reply.
        </p> ';

       
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

       
        $headers .= 'From: <ibouroum@Camagru.ma>' . "\r\n";
        if(mail($data->email, $subject, $message, $headers))
            return true;
        else {
            return false;
        }
    }
    function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['actif'] = $user->actif;
        $_SESSION['notif'] = $user->notif;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_firstname'] = $user->firstname;
        $_SESSION['user_lastname'] = $user->lastname;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['cle'] = $user->cle;

        
    }