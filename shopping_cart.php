<?php
    session_start();

    if(!$_SESSION['user_login'])
    {
        header("Location: http://supersss.ru/login.php");
        exit;
    }
    
    include "conection.php";


    $session = $_SESSION['user_login'];

    
    $sql = "SELECT * FROM `users` WHERE `email` = '$session'";
    $result = mysqli_query($conection, $sql);
    if(!$result)
    {
        die("Database query failed.");
    }
    while($row = mysqli_fetch_assoc($result))
    { 
      $id = $row['id'];
      $role_row = $row['role'];
    }
    
    if(!empty($session))
    {
      if($role_row == 'admin')
      {
        $admin = "<li style='float:right;'><a href='01_orders.php'><img class='img-auth' src='image/auth.png'><span class='auth'>Администратор</span></a></li>";
      }else
      {
        $account = "<li style='float:right;'><a href='account.php'><img class='img-auth' src='image/auth.png'><span class='auth'>Личный кабинет</span></a></li>";
      }
    }else
    {
      $auth = "<li><a href='login.php'><img class='img-auth' src='image/auth.png'><span class='auth'>Войти</span></a></li>
                 <li><a href='register.php'><span class='reg'>Регистрация</span></a></li>";
    }


    $select_price = "SELECT * FROM `shopping_cart` WHERE `email` = '$session'";
    $result_select_price = mysqli_query($conection, $select_price);
    while($row = mysqli_fetch_assoc($result_select_price))
    {
        $sum += $row['subtotal'];
        $number += $row['quantity'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Корзина | SUPER SHOP</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="css_style/shopp__cart.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <header>
                <a href="index.php">
                    <div class="logo">
                        <div class="text">
                            <span class="text-up">super</span>
                            <span class="text-down">shop</span>
                        </div>
                    </div>
                </a>
                    <ul class="icon">
                        <li class="hamburger"></li>
                    </ul>
                    <div class="block">
                    <ul class="topnav">
                        <li><a href="wakeboards.php">ВЕЙКБОРДЫ</a></li>
                        <li><a href="skateboards.php">СКЕЙТЫ</a></li>
                        <li><a href="rollers.php">РОЛИКИ</a></li>
                        <li><a href="scooters.php">САМОКАТЫ</a></li>
                        <li><a href="snowboards.php">СНОУБОРДЫ</a></li>
                        <li><a href="rockets.php">РАКЕТКИ</a></li>
                    </ul>
                    </div>
                    <div id="auth" class="block">
                        <ul class="auth-block">
                        <?
                          echo $admin;
                          echo $account;
                          echo $auth;
                        ?>
                        </ul>
                        <a href="shopping_cart.php">
                            <div class="basket">
                                <div class="info">
                                    <div class="text-basket">
                                        <span class="cost"><b><?echo $sum;?></b> руб.<br></span>
                                        <span class="items">Предметы: <?echo $number;?></span>
                                    </div>
                                </div>
                                <img class="img-basket"src="image/basket.png" alt="">
                            </div>
                        </a>
                    </div>
            </header>
            <div class="container-fluid">
                <p class='as'><i>КОРЗИНА</i></p>
                <div class="form">
                    <form action="" method="POST">

                        <div class="strong_1">
                            <div class="block_1">
                                <p>Товар</p>
                            </div>
                            <div class="block_2">
                                <p>Доступность</p>
                            </div>
                            <div class="block_3">
                                <p>Стоимость</p>
                            </div>
                            <div class="block_4">
                                <p>Количество</p>
                            </div>
                            <div class="block_5">
                                <p>Итого</p>
                            </div>
                        </div>
                        <?

                        $select_query = "SELECT * FROM `shopping_cart` WHERE `email` = '$session'";
                        $result_select_query = mysqli_query($conection, $select_query);
                        $rows = mysqli_num_rows($result_select_query);
        
                        
                        for($i = 0; $i < $rows; $i++)
                        {
                            $row = mysqli_fetch_row($result_select_query);
                            for($j = 0; $j < 1; $j++)
                                $image_sql = "SELECT images.url 
                                FROM product_type 
                                JOIN product_images ON product_type.id = product_images.product_type_id 
                                JOIN images ON images.id = product_images.images_id 
                                WHERE product_type.name = '$row[2]' 
                                AND product_images.product_model_id = '$row[7]'";

                                $result_image = mysqli_query($conection, $image_sql);
                                $img = array();

                                $row2 = mysqli_fetch_row($result_image);
                                $number_strong = $row['0'];
                                $quantity_product = $row['8'];
                                $price = $row['5'];
                                $subtotal = $row['9']; 
                                
                                echo  "
                                <form action='' method='POST'>
                                <div class='strong_2'>
                                    <div class='block_1' style=' text-align: center;'>
                                    <a href='product.php?product_type=$row[2]&model_id=$row[7]' target='blanck'''><img src='$row2[0]' style='width: auto;'></a>
                                    </div>
                                    <div class='block_2' >
                                        <P>$row[4] <br/><hr/>(цвет: $row[6])</P>
                                    </div>
                                    <div class='block_3'>
                                        <p>Есть в наличии</p>
                                    </div>
                                    <div class='block_4'>
                                        <p>$price руб.</p>
                                    </div>
                                    <div class='block_5'>
                                        <div class='number' style='display: flex;'>
                                            <button id='minus' onclick='javascript:summa2($number_strong, $quantity_product, $subtotal, $price)' class='minus'>-</button>
                                            <input  class='number' name='number' id='$number_strong' type='text' value='$quantity_product' size='10' disabled/>
                                            <input type='hidden' name='number'  value='$number_strong' class='id'/>
                                            <button id='plus' class='plus' onclick='javascript:summa($number_strong, $quantity_product, $subtotal, $price)'>+</button>
                                        </div>
                                    </div>
                                    <div class='block_6'>
                                        <p><span class='subtotal'>$subtotal</span> руб.</p>
                                    </div>
                                    <div class='block_7'>
                                        <a class='delete' name='del' href='deleteFromcart.php?id=$number_strong&product_model_id=$row[3]'>X</a>
                                    </div>
                                </div></form>";
                        }                            

                        ?>
                        <script>
                            
                                function summa(number_strong, quantity_product, subtotal, price)
                                {
                                    $.ajax(
                                    {
                                        type: 'POST',
                                        url: 'updateCart.php',
                                        data: 
                                        {
                                            "price": price,
                                            "subtotal": subtotal,
                                            "number_strong": number_strong,
                                            "quantity_product": quantity_product,
                                        },

                                    });    
                                }

                                function summa2(number_strong, quantity_product, subtotal, price)
                                {
                                    $.ajax(
                                    {
                                        type: 'POST',
                                        url: 'updateCart2.php',
                                        data: 
                                        {
                                            "price": price,
                                            "subtotal": subtotal,
                                            "number_strong": number_strong,
                                            "quantityt_product": quantity_product,
                                        },

                                    });    
                                }

                                
                        </script>   


                        <div class="strong_3">
                            <div class="back">
                                <button class="but"><a href="index.php">Вернуться к покупкам</a></button>
                            </div>
                            <div class="buy">

                                <p>Итого: <span> <?echo $sum;?> руб.</span></p>
                                <a class="but_2" href="checkout.php">Оформить заказ</a>
                            </div>
                        </div>
                    </form>     
                </div>
            </div>
            <footer class="pfooter container">
                <p class="description">
                    Шаблон для экзаменационного задания.<br>
                    Разработан специально для «Всероссийской Школы Программирования»<br>
                    <a href="http://bedev.ru/" target="_blank">http://bedev.ru/</a>
                </p>
                <button class="scroll-top">Наверх</button>
            </footer>
        </div>
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script src="http://yastatic.net/jquery/2.1.3/jquery.min.js"></script>        
    <script src="slick/slickk.js"></script>
    <script src="JS/index.js"></script>
    <script src="JS/quantity.js"></script>
</body>
</html>