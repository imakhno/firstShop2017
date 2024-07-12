<?
    session_start();

    if(!$_SESSION['user_login'])
    {
        header("Location: login.php");
        exit;
    }

    
    include "conection.php";


    if(isset($_POST['exit']))
    {
        unset($_SESSION['user_login']);
        header("Location: login.php");
    }

    $id = $_GET['id'];
    $email = $_GET['email'];
    $id_order = $_GET['id_orders'];


    $delete_query_order = "DELETE FROM `orders` WHERE `id` = '$id_order'";
    $result_delete_query_order = mysqli_query($conection, $delete_query_order);
    header("Location: 01_orders.php");


    $delete_query = "DELETE FROM `shopping_cart` WHERE `id` = '$id'";
    $result_delete_query = mysqli_query($conection, $delete_query);
    header("Location: 02_order_information.php?email=$email");
    
    $query = "SELECT * FROM `shopping_cart` WHERE `email` = '$email'";
    $data = mysqli_query($conection, $query);
    if(mysqli_num_rows($data) == 0)
    {
        $query = "DELETE FROM `orders` WHERE `email` = '$email'";
        mysqli_query($conection, $query);
    }













?>