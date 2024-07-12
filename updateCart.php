<?
    include "conection.php";

    $id_product = $_POST['number_strong'];
    $quantity_product = $_POST['quantity_product'];
    $subtotal = $_POST['subtotal'];
    $price = $_POST['price'];


    $sql_quantity = "SELECT `quantity` FROM `shopping_cart` WHERE `id` = '$id_product'";
    $result_sql_quantity = mysqli_query($conection, $sql_quantity);
    if(!$result_sql_quantity)
    {
        die("Database query failed.");
    }
    while($row = mysqli_fetch_assoc($result_sql_quantity))
    { 
      $number = $row['quantity'];
    }

    $result_summa_quantity = $number+1;
        
    $update = "UPDATE `shopping_cart` 
    SET `quantity`='$result_summa_quantity'
    WHERE `id`='$id_product'"; 
    $result_summa_quantity = mysqli_query($conection, $update);
    



    $subtotal_sql = "SELECT `quantity` FROM `shopping_cart` WHERE `id` = '$id_product'";
    $result_subtotal_sql = mysqli_query($conection, $subtotal_sql);
    if(!$result_subtotal_sql)
    {
        die("Database query failed.");
    }
    while($row = mysqli_fetch_assoc($result_subtotal_sql))
    { 
      $number2 = $row['quantity'];
    }

    $subtotal_price = $price * $number2;

    $update_subtotal_price = "UPDATE `shopping_cart` 
    SET `subtotal`='$subtotal_price'
    WHERE `id`='$id_product'"; 
    $result_subtotal_price = mysqli_query($conection, $update_subtotal_price);

    echo $subtotal_price;

?>
