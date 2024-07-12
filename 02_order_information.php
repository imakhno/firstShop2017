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

    $email = $_GET['email'];
    $id_order = $_GET['id'];

    $query_select = "SELECT `id`, `condition`, `delivery`, `comment` FROM `orders` WHERE `email` = '$email'";
    $result_query_select = mysqli_query($conection, $query_select);
    if(!$result_query_select)
    {
        die("Database query failed.");
    }

    while($row = mysqli_fetch_assoc($result_query_select))
    {
        $id_orders = $row['id'];
        $condition = $row['condition'];
        $delivery = $row['delivery'];
        $comment = $row['comment'];
    }

    $select_user = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result_select_user = mysqli_query($conection, $select_user);
    if(!$result_select_user)
    {
        die("Database query failed.");
    }

    while($row = mysqli_fetch_assoc($result_select_user))
    {
        $id_users = $row['id'];      
        $name_users = $row['name'];
        $phone_users = $row['phone'];
        $email_users = $row['email'];
        $city_users = $row['city'];
        $street_users = $row['street'];
        $house_users = $row['house'];
        $appartment_users = $row['appartment'];
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Заказы | Super shop</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css_style/information_order.css">
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
                    <li><a href="#"><img class="img-auth" src="image/cat.png" alt=""><span class="auth">КАТЕГОРИИ</span></a></li>
                    <div class="bottom">
                        <div class="name"><?echo $_SESSION['user_login'];?></div>
                        <form action="" method="POST">
                            <button class="logout" type="submit" name="exit"><span class="text">Выход</span></button>
                        </form>
                    </div>            
            </div>
        </div>
        <div class="container">
            <div class="p">
                <div class="p_1">ЗАКАЗ</div>
                <div class="p_2">№<?echo $id_orders;?></div>
                <div class="p_3">(<?echo $condition;?>)</div> 
            </div>
            <div class="content">
                <div class="strong_1">
                    <div class="block_1"><p>СОДЕРЖИМОЕ ЗАКАЗА</p></div>
                </div>    

                <?
                $query_select_product = "SELECT * FROM `shopping_cart` WHERE `email` = '$email_users'";
                $result_query_select_product = mysqli_query($conection, $query_select_product);
                if(!$result_query_select_product)
                {
                    die("Database query failed.");
                }

                $rows = mysqli_num_rows($result_query_select_product);

                for ($i = 0; $i < $rows; $i++)
                {
                    $row = mysqli_fetch_row($result_query_select_product);
                    for($j = 1; $j < 2; $j++)
                    $id = $row['0'];
                    echo "
                    <div class='strong_2'>    
                        <div class='block_2'><p>$row[4]</p></div>
                        <div class='block_3'><p>$row[5] руб.</p></div>
                        <div class='block_4'><input type='text' disabled value='$row[8]' style='text-align:center;'></div>
                        <div class='block_5'><p>$row[9] руб.</p></div>
                        <div class='block_6'>
                            <a href='changeOrder.php?subtotal=$row[9]&id=$row[0]&email=$email_users'>Удалить из списка</a>
                        </div>
                    </div>";
                }
                ?>
            </div>
            <div class="content_2">
                <div class="strong_1">
                    <div class="block_1"><p>ИНФОРМАЦИЯ О ЗАКАЗЕ</p></div>
                </div>
                <div class="strong_2">    
                    <div class="block_2">
                        <form action="" metod="post">
                        <div class="block">
                            <span>Контактое лицо (ФИО):</span>
                            <input type="name" value='<?echo $name_users?>'>
                        </div>   
                        <div class="block">
                            <span>Контактный телефон:</span>
                            <input type="phone" value='<?echo $phone_users;?>'><br>
                        </div>
                        <div class="block">
                            <span>E-mail:</span><br>
                            <input type="email" value='<?echo $email_users;?>'>
                        </div>
                        </form>
                    </div>
                    <div class="block_3">
                        <div class="block">
                            <span>Город:</span>
                            <input type="city" value='<?echo $city_users;?>'>
                        </div>
                        <div class="block">
                            <span>Улица:</span>
                            <input type="street" value='<?echo $street_users;?>'>
                        </div>    
                        <div class="home">
                            <span>Дом:</span><br>
                            <input type="home" style="width:49px;" value='<?echo $house_users;?>'><br>
                        </div>
                        <div class="apartment">
                            <span>Квартира:</span><br>
                            <input type="apartment" style="width:49px;" value='<?echo $appartment_users;?>'>
                        </div>
                    </div>
                    <div class="block_4">
                        <div class="block">
                            <span>Способ доставки:</span><br>
                            <span class="delivery"><?echo $delivery;?></span>
                        </div>
                    </div>
                </div>    
                <div class="strong_3">
                    <div class="block">
                        <span>Комментарий к заказу:</span><br>
                        <textarea name="comm" id=""><?echo $comment;?></textarea>
                    </div>    
                </div>
                <div class="delete">
                    <a href="changeOrder.php?id_orders=<?echo $id_order;?>">Отменить заказ</a>
                </div>
            </div>            
        </div>
    </div>
</body>
</html>
