<?
    include "conection.php";

    $id = $_GET['id'];
    $product_model_id = $_GET['product_model_id'];

    $delete_query = "DELETE FROM `shopping_cart` WHERE `id` = '$id' AND `order_id` = '$product_model_id'";
    $result_delete_query = mysqli_query($conection, $delete_query);
    header("Location: shopping_cart.php");


?>

