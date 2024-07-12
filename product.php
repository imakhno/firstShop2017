<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start();

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
/*==========================================================================*/    
    $product_type = $_GET['product_type'];
    $model_id = $_GET['model_id'];

    $product = "SELECT * FROM `$product_type` WHERE `model_id` = '$model_id'";

    $result_product = mysqli_query($conection, $product);

    if(!$result_product)
    {
      die("Database query failed.");
    }

    while($row = mysqli_fetch_assoc($result_product))
    {
      $name_product = $row['name'];
      $description = $row['description'];
      $price = $row['price'];
    }

   
/*==========================================================================*/
    $image_sql = "SELECT images.url 
    FROM product_type 
    JOIN product_images ON product_type.id = product_images.product_type_id 
    JOIN images ON images.id = product_images.images_id 
    WHERE product_type.name = '$product_type' 
    AND product_images.product_model_id = '$model_id'";

    $result_image = mysqli_query($conection, $image_sql);
  
    if(!$result_image)
    {
        die("Database query failed.");
    }

    $img = array();

    while($row = mysqli_fetch_assoc($result_image))
    { 
      $img[] = $row['url'];
    }
/*==========================================================================*/
$information = "SELECT * FROM `$product_type` WHERE `model_id` = '$model_id'";

$result_information = mysqli_query($conection, $information);

if(!$result_information)
{
    die("Database query failed.");
}

$color = array();

while($row = mysqli_fetch_assoc($result_information))
{ 

  $color[] = $row['color'];
}

/*==========================================================================*/
  $category = "SELECT * FROM `product_type` WHERE `name` = '$product_type'";

  $result_category = mysqli_query($conection, $category);

  if(!$result_category)
  {
    die("Database query failed.");
  }
  
  while($row = mysqli_fetch_assoc($result_category))
  { 

  $name_category = $row['name_category'];
  }

/*Корзина
==========================================================================*/
  
  if(isset($_POST['buy']))
  {
    $save_product_type = mysqli_real_escape_string($conection, trim($_GET['product_type']));
    $save_model_id = mysqli_real_escape_string($conection, trim($_GET['model_id']));
    $color_type = mysqli_real_escape_string($conection, trim($_POST['color']));
    $save_id = $id;
    $quantity = 1;

    $query = "SELECT `id`, `name`, `price`, `color`, `model_id`
              FROM `$save_product_type` 
              WHERE `model_id` = '$save_model_id' AND `color` = '$color_type'";

    $data = mysqli_query($conection, $query);

    while($row = mysqli_fetch_assoc($data))
    { 
      $product_id = $row['id'];
      $product_name = $row['name'];
      $product_price = $row['price'];
      $product_color = $row['color'];
      $product_model_id = $row['model_id'];
    }
    if(mysqli_num_rows($data) == 0)
    {
      $presence = "<script>alert('Данного товара нет в наличии');</script>";
    }else
    {
      $save_query = "INSERT INTO `shopping_cart` (email, product_type, order_id, product_name, product_price, product_color, product_model_id, quantity, subtotal) VALUES
      ('$session', '$save_product_type', '$product_id', '$product_name', '$product_price', '$product_color', '$product_model_id', '$quantity', '$product_price')";
      mysqli_query($conection, $save_query);
    }
  }

?>
                                 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Товар  | SUPER SHOP</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="css_style/Product.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">
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

            <section class="container-fluid">
                <div class="promo-text">
                    <h1 class="title">
                        <p><?echo $name_category;?></p>
                    </h1>
                    <a href="wakeboards.php">ВЕРНУТЬСЯ В КАТАЛОГ</a>
                </div>
            </section>
            <section class="flex">
            
              <div class="promo">
                <div class="content">
                  <div class="slider">
                    <?foreach ($img as $value){?>
                      <div><img src="<?echo $value;?>" alt=""></div>
                    <?}?>                   
                    </div>
                    <div class="slider-nav">
                    <?foreach ($img as $value){?>
                    <div class="nav_slide"><img src="<?echo $value;?>" alt=""></div>
                    <?}?>        
                  </div>
                  <div class="arrow"></div>                  
                </div>
              </div>
              <div class="name_product">
                <div class="title_1">
                    <p><?echo $name_product;?></p>
                </div>
                <div class="title_2">
                    <p><?echo $description;?></p>
                </div>
  
                <div class="title_3">
                    <p>Выберите вариант: </p>
                    <form class="form" action="" method="post">
                        <div class="select">
                            <select name="color">
                                <?
                                foreach ($color as $value)
                                {
                                  if($value == "")
                                  {
                                    echo "<option></option>";
                                  }
                                }                                
                                ?>
                                <?foreach ($color as $value){?>
                                    <option><?echo $value;?></option>
                                  <?}?> 
                            </select>
                        </div>
                    </div>
                  </div>
                      <div class="price"><?echo $presence;?>
                         <div class="block_price">
                            <div class="cost">0 руб.</div>
                            <div class="old-cost"><?echo $price;?>руб.</div>
                            <div class="img_ok"><img src="image/ok.png" alt="">есть в наличии</div>
                         </div>  
                         <div class="block_price_2">
                           <div class="buy">
                            <button type="submit" name="buy">
                                <img src="image/basket_2.png" alt="">
                                КУПИТЬ
                                </button>
                            </div>
                            </form>
                         </div> 
                         <div class="logo_logo">
                            <div class="logo_1">
                                <img src="image/1_1.png" alt="">
                                <p>БЕСПЛАТНАЯ ДОСТАВКА<br><span>по всей России</span></p>
                            </div>

                            <div class="logo_2">
                                <img src="image/2_2.png" alt="">
                                <p>ГОРЯЧАЯ ЛИНИЯ<br><span>8-800 000-00-00</span></p>
                            </div>

                            <div class="logo_3">
                                <img src="image/3_3.png" alt="">
                                <p>ПОДАРКИ<br><span>каждому покупателю</span></p>
                            </div>
                         </div>
                    </div>
            </section>
            <main class="fadeInUp">
              <section class="goods new">
                <header class="goods-header">
                  <h2 class="title">Новые товары</h2>
                  <div id="toggle-first" class="toggle-btns">
                  </div>
                </header>
                    <main id="catalog" class="catalog">
<?

                  $select_slider = "SELECT * FROM `$product_type`";
                  $result_slider = mysqli_query($conection, $select_slider);
                  if(!$result_slider)
                  {
                      die("Database query failed.");
                  }
                  $rows = mysqli_num_rows($result_slider);
                  for ($i = 0; $i < $rows; $i++)
                  {
                    $row = mysqli_fetch_row($result_slider);
                    for($j = 0; $j < 1; $j++)
                    $image_slider = "SELECT images.url 
                    FROM product_type 
                    JOIN product_images ON product_type.id = product_images.product_type_id 
                    JOIN images ON images.id = product_images.images_id 
                    WHERE product_type.name = '$product_type' 
                    AND product_images.product_model_id = '$row[2]'";

                    $result_images = mysqli_query($conection, $image_slider);
                    $imgs = array();

                    $row2 = mysqli_fetch_row($result_images);

                    echo "<a href='product.php?product_type=$product_type&model_id=$row[2]' target='blanck''>
                    <article >
                      <figure class='good-img'>
                        <img src='$row2[0]'>
                      </figure>
                      <div class='good-info'>
                        <h3 class='title'>$row[1] ($row[5])</h3>
                        <span class='cost'>$row[4]руб.</span>
                      </div>
                    </article>
                  </a>";
                  }
                    ?>  
                      
                        </section>
                    </main>
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
    <script src="slick/slick.js"></script>
    <script src="slick/slickk.js"></script>
    <script src="JS/index.js"></script>
    <script src="JS/ScriptJS.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
</body>
</html>