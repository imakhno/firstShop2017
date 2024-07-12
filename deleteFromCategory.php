<?
    include "conection.php";


    $id_category = $_GET['id_category'];
    $name = $_GET['name'];

    $delete_query_category = "DELETE FROM `product_type` WHERE `id` = '$id_category' AND `name` = '$name'";
    $result_delete_query = mysqli_query($conection, $delete_query_category);
    
    $drop_table = "DROP TABLE $name;";
    $result_drop_table = mysqli_query($conection, $drop_table);
    mysqli_select_db($conection, 'Shop');
    header("Location: 05_items.php");
?>

