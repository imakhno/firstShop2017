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



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Пользователи | Super shop</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css_style/Users.css">
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
            <div class="nav">
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
            <p>ПОЛЬЗОВАТЕЛИ</p>
            <div class="content">
                <div class="strong_1">
                    <div class="block_1">
                        <p>ИМЯ</p>
                    </div>
                    <div class="block_2">
                        <p>E-MAIL</p>
                    </div>
                    <div class="block_3">
                        <p>ТЕЛЕФОН</p>
                    </div>
                </div>
               <?
                $users = "SELECT `id`, `name`, `email`, `phone` FROM `users`  WHERE id <> (SELECT MIN(id)FROM `users`)";

                $result_users = mysqli_query($conection, $users);

                if(!$result_users)
                {
                    die("Database query failed.");
                }
                
                $rows = mysqli_num_rows($result_users);

                for ($i = 0 ; $i < $rows ; $i++)
                {
                    $row = mysqli_fetch_row($result_users);
                        for ($j = 1 ; $j <2 ;$j++) 
                            echo "<div class='strong_2'><div class='block_4'><p>$row[1]</p></div>";
                        for ($j = 2 ; $j <3 ; $j++) 
                            echo "<div class='block_5'><p>$row[2]</p></div>";
                        for ($j = 3 ; $j <4 ; $j++) 
                            echo "<div class='block_6'><p>$row[3]</p></div><div class='block_7'>
                            <a href='04_user_information.php?id=$row[0]'><span>просмотр</span></a>
                        </div>
                    </div>";                           
                }
              ?>
            </div>
        </div>
    </div>
</body>
</html>