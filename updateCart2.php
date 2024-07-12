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

    if($number = 1)
    {
        $update = "UPDATE `shopping_cart` 
        SET `quantity`='$number'
        WHERE `id`='$id_product'"; 
        $result_summa_quantity = mysqli_query($conection, $update); 
    }else
    {
        $result_summa_quantity = $number-1;
        
        $update = "UPDATE `shopping_cart` 
        SET `quantity`='$result_summa_quantity'
        WHERE `id`='$id_product'"; 
        $result_summa_quantity = mysqli_query($conection, $update);
    }
        
    $update = "UPDATE `shopping_cart` 
    SET `quantity`='$result_summa_quantity'
    WHERE `id`='$id_product'"; 
    $result_summa_quantity = mysqli_query($conection, $update);


    $subtotal_sql = "SELECT * FROM `shopping_cart` WHERE `id` = '$id_product'";
    $result_subtotal_sql = mysqli_query($conection, $subtotal_sql);
    if(!$result_subtotal_sql)
    {
        die("Database query failed.");
    }
    while($row = mysqli_fetch_assoc($result_subtotal_sql))
    { 
      $number2 = $row['quantity'];
      $number_subtotal = $row['subtotal'];
    }





        $subtotal_price = $number_subtotal - $price;

        $update_subtotal_price = "UPDATE `shopping_cart` 
        SET `subtotal`='$subtotal_price'
        WHERE `id`='$id_product'"; 
        $result_subtotal_price = mysqli_query($conection, $update_subtotal_price);
        
        echo $subtotal_price;
    
    


?>
