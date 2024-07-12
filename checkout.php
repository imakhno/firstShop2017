<?php
    session_start();

    include "conection.php";


    $session = $_SESSION['user_login'];
    
    $query = "SELECT * FROM `users` WHERE `email` = '$session'";
    $result = mysqli_query($conection, $query);
    
    if(!$result)
    {
        die("Database query failed.");
    }

    while($row = mysqli_fetch_assoc($result))
    { 
        $id = $row['id'];      
        $name_row = $row['name'];
        $phone_row = $row['phone'];
        $email_row = $row['email'];
        $city_row = $row['city'];
        $street_row = $row['street'];
        $house_row = $row['house'];
        $appartment_row = $row['appartment'];
        $password_row = $row['password'];
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

    $select_all = "SELECT `quantity`, `subtotal`  FROM `shopping_cart` WHERE `email` = '$session'";
    $result_select_all = mysqli_query($conection, $select_all);
    
    while($row = mysqli_fetch_assoc($result_select_all))
    {

        $number += $row['quantity'];
        $sum += $row['subtotal'];
    }

    $dates = date('Y-m-d H:i:s');
    $condition = 'принят';
    $comment = $_POST['comment'];
    $delivery = $_POST['shipping'];



    if(isset($_POST['save']))
    {
        $phone_update = mysqli_real_escape_string($conection, trim($_POST['phone']));
        $city_update = mysqli_real_escape_string($conection, trim($_POST['city']));
        $street_update = mysqli_real_escape_string($conection, trim($_POST['street']));
        $house_update = mysqli_real_escape_string($conection, trim($_POST['house']));
        $appartment_update = mysqli_real_escape_string($conection, trim($_POST['appartment']));


        if(!empty($city_update) && !empty($street_update) && !empty($house_update) && !empty($phone_update) && !empty($delivery))
        {
            $sql = "UPDATE `users` SET `phone`='$phone_update', `city`='$city_update', `street`='$street_update', `house`='$house_update', `appartment`='$appartment_update' WHERE `email`='$session'"; 
            $data = mysqli_query($conection, $sql);
            if(!$data)
            {
                die("Database query failed.");
            }
        }else
        {
            $error_delivery = "<div style='color:red;font-size:29px;'>Вы не указали информацию доставке или контактную информацию!</div>";
        }
        if(!empty($city_update) && !empty($street_update) && !empty($house_update) && !empty($phone_update) && !empty($delivery))
        {
            $save_query = "INSERT INTO `orders`(`email`, `comment`, `condition`, `delivery`, `dataTime`, `subtotal`) 
            VALUES ('$session','$comment','$condition','$delivery','$dates', '$sum')";
            mysqli_query($conection, $save_query);
            $success = print("<script language=javascript>
            window.alert('Ваш заказ успешно оформлен.');
            window.location.href = 'account.php';
            </script>");
        }else
        {
            $error = "<div style='color:red;font-size:29px;'>Возникли проблемы с оформлением заказа!</div>";
        }

    }
    echo $success;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Оформление заказа | SUPER SHOP</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="css_style/Check.css" rel="stylesheet" type="text/css">

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
                                    <?

                                    ?>
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
                <p><i>ОФОРМЛЕНИЕ ЗАКАЗА</i></p>
                <?
                echo $error;
                echo $error_phone;
                echo $error_delivery;
                ?>
                <div class="form">
                        <div class="checkout_1" id="contact">
                            <p id="span"><span>1.</span> Контактная информация</p>
                        </div>
                            <div class="contact" id="box">
                                <div class="new">
                                    <div class="item_1">
                                        <form action="" method='POST'>

                                        <p>Для новых покупателей</p>
                                        <div class="one">
                                            <span class="i_1">Контактное лицо (ФИО):</span><br>
                                            <input class="inp" type="name" name='name' value='<?echo $name_row;?>'>
                                        </div>
                                        <div class="two">
                                            <span class="i_1">Контактный телефон:</span><br>
                                            <input class="inp" type="phone" name='phone' value='<?echo $phone_row; echo $_POST['phone'];?>'>
                                        </div>
                                        <div class="three">
                                            <span class="i_1">E-mail:</span><br>
                                            <input class="inp" type="email" name='email' value='<?echo $email_row;?>'>
                                        </div>
                                        <input type='button' class="but" id='button' value='Продолжить'>
                                       
                                    </div>
                                </div>
                                <div class="login">
                                    <div class="item_2">
                                        <p>Быстрый вход</p>
                                        <div class="one">
                                            <span class="i_1">Ваш E-mail:</span><br>
                                            <input class="inp" type="email">
                                        </div>
                                        <div class="two">
                                            <span class="i_1">Пароль:</span><br>
                                            <input class="inp2" type="password">
                                        </div>
                                        <button class="but" type="submit">Войти</button>
                                    </div>
                                    </div>
                                </div>
                            </div>

                        <div class="checkout_2"  id="contact_2">
                            <p id="span_2"><span>2.</span> Информация о доставке</p>
                        </div>
                          <div class="contact_2" id="box_2" style='display:none;'>
                                <div class="new_2">
                                    <div class="item_3">
                                        <p>Адрес доставки</p>

                                        <div class="one">
                                            <span class="i_2">Город:</span><br>
                                            <input class="inp" name="city" value="<?php echo $city_row; echo $_POST['city'] ?>">
                                        </div>
                                        <div class="two">
                                            <span class="i_2">Улица:</span><br>
                                            <input class="inp" name="street" value="<?php echo $street_row; echo $_POST['street'] ?>">
                                        </div>
                                        <div class="three">
                                            <span class="i_2">Дом:</span><br>
                                            <input class="inp_2" name="house" value="<?php echo $house_row; echo $_POST['house']?>">
                                        </div>
                                        <div class="four">
                                            <span class="i_2">Квартира:</span><br>
                                            <input class="inp_2" name="appartment" value="<?php echo $appartment_row; echo $_POST['appartment']?>">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="shipping">
                                    <div class="new_3">
                                        <div class="item_4">
                                            
                                                <p>Способ доставки</p>
                                                    <input type="radio" name="shipping" value="Курьерская доставка">
                                                    <span class="p_2" style="margin-left: 12px;">Курьерская доставка<br>
                                                    <span style="margin-left: 30px;">С оплатой при получении</span><span><br><br>  
                                                    <input type="radio" name="shipping" value="с оплатой при получении">
                                                    <span class="p_2" style="margin-left: 12px;">Почта России<br>
                                                    <span style="margin-left: 30px;">с наложенным платежом</span></span><br><br>                                             
                                                    <input type="radio" name="shipping" value="Почта России с наложенным платежом">
                                                    <span class="p_2" style="margin-left: 12px;">Доставка через терминалы<br>
                                                    <span style="margin-left: 30px;">QIWI Post</span></span><br><br> 

                                        </div>
                                    </div>
                                </div>
                                <div class="comment">
                                    <div class="item_5">
                                        <p>Комментарий к заказу</p>
                                        <sapn></sapn>
                                        <textarea name="comment" id="" cols="30" rows="10" placeholder="Текст комментария"></textarea>
                                    </div>
                                    <script>
                                        function hideme(obj){
                                            obj.parentNode.style.display = "none";
                                        }
                                    </script>
                                    
                                </div>
                                <input id='butt' type="button" onclick="hideme(this)" class="but" id="b2" style='margin-left:35px;margin-top:-80px;' value="Продолжить">

                            </div>

                        <div class="checkout_3" id="contact_3">
                            <p id="span_3"><span>3.</span> Подтверждение заказа</p>
                        </div>                     
                        <div class="shipping_comment" id="box_3" style='display:none;'> 
                            <div class="new_4">
                                <div class="item_6">
                                    <p>Состав заказа:</p>    
                                        <div class="strong_1">
                                            <div class="name">
                                                <p>Товар</p>
                                            </div>
                                            <div style="text-align: center; margin-left: 30px;">
                                                <p>Стоимость</p>
                                            </div>
                                            <div style="text-align: center;">
                                                <p>Количество</p>
                                            </div>
                                            <div style="text-align: center;">
                                                <p>Итого</p>
                                            </div>
                                        </div>

                                        <?
                                            $select_product = "SELECT `product_name`, `product_price`, `quantity`, `subtotal`  FROM `shopping_cart` WHERE `email` = '$session'";
                                            $result_select_product = mysqli_query($conection, $select_product);
                                            
                                            $rows = mysqli_num_rows($result_select_product);

                                            for($i = 0; $i < $rows; $i++)
                                            {
                                                $row = mysqli_fetch_row($result_select_product);
                                                    for($j = 1; $j < 2; $j++)
                                                    echo "<div class='strong_2'><div class='name_1'><p>$row[0]</p></div>";
                                                    for($j = 2; $j < 3; $j++)
                                                    echo "<div style='text-align: center;'><p>$row[1] руб.</p></div>";
                                                    for($j = 3; $j < 4; $j++)
                                                    echo "<div style='text-align: center;'><p>$row[2]</p></div>";
                                                    for($j = 4; $j < 5; $j++)
                                                    echo "<div style='text-align: center;'><p>$row[3]</p></div></div>";
                                            }
                                        ?>


                                        <div class="strong_3">
                                            <div class="s_1"></div>
                                            <div class="s_2">
                                                <p>Итого:</p>
                                            </div>
                                            <div class="s_3">
                                                <p><?echo $sum;?>руб.</p>
                                            </div>      
                                        </div>
                                        <div class="strong_4">
                                            <div class="block_1">
                                                <p>Доставка:</p>
                                                <span>Контактное лицо (ФИО):</span>
                                                <p class="p"><?php echo $name_row;?></p>

                                                <span>Контактный телефон:</span>
                                                <p class="p"><?php echo $phone_row;?></p>

                                                <span>E-mail</span>
                                                <p class="p"><?php echo $email_row;?></p>
                                                
                                            </div>
                                            <div class="block_2">
                                                <span>Город:</span>
                                                <p class="p"><?php echo $city_row; ?></p>

                                                <span>Улица:</span>
                                                <p class="p"><?php echo $street_row; ?></p>

                                                    <span>Дом:</span>
                                                    <p class="p"><?php echo $house_row;?></p>
                                                    <div style="margin-left: 50px; margin-top: -45px;">
                                                    <span>Квартира:</span>
                                                    <p class="p"><?php echo $appartment_row;?></p>
                                                    </div>                                                                                           
                                            </div>
                                            <div class="block_3">
                                                <span>Контактное лицо (ФИО):</span>
                                                <p class="p"><?php echo $name_row;?></p>

                                                <span>Контактный телефон:</span>
                                                <p class="p"><?php echo $phone_row;?></p>      
                                            </div>
                                        </div>
                                            <button type="submit" name="save" class="but" id="b3" style="margin-left: 30px;">Продолжить</button></a>
                                        </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </div>
            <footer class="pfooter container">
                <p class="description">
                    Шаблон для экзаменационного задания.<br>
                    Разработан специально для «Всероссийской Школы Программирования»<br>
                    <a href="http://bedev.ru/" target="_blank">http://bedev.ru/</a>
                </p>
                <button class="scroll-top " type="button">Наверх</button>
            </footer>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script src="http://yastatic.net/jquery/2.1.3/jquery.min.js"></script>        
    <script src="JS/index.js"></script>
    <script src="JS/checkout.js"></script>
</body>
</html>