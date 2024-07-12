<?php
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

    if(isset($_POST['save']))
    {
        $name = mysqli_real_escape_string($conection, trim($_POST['name']));
        $phone = mysqli_real_escape_string($conection, trim($_POST['phone']));
        $city = mysqli_real_escape_string($conection, trim($_POST['city']));
        $street = mysqli_real_escape_string($conection, trim($_POST['street']));
        $house = mysqli_real_escape_string($conection, trim($_POST['house']));
        $appartment = mysqli_real_escape_string($conection, trim($_POST['appartment']));

        
        if(isset($_POST['save']))
        {
            $sql = "UPDATE `users` SET `name`='$name', `phone`='$phone', `city`='$city', `street`='$street', `house`='$house', `appartment`='$appartment' WHERE `id`='$id'"; 
            $data = mysqli_query($conection, $sql);
        }
    }


    if(isset($_POST['pass']))
    {
        $password = mysqli_real_escape_string($conection, trim($_POST['password']));
        $password_2 = mysqli_real_escape_string($conection, trim($_POST['password_2']));      

        if(isset($_POST['pass']))
        {
            if(!empty($password) && !empty($password_2) && ($password == $password_2))
            {
                $password_change = "UPDATE `users` SET `password` = SHA('$password') WHERE `id`='$id'";
                $data = mysqli_query($conection, $password_change);
                $success = '<div style="color:green;font-size:20px;">Пароль изменён!</div>';
            }else
            {
                $error = '<div style="color:red;font-size:20px;">Ошибка при изменении пароля!</div>';
            }
        }   
    }





    if(!empty($session))
    {
        $account = "<li style='float:right;'><a href='account.php'><img class='img-auth' src='image/auth.png'><span class='auth'>Личный кабинет</span></a></li>";
    }else
    {
        $auth = "<li><a href='login.php'><img class='img-auth' src='image/auth.png'><span class='auth'>Войти</span></a></li>
                 <li><a href='register.php'><span class='reg'>Регистрация</span></a></li>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Личный кабинет | SUPER SHOP</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="css_style/account.css" rel="stylesheet" type="text/css">
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
                            echo $auth;
                            echo $account;
                           ?> 
                        </ul>
                        <a href="shopping_cart.php">
                            <div class="basket">
                                <div class="info">
                                    <div class="text-basket">
                                    <?
                                        $select_all = "SELECT `quantity`, `subtotal`  FROM `shopping_cart` WHERE `email` = '$session'";
                                        $result_select_all = mysqli_query($conection, $select_all);
                                        
                                        while($row = mysqli_fetch_assoc($result_select_all))
                                        {
                                    
                                            $number += $row['quantity'];
                                            $sum += $row['subtotal'];
                                        }
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
                <?
                echo $error;
                echo $success;
                ?>
                <p><i>ЛИЧНЫЙ КАБИНЕТ</i></p>
                <form action="" method="POST">
                <div class="form">
                        <div class="block_1">
                            <div class="data">

                                <p>Ваши данные</p>
                                <div class="one">

                                    <span class="i_1">Контактное лицо (ФИО):</span><br>
                                    <input class="inp" type="name" name="name" value="<?php echo $name_row;?>">

                                </div>
                                <div class="two">
                                    <span class="i_1">Контактный телефон:</span><br>
                                    <input class="inp" type="phone" name="phone" value="<?php echo $phone_row;?>">
                                </div>
                                <div class="three">
                                    <span class="i_1">Email адрес:</span><br>
                                    <input class="inp" type="email" name="email" value="<?php echo $email_row;?>" disabled>
                                </div>
                            </div>
                            <div class="address">
                                <p>Адрес доставки</p>
                                <div class="one_2">
                                    <span class="i_2">Город:</span><br>
                                    <input class="inp_2" type="city" name="city" value="<?php echo $city_row; ?>">
                                </div>
                                <div class="two_2">
                                    <span class="i_2">Улица:</span><br>
                                    <input class="inp_2" type="street" name="street" value="<?php echo $street_row; ?>">
                                </div>
                                <div class="three_2">
                                    <div class="blockk_1">
                                        <span class="i_2">Дом:</span><br>
                                        <input class="inp_2" type="house" name="house" value="<?php echo $house_row;?>">
                                    </div>
                                    <div class="blockk_2">
                                        <span class="i_2">Квартира:</span><br>
                                        <input class="inp_2" type="appartment" name="appartment" value="<?php echo $appartment_row;?>">
                                    </div>                                    
                                </div>                                
                            </div>
                            <div class="password">

                                <p>Изменение пароля</p>
                                <div class="one_3">
                                    <span class="i_3">Введите новый пароль:</span><br>
                                    <input class="inp_3" type="password" name="password">
                                </div>
                                <div class="two_3">
                                    <span class="i_3">Повторите новый пароль:</span><br>
                                    <input class="inp_3" type="password" name="password_2">
                                </div>
                                <button class="but" type="submit" name="save">Сохранить</button>
                                <button class="but" type="submit" name="pass">Изменить пароль</button><br>
                                <button class="but" type="submit" name="exit">Выход</button>
                            </div>
                        </div>
                        <div class="block_2">
                            <div class="orders">
                                <p>Ваши заказы</p>
                                <?
                                $select_orders = "SELECT * FROM `orders` WHERE `email` = '$session'";
                                $result_orders = mysqli_query($conection, $select_orders);
                                if(!$result_orders)
                                {
                                    die("Database query failed.");
                                }

                                $rows = mysqli_num_rows($result_orders);

                                for ($i = 0; $i < $rows; $i++)
                                {
                                    $row = mysqli_fetch_row($result_orders);
                                    for ($j = 1; $j < 2; $j++)
                                    echo "<div class='strong_1'>
                                    <div class='left_block'>
                                        <div class='p_1'>№$row[0]</div>
                                        <div class='p_2'>($row[6] руб.)</div>
                                        <div class='p_3'>$row[5]</div>
                                    </div>    
                                    <div class='block_5'>
                                        <span>$row[3]</span>    
                                    </div>
                                </div>";
                                }

                                ?>

                            </div>                            
                        </div>
                </div>
                </form> 
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
</body>
</html>