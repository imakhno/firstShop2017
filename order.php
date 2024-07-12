<?
    session_start();

    if(!$_SESSION['user_login'])
    {
        header("Location: login.php");
        exit;
    }

    include "conection.php";



    $value_option = $_POST['option']; 
    $id = $_POST['id'];
    print_r($_POST);


    $update = "UPDATE `orders` SET `condition`='$value_option' WHERE `id` = '$id'";
    $result_update = mysqli_query($conection, $update);
?>