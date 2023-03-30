<?php
require '../classes/dbh.classes.php';
require '../classes/dbh.search.php';
require '../classes/dbh.friends.php';

$search = new Search();
$friend = new Friend();

// PROFILE REDIRECT FUNCTION
function redirect_to_profile(){
    header('Location: myProfile.php');
    exit;
}
// IF GET ACTION AND ID PARAMETERS
if(isset($_GET['action']) && isset($_GET['id'])){
    // CHEKC USER LOGGED IN OR NOT  IF USER LOGGED IN
    if(isset($_SESSION['userid']) && isset($_SESSION['email'])){
        // IF PARAMETER ID IS EQUAL TO MY ID($_SESSION['user_id']) THEN REDIRECT TO PROFILE
        if($_GET['id'] == $_SESSION['user_id']){
            redirect_to_profile();
        }
        // OTHERWISE DO THIS
        else{
            // ASSIGN TO VARIABLE 
            $user_id = $_GET['id'];
            $my_id = $_SESSION['userid'];

            // IF GET SEND REQUEST ACTION
            if($_GET['action'] == 'send_req'){
                // CHECK IS REQUEST ALREADY SENT OR NOT
                // is_request_already_sent() FUNCTION RETURN TRUE OR FLASE
                if($friend->is_request_already_sent($my_id, $user_id)){
                    redirect_to_profile();
                }
                // CHECK IF THIS ID IS ALREADY IN MY FRIENDS LIST.
                // THIS FUNCTION ALSO RETURN TRUE OR FLASE 
                elseif($friend->is_already_friends($my_id, $user_id)){
                    redirect_to_profile();
                }
                // OTHERWISE MAKE FRIEND REQUEST
                else{
                    $friend->make_friends($my_id, $user_id);
                }
            }
            // IF GET CANCEL REQUEST OR IGNORE REQUEST ACTION
            else if($_GET['action'] == 'cancel_req'  $_GET['action'] == 'ignore_req'){
                $frnd_obj->cancel_or_ignore_friend_request($my_id, $user_id);
            }
            // IF GET ACCEPT REQUEST ACTION
            elseif($_GET['action'] == 'accept_req'){

                if($frnd_obj->is_already_friends($my_id, $user_id)){
                    redirect_to_profile();
                }
                else{
                    $frnd_obj->make_friends($my_id, $user_id);
                }
            }
            // IF GET UNFRIEND REQUEST ACTION
            elseif($_GET['action'] == 'unfriend_req'){
                $frnd_obj->delete_friends($my_id, $user_id);
            }
            else{
                redirect_to_profile();
            }
        }
    }
    else{
        header('Location: logout.php');
        exit;
    }
}
else{
    redirect_to_profile();
}