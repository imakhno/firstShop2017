<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Скейтборды  | SUPER SHOP</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="css_style/skateboards.css" rel="stylesheet" type="text/css">
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
                        <p>СКЕЙТЫ</p>
                    </h1>
                    <p class="description">Показано 1-15 товаров из 15</p>
                </div>
            </section>

    <main class="content container fadeInUp">
      <section class="goods new">
        <header class="goods-header">
          <h2 class="title">Страницы</h2>
          <div class="toggle-btns">
            
              <a href="skateboards.php">
                <button class="wrapper-left" type="button">1</button>
              </a>
            
          </div>
        </header>
 


    <div class="catalog">

        <section class='promo-goods'>

            <div class="a">
                <article class='promo-good'>
                    <h1 class='title'><b>СКЕЙТЫ</b></h1>
                    <span class="title_1">Скейтбординг — экстремальный вид спорта, заключающийся в катании,<br>
                      а также в исполнении различных трюков на скейтборде. <br>
                      Человека, занимающегося скейтбордингом,<br>
                      называют скейтбордистом, или скейтером..</span>
                </article>
            </div>

             <a href="product.php?product_type=skateboards&model_id=1" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/1_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Dragon Board Surf Junior</h3>
                    <span class="cost">2 390 руб.</span>
                  </div>
                </article>
              </a>

             <a href="product.php?product_type=skateboards&model_id=2" target="blanck" >
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/2_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Dragon Board Spiderman</h3>
                    <span class="cost">2 590 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=skateboards&model_id=3" target="blanck" style="border-right: 2px solid #F6F6F6; ">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/3_1.jpg" alt="">
                  </figure>
                  <div class="good-info" >
                    <h3 class="title">Dragon Board Deadhead C Bund</h3>
                    <span class="cost">2 590 руб.</span>
                  </div>
                </article>
              </a>


              <a href="product.php?product_type=skateboards&model_id=4" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/4_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Dragon Board Batman</h3>
                    <span class="cost">2 590 руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=skateboards&model_id=5" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/5_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Dragon Board Surf</h3>
                    <span class="cost">2 790 руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=skateboards&model_id=6" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/6_1.jpg" alt="" >
                  </figure>
                  <div class="good-info">
                    <h3 class="title">JDBug Powersurfer RT169</h3>
                    <span class="cost">1 490 руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=skateboards&model_id=7" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/7_1.jpg" alt=""  style="width: 100%;">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Rollersurfer Classic 08-09</h3>
                    <span class="cost">3 500 руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=skateboards&model_id=8" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/8_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">СИНИЙ ROLLERSURFER CLASSIC 2014</h3>
                    <span class="cost">3 500 руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=skateboards&model_id=9" target="blanck" id="item">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/9_1.jpg" alt="" >
                  </figure>
                  <div class="good-info">
                    <h3 class="title">ROLLERSURFER) ROCKET BOARD</h3>
                    <span class="cost">4 490 руб.</span>
                  </div>
                </article>
              </a>

             <div class="left_block" >
                <div class="row_1">
              <a href="product.php?product_type=skateboards&model_id=10" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/10_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Rollersurfer Switch Pro Mantaray</h3>
                    <span class="cost">5 300 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=skateboards&model_id=11" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/11_1.jpg" alt=""style="width: 100%; height: 50%; margin-top: 25%;">
                  </figure>
                  <div class="good-info" >
                    <h3 class="title">Вейвборд классик зеленый</h3>
                    <span class="cost">3 500 руб.</span>
                  </div>
                </article>
              </a>
              </div>
              <div class="row_2">
              <a href="product.php?product_type=skateboards&model_id=12" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/12_1.jpg" alt="" >
                  </figure>
                  <div class="good-info" >
                    <h3 class="title">Riрstik Air Рro, Razor</h3>
                    <span class="cost">5 300 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=skateboards&model_id=13" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/13_1.jpg" alt="" >
                  </figure>
                  <div class="good-info">
                    <h3 class="title">(Xlider, Эврика) Раздельный скейтборд</h3>
                    <span class="cost">3 990 руб.</span>
                  </div>
                </article>
              </a>
              </div>
                      
                <div class="b" >
              
                   <a class="butt" href="product.php?product_type=skateboards&model_id=3" target="blanck">
                      <span>Посмотреть +</span>
                      <div class="overlay"></div>
                    </a>
                <article class='promo-good'>
                    <h1 class='title'><b>DRAGON BOARD DRADHEAD C BUND</b></h1>
                    <span class="title_1">Двухколесный скейт Dragon Board Deadhead<br> 
                      C Bund -  модель
                      скейтборда, созданная с помощью <br>
                      современных технологий.</span><br>
                    <span class="cost" >2 590 руб.</span>
                </article>
            </div>
            </div>

                <a href="product.php?product_type=skateboards&model_id=14" target="blanck" style="width: 100%;">
                    <article class="good">
                    <figure class="good-img">
                        <img src="image/skateboards/14_1.jpg" alt="">
                    </figure>
                    <div class="good-info">
                        <h3 class="title">Razor RipStik G</h3>
                        <span class="cost">6 300 руб.</span>
                    </div>
                    </article>
                </a>
                <a href="product.php?product_type=skateboards&model_id=15" target="blanck"  style="width: 100%;">
                    <article class="good">
                    <figure class="good-img">
                        <img src="image/skateboards/15_1.jpg" alt="" >
                    </figure>
                    <div class="good-info">
                        <h3 class="title">СНЕЙКБОРД SKILL</h3>
                        <span class="cost">2 200 руб.</span>
                    </div>
                    </article>
                </a>


            </section>
                    </div> 
                   <div class="list">
            <section class="goods new">
          <header class="goods-header">
          <h2 class="title">Страницы</h2>
          <div class="toggle-btns">
            
              <a href="skateboards.php">
                <button class="wrapper-left" type="button">1</button>
              </a>
            
        </header>
            </section>
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
</body>
</html>