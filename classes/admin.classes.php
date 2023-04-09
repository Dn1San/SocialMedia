<?php
    class Admin extends Dbh{

        public function setAdmin($username){
            $admin = 'admin';
            $stmt = $this->connect()->prepare('UPDATE users SET users_role=? WHERE users_username=?;');

            if(!$stmt->execute(array($admin, $username))) {
                $stmt = null;
                header("location: ../login.php?error=stmtfailed");
                exit();
            }

            $stmt = null;
        }

        public function reviewPosts($sendData){
            $postReview = 'under review';
            $stmt = $this->connect()->prepare('SELECT * FROM userposts WHERE post_status=?;');

            if(!$stmt->execute(array($postReview))) {
                $stmt = null;
                header("location: ../login.php?error=stmtfailed");
                exit();
            }

            $allPosts = $stmt->fetchAll(PDO::FETCH_OBJ);

            if($sendData){
                return $allPosts;
            }else{
                return $stmt->rowCount();
            }
        }

        public function acceptPost($postId){
            $postReview = 'accepted';
            $stmt = $this->connect()->prepare('UPDATE userposts SET post_status=? WHERE post_id=?;');

            if(!$stmt->execute(array($postReview, $postId))) {
                $stmt = null;
                header("location: ../login.php?error=stmtfailed");
                exit();
            }
        }

        public function rejectPost($postId){
            $postReview = 'rejected';
            $stmt = $this->connect()->prepare('UPDATE userposts SET post_status=? WHERE post_id=?;');

            if(!$stmt->execute(array($postReview, $postId))) {
                $stmt = null;
                header("location: ../login.php?error=stmtfailed");
                exit();
            }
        }
    }
?>