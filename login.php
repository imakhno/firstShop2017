<?php
    session_start();
    include "conection.php";
    
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $session = $_SESSION['user_login'];

    if(isset($_POST['submit'])) 
    { 
        $query = mysqli_query($conection, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = SHA('$password')"); 
        if(mysqli_num_rows($query) == 1) 
        { 
            $row = mysqli_fetch_assoc($query); 
            if($row['role'] == 'admin') 
            { 
                $_SESSION['user_login'] = $_POST['email']; 
                header("Location: 01_orders.php"); 
                exit(); 
            }else 
            { 
                $_SESSION['user_login'] = $_POST['email']; 
                header("Location: account.php"); 
                exit(); 
            } 
        } 
        else 
        { 
            $eror = '<br><span style="color:red;font-size:20px;">Неверный логин или пароль!</span>'; 
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация | SUPER SHOP</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="css_style/auth.css" rel="stylesheet" type="text/css">   
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
                            <li><a href="login.php"><img class="img-auth" src="image/auth.png" alt=""><span class="auth">Войти</span></a></li>
                            <li><a href="register.php"><span class="reg">Регистрация</span></a></li>
                        </ul>
                        <a href="shopping_cart.php">
                            <div class="basket">
                                <div class="info">
                                    <div class="text-basket">
                                        <span class="cost"><b>0</b> руб.<br></span>
                                        <span class="items">Нет предметов</span>
                                    </div>
                                </div>
                                <img class="img-basket"src="image/basket.png" alt="">
                            </div>
                        </a>
                    </div>
            </header>
            <div class="container-fluid">
                <p><i>АВТОРИЗАЦИЯ</i></p>
                <div class="form">
                    <form action="" method="POST">
                    <span class="text_p">Зарегестрированный пользователь</span>
                        <div class="one">
                            <span class="inp_text">E-mail адрес</span><br>
                            <input class="inp" type="email" name="email">
                        </div>
                         <div class="two">
                            <span class="i_1">Пароль</span><br>
                            <input class="inp2" type="password" name="password">
                        </div>
                        <div class="pass">
                            <button class="but" type="submit" name="submit">Войти</button>
                            <a class="a" href="#">Забыли пароль?</a>
                        </div>
                        <span class="text_2">Новый пользователь</span>
                        <button  class="but_2" type="submit" name="reg" value="register"><a href="register.php">Зарегестрироваться</a></button>
                        <?php                
                        echo $eror;
                        ?>
                    </form>     
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
</body>
</html>