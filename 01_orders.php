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
    <title>Заказы | Super shop</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css_style/Orders.css">
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
            <p>ЗАКАЗЫ</p>
            <div class="content">
                <div class="strong_1">
                    <div class="block_1" style="width:200px;">
                        <p>Имя</p>
                    </div>
                    <div class="block_2">
                        <p>СТАТУС</p>
                    </div>
                    <div class="block_3">
                        <p>СУММА</p>
                    </div>
                    <div class="block_4">
                        <p>ВРЕМЯ ЗАКАЗА</p>
                    </div>
                </div>
                <?
                $query_select = "SELECT * FROM `orders`";
                $result_query_select = mysqli_query($conection, $query_select);
                if(!$result_query_select)
                {
                    die("Database query failed.");
                }
                $rows = mysqli_num_rows($result_query_select);
                for ($i = 0; $i < $rows; $i++)
                {
                    $option_1 = "Принят";
                    $option_2 = "Отгружен";
                    $option_3 = "У курьера";
                    $option_4 = "Доставлен";
                    $option_5 = "Отмена";
                    $row = mysqli_fetch_row($result_query_select);
                    $email = $row['1'];
                    $row_order = $row['0'];
                        for($j = 1; $j < 2; $j++)
                        echo "<div class='strong_2'>
                        <div class='block_1' style='width:50px;'>
                            № $row[0]
                        </div>";
                        for($j = 2; $j < 3; $j++)
                        echo "<div class='block_3'>
                        от $email
                      </div>"; 
                        for($j = 3; $j < 4; $j++)
                        echo "<div class='block_4' id='block_4'>
                            <form action='' method='POST'>
                            <input type='hidden' name='id' value='".$row[0]."'>
                                <select  name='option' id='option' onchange='javascript:select(this);'>
                                    <option class='option_0' value='Принят'>$row[3]</option>
                                    <option class='option_2' value='$option_2'>$option_2</option>
                                    <option class='option_3' value='$option_3'>$option_3</option>
                                    <option class='option_4' value='$option_4'>$option_4</option>
                                    <option class='option_5' value='$option_5'>$option_5</option>
                                </select>
                            </form>    
                        </div>";
                        for($j = 4; $j < 5; $j++)
                        echo "<div class='block_5' style='margin-left:20px;'>
                                <span>$row[6] руб.</span>
                            </div>";
                        for($j = 5; $j < 6; $j++)
                        echo "<div class='block_6'>
                                $row[5] 
                            </div>
                            <div class='block_7'>
                                <span style='margin-left: 30px;'><a href='02_order_information.php?email=$row[1]&id=$row[0]'>просмотр</a></span>
                            </div>
                        </div>";

                    }
                
                ?>
                <script>
                function select(selectObject) 
                { 
                    var option = selectObject.value;
                    var id = selectObject.parentElement[0].value;
                    $.ajax(
                    {
                        type: 'POST',
                        url: 'order.php',
                        data: 
                        {
                            "option": option,
                            "id": id
                        },
                        success: function (data)
                        {
                            alert("Заказ №" +id+ " " +option);
                        }
                    });    


                }
                </script>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script src="http://yastatic.net/jquery/2.1.3/jquery.min.js"></script> 
</body>
</html>