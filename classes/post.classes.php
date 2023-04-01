<?php
    class Post extends Dbh{

        private $postPicture;
        private $postDescription;
    
        private function setPostPicture() {
            $file = $_FILES['userpost'];

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];

            $fileEXT = explode('.', $fileName);
            $fileActualEXT = strtolower(end($fileEXT));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualEXT, $allowed)){
                if($fileError === 0){
                if($fileSize < 1000000){
                    $fileNameNew = uniqid('', true).".".$fileActualEXT;
                    $fileDestination = '../uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $this->postPicture = 'uploads/' . $fileNameNew;
                }else{
                    echo "File size needs to be less than 1MB!";
                }
                }else{
                echo "There was an error uploading the file!";
                }
            }else {
                echo "You cannot upload files of this type!";
            }
        }
    
        public function setPostDescription($description) {
            $this->postDescription = $description;
        }

        public function savePost() {
            session_start();
            if (isset($_SESSION['userid'])){
                $this->setPostPicture();

                $stmt = $this->connect()->prepare('INSERT INTO userposts(user_id, post_picture, post_description) VALUES (?, ?,?)');

                if(!$stmt->execute(array($_SESSION['userid'], $this->postPicture, $this->postDescription))) {
                $stmt = null;
                header("location: ../editProfile.php?error=stmtfailed");
                exit();
                }

                $stmt = null;
            }
        }

        public function deletePost($postID) {
            session_start();
            if (isset($_SESSION['userid'])){
                $stmt = $this->connect()->prepare('DELETE FROM userposts WHERE post_id=? AND user_id=?');

                if(!$stmt->execute(array($postID, $_SESSION['userid']))) {
                $stmt = null;
                header("location: ../editProfile.php?error=stmtfailed");
                exit();
                }

                $stmt = null;
            }
        }

        public function getUserPosts($id, $send_data) {
            $return_data = [];
            $stmt = $this->connect()->prepare('SELECT * FROM userprofile WHERE user_id = ?;');

            if(!$stmt->execute(array($id))) {
                $stmt = null;
                header("location: ../myProfile.php?error=stmtfailed");
                exit();
            }
            array_push($return_data, $stmt->fetch(PDO::FETCH_OBJ));

            if($send_data){
                return $return_data;
            }else{
                return $stmt->rowCount();
            }

            $stmt = null;
        }
    }
?>