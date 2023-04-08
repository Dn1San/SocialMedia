<?php
    class Search extends Dbh{
        
        // Find by user id
        function find_user_by_id($id){
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_id = ?;');

            if(!$stmt->execute(array($id))) {
                $stmt = null;
                header("location: ../search.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() === 1){
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }

            $stmt = null;
        }

        // Fetch all users
        function all_users($id){

            $stmt = $this->connect()->prepare('SELECT users_id, users_username FROM users WHERE users_id != ?');

            if(!$stmt->execute(array($id))) {
                $get_user_stmt = null;
                header("location: ../search.php?error=stmtfailed");
                exit();
            }

            $all_users = $stmt->fetchAll(PDO::FETCH_OBJ);

            if($stmt->rowCount() > 0){
                return $all_users;
            }
            else{
                return false;
            }
            $stmt = null;
        }
    }
?>