<?php
    class Notifications extends Dbh{
        public function sendNotification($id, $message){
            $stmt = $this->connect()->prepare('INSERT INTO usernotifications(user_id, noti_message) VALUES(?,?);');

            if(!$stmt->execute(array($id, $message))) {
                $stmt = null;
                header("location: ../friendsList.php?error=stmtfailed");
                exit();
            }

            $stmt = null;
        }

        public function retriveNotifications($id, $sendData){
            $stmt = $this->connect()->prepare('SELECT * FROM usernotifications WHERE user_id=?;');

            if(!$stmt->execute(array($id))) {
                $stmt = null;
                header("location: ../friendsList.php?error=stmtfailed");
                exit();
            }

            if($sendData){
                $allNotifications = $stmt->fetchAll(PDO::FETCH_OBJ);

                if($stmt->rowCount() > 0){
                    return $allNotifications;
                }
            }else{
                return $stmt->rowCount();
            }
        }
        
        
    }
?>