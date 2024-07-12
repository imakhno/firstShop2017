<?
session_start();

if(!$_SESSION['user_login'])
{
    header("Location: login.php");
    exit;
}


include "conection.php";


    $type_product = $_GET['product_type'];
    $model_id = $_GET['model_id'];


if(isset($_POST['exit']))
{
    unset($_SESSION['user_login']);
    header("Location: login.php");
}
/*===========================================================================*/
$product = "SELECT * FROM `$type_product` WHERE `model_id` = '$model_id'";

$result_product = mysqli_query($conection, $product);
if(!$result_product)
{
    die("Database query failed.");
}


while($row = mysqli_fetch_assoc($result_product))
{
    $name = $row['name'];
    $description = $row['description'];
    $price = $row['price'];
    $color = $row['color'];
}


/*===========================================================================*/
$image_sql = "SELECT images.url 
FROM product_type 
JOIN product_images ON product_type.id = product_images.product_type_id 
JOIN images ON images.id = product_images.images_id 
WHERE product_type.name = '$type_product' 
AND product_images.product_model_id = '$model_id'";

$result_image = mysqli_query($conection, $image_sql);

if(!$result_image)
{
    die("Database query failed.");
}

$img = array();

while($row = mysqli_fetch_assoc($result_image))
{ 
  $img[] = $row['url'];
}
/*===========================================================================*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Товары | Super shop</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css_style/item_information.css">
</head>
<body>
    <div class="container-fluid">
        <div class="navigation">
                <a href="index.php">
                    <div class="logo">
                        <div class="text">
                            <span class="text-up">super</span>
                            <span class="text-down">shop</span>
                        </div>
                    </div>
                </a>
            <div  class="nav">
                    <li><a href="01_orders.php"><img class="img-auth" src="image/basket_1.png" alt=""><span class="auth">ЗАКАЗЫ</span></a></li>
                    <li><a href="03_users.php"><img class="img-auth" src="image/pol.png" alt=""><span class="auth">ПОЛЬЗОВАТЕЛИ</span></a></li>
                    <li><a href="05_items.php"><img class="img-auth" src="image/tov.png" alt=""><span class="auth">ТОВАРЫ</span></a></li>
                    <div class="bottom">
                        <div class="name"><?echo $_SESSION['user_login'];?></div>
                        <form action="" method="POST">
                            <button class="logout" type="submit" name="exit"><span class="text">Выход</span></button>
                        </form>
                    </div>                        
            </div>
        </div>
        <div class="container">
         <form action="" method="post">
            <div class="title">
                <span class="span_1">ПРОСМОТР ТОВАРА</span>
            </div>
            <div class="content">
                <div class="strong_1">
                    <div class="block_1">
                        <p>ИНФОРМАЦИЯ О ТОВАРЕ</p>
                    </div>
                </div>
                <div class="strong_2">
                    <div class="block_1">
                        <span class="span">Название товара:</span><br> 
                        <input name='name' class="name" type="name" value="<?echo $name;?>"><br>                   
                        <span class="span">Описание товара:</span><br> 
                        <textarea name='description' id="" value=""><?echo $description?></textarea>                            
                    </div>
                    <div class="block_2">
                        <span class="span">Бейджик:</span><br>
                        <input type="radio" name="shipping" value="none"><span>ОТСУТСТВУЕТ</span><br>
                        <input type="radio" name="shipping" value="new"><span>NEW</span><br>                                            
                        <input type="radio" name="shipping" value="hot"><span>HOT</span><br>
                        <input type="radio" name="shipping" value="sale"><span>SALE</span><br>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="strong_1">
                    <div class="block_1">
                        <p>ФОТОГРАФИИ ТОВАРА</p>
                    </div>
                </div>
                <div class='strong_3'>

                <?
                foreach($img as $v)
                {
                    echo "<div class='block_1'>
                    <img src='$v'>
                   <br>
                  <button name='cover' type='submit' class='cover'>Изменить</button><br>
                  <button name='del_img' type='submit' class='delete'>Удалить</button>
                </div>";
                }
                ?>

                    <div class="block_1">
                          <div class="img">
                              <p>не загружено</p>
                          </div>
                          <button name="download" type="submit" class="download">Загрузить</button><br>  
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="strong_1">
                    <div class="block_1">
                        <p>ВАРИАЦИИ ТОВАРА</p>
                    </div>
                </div>
                <div class="strong_4">
                    <div class="block_1">
                          <input type="text"><button name="del_var" type="submit" class="delete">Удалить</button>
                    </div>
                </div>

            </div>
            <div class="strong_5">
                <div class="left">
                    <button name="del_product" type="submit">Удалить товар</button>
                </div>
                <?
                    if(isset($_POST['save']))
                    {
                        $update_name = mysqli_real_escape_string($conection, trim($_POST['name']));
                        $update_description = $_POST['description'];
                        
                        if(isset($_POST['save']))
                        {
                            $save = "UPDATE `$type_product` SET `name`='$update_name', `description`='$update_description' WHERE `model_id` = '$model_id'";
                            $result_update = mysqli_query($conection, $save);
                        }
                    }

                ?>
                <div class="right">
                    <button name="save" type="submit">Сохранить изменения</button>
                </div>
            </div>
            </form>
        </div>
</body>
</html>
