<?
    session_start();

    if(!$_SESSION['user_login'])
    {
        header("Location: login.php");
        exit;
    }

    
    include "conection.php";

    
    
    if(isset($_POST['del']))
    {
        $delete_query = "DELETE FROM `users` WHERE `id` = '$id'";
        $result_delete_query = mysqli_query($conection, $delete_query);
        header("Location: 05_items.php");
    }

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
    <title>Товары | Super shop</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css_style/Items.css">
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
                <div class="title">
                <span class="span_1">ТОВАРЫ</span>
            </div>
            <div class="content_1">
                <div class="strong_1">
                    <div class="block_1">
                        <p>НАЗВАНИЕ КАТЕГОРИИ</p>
                    </div>
                    <div class="block_2">
                        <p>КОЛИЧЕСТВО ТОВАРОВ</p>
                    </div>
                </div>

                <?

                $sql = "SELECT * FROM `product_type`";

                $result_sql = mysqli_query($conection, $sql);

                if(!$result_sql)
                {
                    die("Database query failed.");
                }
                
                $rows = mysqli_num_rows($result_sql);

                for ($i = 0; $i < $rows; $i++)
                {
                    $row = mysqli_fetch_row($result_sql);
                    $number_category = "SELECT COUNT(DISTINCT model_id) FROM `$row[1]`";
                    $result_number_category = mysqli_query($conection, $number_category);
                    if(!$result_number_category)
                    {
                        die("Database query failed.");
                    }
                    $number_row = mysqli_fetch_row($result_number_category);
                    $table = $row['1'];

                    
                    for($j = 0; $j < 1; $j++)
                    echo "<div class='strong_3'><div class='block_1'>
                    <div class='cat'>
                        <img src='image/ly.png'><span>$row[2]</span>
                    </div>
                </div>
                <div class='block_2'>
                
                    <p>$number_row[0]</p>
                </div>
                <div class='block_3'>
                <form method='POST'>
                <a style='text-decoration:none;color:#ad0000;border-bottom: 1px solid #f3d4d4;' class='delete' name='del' href='deleteFromCategory.php?id_category=$row[0]&name=$table'>удалить</a>
                </form>
                </div>
                <div class='block_4'>
                    <a  href='05_items_in_category.php?product_type=$table'><span>просмотр</span></a>
                </div></div>";
                }
                ?>
            </div> 
            <div class="cat_2">
            <?
            if(isset($_POST['update_category']))
            {
                $insert_name = $_POST['cat'];
                if(!empty($insert_name))
                {
                    $insert_name_cat = "SELECT * FROM `product_type` WHERE `name_category` = '$insert_name'";
                    $resilt_insert_name_cat = mysqli_query($conection, $insert_name_cat);

                    if(mysqli_num_rows($resilt_insert_name_cat) == 0)
                    {                        
                        $insert = "INSERT INTO `product_type` (`name`, `name_category`) VALUES ('$insert_name','$insert_name')";
                        $result_insert = mysqli_query($conection, $insert);
        
                        $create_table = "CREATE TABLE `$insert_name` 
                        (`id` INT(11) NOT NULL AUTO_INCREMENT,
                        `name` TEXT(100) NOT NULL,
                        `model_id` INT(11) NOT NULL,
                        `description` TEXT(250) NULL,
                        `price` INT(11) NOT NULL,
                        `color` TEXT(250) NULL,
                        PRIMARY KEY (id));";
                        $result_create_table = mysqli_query($conection, $create_table);
                        mysqli_select_db($conection, 'Shop');
                            if(!$result_create_table)
                            {
                                echo mysqli_error($conection);
                            }
                            $success = '<p style="font-size:30px; color:green;">Категория успешно добавлена!<br>Обновите страницу!</p>';
                    }else
                    {
                        $error = '<p style="font-size:30px; color:red;">Такая категория уже существует!</p>';
                    }

                }else
                {
                    echo '<p style="font-size:30px; color:red;">Введите название категории!</p>';
                }
            }
              echo $success;  
              echo $error;
            ?>
                <form action="" method="POST">
                    <span class="span_1">Добавить категорию: </span><input name='cat' type="text"><br>
                    <button type="submit" name='update_category' class="span_2">добавить категорию</button>
                </form>
            </div>
        </div>
</body>
</html>
