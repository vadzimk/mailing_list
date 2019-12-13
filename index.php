<?php
require('./model/database.php');

$action = filter_input(INPUT_POST, 'action');
$admin = filter_input(INPUT_POST, 'admin', FILTER_VALIDATE_BOOLEAN);

if ($action ==null){
    $action = filter_input(INPUT_GET, 'action');
    if($action==null){
        $action='display_form';
    }
}

//determine if they need to subscribe
if ($action=='display_form') {
    include('./view/form.php');
} else if($action == 'display_list'){
    $email_list = getSubscribers();
    include ("email_list.php");
}else if ($action == "subscribe") {
    // process the form to subscribe
    //validate email
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if($email==null || $email ==false){
        $error = 'Invalid email address, try again';
        include('./errors/error.php');
    } else{
        if(emailExists($email)){
            $error = 'Email is already subscribed';
            include('./errors/error.php');
        } else {
            $success = addRecord($email);
            if($success){
                $display_block = 'Thanks for signing up!';
                include ('./view/form.php');
            } else {
                $error = 'Failed to add your email - database error';
                include ('./errors/error.php');
            }
        }
    }
} else if($action=="unsubscribe"){
    // trying to unsubscribe
    //validate email
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if($email==null || $email ==false){
        $error = 'Invalid email address, try again';
        include('./errors/error.php');
    } else{
        if(!emailExists($email)){
            $error = 'You have not been subscribed yet.';
            include('./errors/error.php');
        } else {
            $success = removeRecord($email);
            if($success){
                $display_block = 'You have been unsubscribed!';
                if($admin == false) {
                    include('./view/form.php');
                } else {
                    $action = 'display_list';
                    header("Location: .?action=$action&display_block=$display_block");
                }
            } else {
                $error = 'Failed to unsubscribe your email - database error';
                include ('./errors/error.php');
            }
        }
    }
    //--------
} else if($action=="suspend"){
    // trying to suspend
    //validate email
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if($email==null || $email ==false){
        $error = 'Invalid email address, try again';
        include('./errors/error.php');
    } else{
        if(!emailExists($email)){
            $error = 'You have not been subscribed yet.';
            include('./errors/error.php');
        } else {
            $success = suspendRecord($email);
            if($success){
                $display_block = 'Email has been suspended!';
                if($admin == false) {
                    include('./view/form.php');
                } else {
                    $action = 'display_list';
                    header("Location: .?action=$action&display_block=$display_block");
                }
            } else {
                $error = 'Failed to suspend your email - database error';
                include ('./errors/error.php');
            }
        }
    }
}

?>