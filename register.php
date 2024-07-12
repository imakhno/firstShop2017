<?php
    include "conection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация | SUPER SHOP</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="css_style/register.css" rel="stylesheet" type="text/css">
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
                <p><i>РЕГИСТРАЦИЯ</i></p>
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                        <div class="form">
                        <div class="block_1">
                            <div class="margin">
                                <span class="span">Контактное лицо (ФИО):</span><br>
                                <input type="name" name="name" required>
                            </div>
                            <div class="margin">
                                <span class="span">E-mail адрес:</span><br>
                                <input type="email" name="email" required>
                            </div>
                        </div>
                        <div class="block_2">
                            <div class="margin">
                                <span class="span">Пароль:</span><br>
                                <input class="pass" type="password" name="password" required>
                            </div>
                            <div class="margin">
                                <span class="span">Потвторите пароль:</span><br>
                                <input class="pass" type="password" name="password_2" required>
                            </div>
                        </div>
                        <div class="block_3">
                            <div class="margin">
                                <button class="but" type="submit" name="submit" >Зарегестрироваться</button>
                            </div>
                                <?php
                                if(isset($_POST['submit']))
                                {
                                    //Регистрируем
                                    $name = mysqli_real_escape_string($conection, trim($_POST['name']));
                                    $email = mysqli_real_escape_string($conection, trim($_POST['email']));
                                    $password = mysqli_real_escape_string($conection, trim($_POST['password']));
                                    $password_2 = mysqli_real_escape_string($conection, trim($_POST['password_2']));


                                    if(!empty($name) && !empty($email) && !empty($password) && !empty($password_2) && ($password == $password_2))
                                    {
                                    $query = "SELECT * FROM `users` WHERE email = '$email'";
                                    $data = mysqli_query($conection, $query);
                                    if(mysqli_num_rows($data) == 0)
                                    {
                                        $query = "INSERT INTO `users` (name, email, password) VALUES 
                                        ('$name', '$email', SHA('$password'))";
                                        mysqli_query($conection, $query);
                                        echo '<p style="margin-left: 30px; margin-top: -50px; font-size:30px; color:green; border-bottom: 2px solid green;">Вы успешно зарегестрированы!</p>';
                                    }
                                    else
                                    {
                                        echo '<p style="margin-left: 30px; margin-top: -50px; font-size:30px; color:red; border-bottom: 2px solid red;">Такой email уже существует!</p>';
                                    }
                                }else
                                {
                                    echo '<p style="margin-left: 30px; margin-top: -50px; font-size:30px; color:red; border-bottom: 2px solid red;">Повторный пароль введён неверно!</p>';
                                }
                            }
                            mysqli_close($conection);
                            ?>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script src="http://yastatic.net/jquery/2.1.3/jquery.min.js"></script>        
    <script src="JS/index.js"></script>
    <script src="JS/script.js"></script>    
</body>
</html>
