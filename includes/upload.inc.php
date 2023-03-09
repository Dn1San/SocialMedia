<?php
    $file = $_FILES['profilePic'];

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
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: login.php?signup success");
            }else{
                echo "File size needs to be less than 1MB!";
            }
        }else{
            echo "There was an error uploading the file!";
        }
    }else {
        echo "You cannout upload files of this type!";
    }
?>
    

