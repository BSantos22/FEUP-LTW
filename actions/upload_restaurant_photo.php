<?php
    session_start();

    include_once("../database/connection.php");
    include_once("../database/restaurantphoto.php");

    if (isset($_POST["uploadrestaurantphoto"])){

        if ($_FILES['restaurantphoto']['error'] !== UPLOAD_ERR_OK) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die("Upload failed with error code " . $_FILES['restaurantphoto']['error']);
        }

        $info = getimagesize($_FILES['restaurantphoto']['tmp_name']);
        if ($info === FALSE) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die("Unable to determine image type of uploaded file");
        }

        if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die("Not a gif/jpeg/png");
        }

        if ($_FILES["restaurantphoto"]["size"] > 1048576) { // 1MB
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        $targetDir = "../uploads/restaurants/"; // Directory to save the file
        $targetName = basename($_FILES["restaurantphoto"]["name"]);  // Name of the file
        $fileType = pathinfo($targetName ,PATHINFO_EXTENSION); // File type
        $originalFileName = basename($targetName ,'.'.$fileType);
        $fileName = $originalFileName. time() . '.' . $fileType;
        $targetFile = $targetDir . $fileName; // Final path to save the file

        if(file_exists($targetFile)) {
            chmod($targetFile); // Change the file permissions if allowed
            unlink($targetFile); // Remove the file
        }

        if (move_uploaded_file($_FILES['restaurantphoto']['tmp_name'], $targetFile)) {
            try{
                insertRestaurantPhoto($db, $_POST['idRestaurant'], $fileName);
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }
    }

    header('Location: ' . "../pages/restaurant.php?id=".$_POST['idRestaurant']);
?>