<?
    session_start();

    if(!$_SESSION['user_login'])
    {
        header("Location: login.php");
        exit;
    }


    include "conection.php";

    $id = $_GET['id'];
    
    if(isset($_POST['del']))
    {
        $delete_query = "DELETE FROM `users` WHERE `id` = '$id'";
        $result_delete_query = mysqli_query($conection, $delete_query);
        header("Location: 03_users.php");
    }

    if(isset($_POST['exit']))
    {
        unset($_SESSION['user_login']);
        header("Location: login.php");
    }

    $users = "SELECT * FROM `users` WHERE `id` = '$id'";

    $result_users = mysqli_query($conection, $users);
    if(!$result_users)
    {
        die("Database query failed.");
    }

    while($row = mysqli_fetch_assoc($result_users))
    {
        $name = $row['name'];
        $phone = $row['phone'];
        $email = $row['email'];
        $city = $row['city'];
        $street = $row['street'];
        $home = $row['house'];
        $apartment = $row['appartment'];
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
    <link rel="stylesheet" href="css_style/user_information.css">
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
                <div class="p_1"><p style="font-size: 48px;">ПРОСМОТР ПОЛЬЗОВАТЕЛЯ</p></div>
            <div class="content_1">
                <div class="strong_1">
                    <div class="block_1"><p>ИНФОРМАЦИЯ О ЗАКАЗЕ</p></div>
                </div>
                <div class="strong_2">    
                    <div class="block_2">
                        <form action="" metod="post">
                        <div class="block">
                            <span>Контактое лицо (ФИО):</span>
                            <input type="name" disabled value="<?echo $name;?>">
                        </div>   
                        <div class="block">
                            <span>Контактный телефон:</span>
                            <input type="phone" disabled value="<?echo $phone;?>"><br>
                        </div>
                        <div class="block">
                            <span>E-mail:</span><br>
                            <input type="_email" disabled value="<?echo $email;?>">
                        </div>
                        </form>
                    </div>
                    <div class="block_3">
                        <div class="block">
                            <span>Город:</span>
                            <input type="city" disabled value="<?echo $city;?>">
                        </div>
                        <div class="block">
                            <span>Улица:</span>
                            <input type="street" disabled value="<?echo $street;?>">
                        </div>    
                        <div class="home">
                            <span>Дом:</span><br>
                            <input type="home" style="width:49px;" disabled value="<?echo $home;?>"><br>
                        </div>
                        <div class="apartment">
                            <span>Квартира:</span><br>
                            <input type="apartment" style="width:49px;" disabled value="<?echo $apartment;?>">
                        </div>
                    </div>
                </div>
            </div>      
            <div class="content_2">
                <div class="strong_1">
                    <div class="block_1"><p>ИНФОРМАЦИЯ О ЗАКАЗЕ</p></div>
                </div>

                <?
                $select_price = "SELECT * FROM `orders` WHERE `email` = '$email'";
                $result_select_price = mysqli_query($conection, $select_price);
                while($row = mysqli_fetch_assoc($result_select_price))
                {
                    $sum += $row['subtotal'];
                    $number += $row['quantity'];
                }

                $query_select = "SELECT * FROM `orders` WHERE `email` = '$email'";
                $result_query_select = mysqli_query($conection, $query_select);
                if(!$result_query_select)
                {
                    die("Database query failed.");
                }

                $rows = mysqli_num_rows($result_query_select);

                for ($i = 0; $i < $rows; $i++)
                {

                    $row = mysqli_fetch_row($result_query_select);
                    $email = $row['1'];
                        for($j = 1; $j < 2; $j++)
                        echo "
                        <div class='strong_2'>
                            <div class='block_1'>
                                <p>№$row[0]</p>
                            </div>
                            <div class='block_2'>
                                <p>$row[6] руб.</p>
                            </div>
                            <div class='block_3'>
                                <p>$row[5]</p>
                            </div>
                        </div>
                        ";
                    }
                ?>
                        <div class='strong_3'>
                            <div class='block_1'>
                            <p>ИТОГОВАЯ<br>СУММА ЗАКАЗОВ</p>     
                            </div>
                            <div class='block_2'>
                                <p><?echo $sum;?> <span>руб.</span></p>
                            </div>
                        </div>

            <div class="delete">
                <form action="" method="POST">
                    <button type="submit" name="del" onclick="return confirm('Удалить пользователя <?echo $name;?>?')" style="border:none;background:transparent;cursor:pointer;">
                        <span>Удалить пользователя</span>
                    </button>
                </form>
            </div>  
            </div>    
        </div>
    </div>
</body>
</html>
