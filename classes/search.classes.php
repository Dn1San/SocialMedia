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

        // Fetch all users where id is not equal to my id
        function all_users_with_img($id){
            $return_data = [];

            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_id != ?');

            if(!$stmt->execute(array($id))) {
                $get_user_stmt = null;
                header("location: ../search.php?error=stmtfailed");
                exit();
            }

            $all_users = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach($all_users as $row){
                $get_user_stmt = $this->connect()->prepare('SELECT users_id, users_username FROM users WHERE users_id = ?;');

                if(!$get_user_stmt->execute(array($row->users_id))) {
                    $get_user_stmt = null;
                    header("location: ../search.php?error=stmtfailed");
                    exit();
                }

                $get_user_img_stmt = $this->connect()->prepare('SELECT userprofile_picture FROM userprofile WHERE user_id = ?;');

                if(!$get_user_img_stmt->execute(array($row->users_id))) {
                    $get_user_img_stmt = null;
                    header("location: ../search.php?error=stmtfailed");
                    exit();
                }
                array_push($return_data, $get_user_stmt->fetch(PDO::FETCH_OBJ), $get_user_img_stmt->fetch(PDO::FETCH_OBJ));

                $get_user_stmt = null;
                $get_user_img_stmt = null;
            }
            if($stmt->rowCount() > 0){
                return $return_data;
            }
            else{
                return false;
            }
            $stmt = null;
        }

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