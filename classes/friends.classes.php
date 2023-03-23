<?php
class Friend extends Dbh{

    // CHECK IF ALREADY FRIENDS
    public function is_already_friends($my_id, $user_id){
        $stmt = $this->connect()->prepare('SELECT * FROM userfriends WHERE friends_one=? AND friends_two=?');

        if(!$stmt->execute(array($my_id, $user_id))) {
            $stmt = null;
            header("location: ../friendsList.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() === 1){
            return true;
        }else{
            return false;
        }

        $stmt = null;
    }

    //  IF I AM THE REQUEST SENDER
    public function am_i_the_req_sender($my_id, $user_id){
        $stmt = $this->connect()->prepare('SELECT * FROM userfriendrequest WHERE request_sender=? AND request_receiver=?');

        if(!$stmt->execute(array($my_id, $user_id))) {
            $stmt = null;
            header("location: ../friendsList.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() === 1){
            return true;
        }else{
            return false;
        }

        $stmt = null;
    }

    //  IF I AM THE RECEIVER 
    public function am_i_the_req_receiver($my_id, $user_id){
        
        $stmt = $this->connect()->prepare('SELECT * FROM userfriendrequest WHERE request_sender=? AND request_receiver=?');

        if(!$stmt->execute(array($user_id, $my_id))) {
            $stmt = null;
            header("location: ../friendsList.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() === 1){
            return true;
        }else{
            return false;
        }

        $stmt = null;
    }

    // CHECK IF REQUEST HAS ALREADY BEEN SENT
    public function is_request_already_sent($my_id, $user_id){
        $stmt = $this->connect()->prepare('SELECT * FROM userfriendrequest WHERE request_sender=? AND request_receiver=?');

        if(!$stmt->execute(array($my_id, $user_id))) {
            $stmt = null;
            header("location: ../friendsList.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() === 1){
            return true;
        }else{
            return false;
        }

        $stmt = null;
    }

    // MAKE PENDING FRIENDS (SEND FRIEND REQUEST)
    public function make_pending_friends($my_id, $user_id){
        $stmt = $this->connect()->prepare('INSERT INTO userfriendrequest(request_sender, request_receiver) VALUES(?,?)');

        if(!$stmt->execute(array($my_id, $user_id))) {
            $stmt = null;
            header("location: ../userProfile.php?error=stmtfailed");
            exit();
        }else{
            $stmt = null;
            header("location: ../userProfile.php?id=".$user_id);
            exit();
        }
    }

    // CANCLE FRIEND REQUEST
    public function cancel_or_ignore_friend_request($my_id, $user_id){
        $stmt = $this->connect()->prepare('DELETE FROM userfriendrequest WHERE (request_sender=? AND request_receiver=?) OR (request_sender=?AND request_receiver=?');

        if(!$stmt->execute(array($my_id, $user_id, $user_id, $my_id))) {
            $stmt = null;
            header("location: ../friendsList.php?error=stmtfailed");
            exit();
        }else{
            $stmt = null;
            header("location: ../userProfile.php?id=".$user_id);
            exit();
        }

    }

    // MAKE FRIENDS
    public function make_friends($my_id, $user_id){
        $stmt = $this->connect()->prepare('DELETE FROM userfriendrequest WHERE (request_sender=? AND request_receiver=?) OR (request_sender=? AND request_reciever=?)');

        if(!$stmt->execute(array($user_id, $my_id, $my_id, $user_id))) {
            $stmt = null;
            header("location: ../friendsList.php?error=stmtfailed");
            exit();
        }
        $stmt = null;

        $stmt = $this->connect()->prepare('INSERT INTO userfriends(friends_one, friends_two) VALUES(?, ?)');

        if(!$stmt->execute(array($my_id, $user_id, $user_id, $my_id))) {
            $stmt = null;
            header("location: ../friendsList.php?error=stmtfailed");
            exit();
        }else{
            $stmt = null;
            header("location: ../userProfile.php?id=".$user_id);
            exit();
        }    
    }

    // DELETE FRIENDS 
    public function delete_friends($my_id, $user_id){
        $stmt = $this->connect()->prepare('DELETE FROM userfriends WHERE (friends_one=? AND friends_two=?) OR (friends_one=? AND friends_two=?)');

        if(!$stmt->execute(array($my_id, $user_id, $user_id, $my_id))) {
            $stmt = null;
            header("location: ../friendsList.php?error=stmtfailed");
            exit();
        }else{
            $stmt = null;
            header("location: ../userProfile.php?id=".$user_id);
            exit();
        }
    }

    // REQUEST NOTIFICATIONS
    public function request_notification($my_id, $send_data){
        try{
            $sql = "SELECT sender, username, user_image FROM `friend_request` JOIN users ON friend_request.sender = users.id WHERE receiver = ?";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([$my_id]);
            if($send_data){
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return $stmt->rowCount();
            }

        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }


    public function get_all_friends($my_id, $send_data){
        $stmt = $this->connect()->prepare('SELECT * FROM userfriends WHERE friends_one=? OR friends_two=?;');

        if(!$stmt->execute(array($my_id, $my_id))) {
            $stmt = null;
            header("location: ../friendsList.php?error=stmtfailed");
            exit();
        }

        if($send_data){

            $return_data = [];
            $all_users = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach($all_users as $row){
                if($row->friends_one == $my_id){
                    $get_user_stmt = $this->connect()->prepare('SELECT users_id, users_username, FROM users WHERE users_id = ?;');

                    if(!$get_user_stmt->execute(array([$row->friends_two]))) {
                        $get_user_stmt = null;
                        header("location: ../friendsList.php?error=stmtfailed");
                        exit();
                    }

                    $get_user_img_stmt = $this->connect()->prepare('SELECT userprofile_picture, userprofile_description, FROM userprofile WHERE user_id = ?;');

                    if(!$get_user_img_stmt->execute(array([$row->friends_two]))) {
                        $get_user_img_stmt = null;
                        header("location: ../friendsList.php?error=stmtfailed");
                        exit();
                    }
                    array_push($return_data, $get_user_stmt->fetch(PDO::FETCH_OBJ), $get_user_img_stmt->fetch(PDO::FETCH_OBJ));
                }else{
                    $get_user_stmt = $this->connect()->prepare('SELECT users_id, users_username, FROM users WHERE users_id = ?;');

                    if(!$get_user_stmt->execute(array([$row->friends_one]))) {
                        $get_user_stmt = null;
                        header("location: ../friendsList.php?error=stmtfailed");
                        exit();
                    }

                    $get_user_img_stmt = $this->connect()->prepare('SELECT userprofile_picture, userprofile_description, FROM userprofile WHERE user_id = ?;');

                    if(!$get_user_img_stmt->execute(array([$row->friends_one]))) {
                        $get_user_img_stmt = null;
                        header("location: ../friendsList.php?error=stmtfailed");
                        exit();
                    }
                    array_push($return_data, $get_user_stmt->fetch(PDO::FETCH_OBJ), $get_user_img_stmt->fetch(PDO::FETCH_OBJ));
                }
            }

            return $return_data;
        }
        else{
            return $stmt->rowCount();
        }
    }
}
?>