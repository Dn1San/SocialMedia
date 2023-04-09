<?php
    class Friend extends Dbh{

        // CHECK IF ALREADY FRIENDS
        public function isAlreadyFriends($myId, $userId){
            $stmt = $this->connect()->prepare('SELECT * FROM userfriends WHERE (friends_one=? AND friends_two=?) OR (friends_one=? AND friends_two=?)');

            if(!$stmt->execute(array($myId, $userId, $userId, $myId))) {
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
        public function amITheReqSender($myId, $userId){
            $stmt = $this->connect()->prepare('SELECT * FROM userfriendrequest WHERE request_sender=? AND request_receiver=?');

            if(!$stmt->execute(array($myId, $userId))) {
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
        public function amITheReqReceiver($myId, $userId){
            
            $stmt = $this->connect()->prepare('SELECT * FROM userfriendrequest WHERE request_sender=? AND request_receiver=?');

            if(!$stmt->execute(array($userId, $myId))) {
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
        public function isRequestAlreadySent($myId, $userId){
            $stmt = $this->connect()->prepare('SELECT * FROM userfriendrequest WHERE (request_sender=? AND request_receiver=?) OR (request_sender=? AND request_receiver=?)');

            if(!$stmt->execute(array($myId, $userId, $userId, $myId))) {
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
        public function makePendingFriends($myId, $userId){
            $stmt = $this->connect()->prepare('INSERT INTO userfriendrequest(request_sender, request_receiver) VALUES(?,?)');

            if(!$stmt->execute(array($myId, $userId))) {
                $stmt = null;
                header("location: ../userProfile.php?error=stmtfailed");
                exit();
            }else{
                $stmt = null;
                header("location: userProfile.php?id=".$userId);
                exit();
            }
        }

        // CANCLE FRIEND REQUEST
        public function cancelOrIgnoreFriendRequest($myId, $userId){
            $stmt = $this->connect()->prepare('DELETE FROM userfriendrequest WHERE (request_sender=? AND request_receiver=?) OR (request_sender=? AND request_receiver=?)');

            if(!$stmt->execute(array($myId, $userId, $userId, $myId))) {
                $stmt = null;
                header("location: friendsList.php?error=stmtfailed");
                exit();
            }else{
                $stmt = null;
                header("location: userProfile.php?id=".$userId);
                exit();
            }

        }

        // MAKE FRIENDS
        public function makeFriends($myId, $userId){
            $stmt = $this->connect()->prepare('DELETE FROM userfriendrequest WHERE (request_sender=? AND request_receiver=?) OR (request_sender=? AND request_receiver=?)');

            if(!$stmt->execute(array($myId, $userId, $userId, $myId))) {
                $stmt = null;
                header("location: ../friendsList.php?error=stmtfailed");
                exit();
            }
            $stmt = null;

            $stmt = $this->connect()->prepare('INSERT INTO userfriends(friends_one, friends_two) VALUES(?, ?)');

            if(!$stmt->execute(array($myId, $userId))) {
                $stmt = null;
                header("location: friendsList.php?error=stmtfailed");
                exit();
            }else{
                $stmt = null;
                header("location: friendsList.php");
                exit();
            }    
        }

        // DELETE FRIENDS 
        public function deleteFriends($myId, $userId){
            $stmt = $this->connect()->prepare('DELETE FROM userfriends WHERE (friends_one=? AND friends_two=?) OR (friends_one=? AND friends_two=?)');

            if(!$stmt->execute(array($myId, $userId, $userId, $myId))) {
                $stmt = null;
                header("location: userProfile.php?id=".$userId."error=stmtfailed");
                exit();
            }else{
                $stmt = null;
                header("location: userProfile.php?id=".$userId);
                exit();
            }
        }

        // REQUEST NOTIFICATIONS
        public function requestNotification($myId, $sendData){
            $stmt = $this->connect()->prepare('SELECT request_sender, users_username, users_id FROM userfriendrequest JOIN users ON userfriendrequest.request_sender = users.users_id WHERE request_receiver = ?');

            if(!$stmt->execute(array($myId))) {
                $stmt = null;
                header("location: ../friendsList.php?error=stmtfailed");
                exit();
            }
            if($sendData){
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return $stmt->rowCount();
            }

            $stmt = null;
        }


        public function getAllFriends($myId, $sendData){
            $stmt = $this->connect()->prepare('SELECT * FROM userfriends WHERE friends_one=? OR friends_two=?;');

            if(!$stmt->execute(array($myId, $myId))) {
                $stmt = null;
                header("location: ../friendsList.php?error=stmtfailed");
                exit();
            }

            if($sendData){
                $returnData = [];
                $allUsers = $stmt->fetchAll(PDO::FETCH_OBJ);

                foreach($allUsers as $row){
                    if($row->friends_one == $myId){
                        $getUserStmt = $this->connect()->prepare('SELECT users_id, users_username FROM users WHERE users_id = ?;');

                        if(!$getUserStmt->execute(array($row->friends_two))) {
                            $getUserStmt = null;
                            header("location: ../friendsList.php?error=stmtfailed");
                            exit();
                        }
                        array_push($returnData, $getUserStmt->fetch(PDO::FETCH_OBJ));
                    }else{
                        $getUserStmt = $this->connect()->prepare('SELECT users_id, users_username FROM users WHERE users_id = ?;');

                        if(!$getUserStmt->execute(array($row->friends_one))) {
                            $getUserStmt = null;
                            header("location: ../friendsList.php?error=stmtfailed");
                            exit();
                        }
                        array_push($returnData, $getUserStmt->fetch(PDO::FETCH_OBJ));
                    }
                }

                return $returnData;
            }
            else{
                return $stmt->rowCount();
            }
        }

        public function getFriendProfileImage($id){
            $stmt = $this->connect()->prepare('SELECT userprofile_picture FROM userprofile WHERE user_id = ?;');

            if(!$stmt->execute(array($id))) {
                $stmt = null;
                header("location: ../friendsList.php?error=stmtfailed");
                exit();
            }
            $image = $stmt->fetch(PDO::FETCH_OBJ);

            if($image == null){
                return "uploads/defualtProfile.jpg";
            }else{
                return $image->userprofile_picture;
            }
        }
    }
?>