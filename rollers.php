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
    <title>Ролики | SUPER SHOP</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="css_style/rollers.css" rel="stylesheet" type="text/css">
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
                        <p>РОЛИКИ</p>
                    </h1>
                    <p class="description">Показано 1-17 товаров из 20</p>
                </div>
            </section>

    <main class="content container fadeInUp">
      <section class="goods new">
        <header class="goods-header">
          <h2 class="title">Страницы</h2>
          <div class="toggle-btns">
            
              <a href="rollers.php">
                <button class="wrapper-left" type="button">1</button>
              </a>
            
            
              <a href="rollers_2.php">
                <button class="wrapper-right" type="button">2</button>
              </a>
            
          </div>
        </header>
 


    <div class="catalog">

        <section class='promo-goods'>

            <div class="a">
                <article class='promo-good'>
                    <h1 class='title'><b>РОЛИКИ</b></h1>
                    <span class="title_1">Ботинки с прикреплёнными к ним рамами, в которых <br>
                      закреплено от двух до пяти (и даже шести) колёс, предназначенные<br>
                      для передвижения по твёрдой ровной поверхности, реже по<br>
                      бездорожью, аналогично передвижению по льду<br>
                      на традиционных коньках. Используются как<br>
                      спортивный инвентарь, для занятий<br>
                      фитнесом и активного отдыха.</span>
                </article>
            </div>


             <a href="product.php?product_type=rollers&model_id=1" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/1_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Fila Primo Alu Lady 2014</h3>
                    <span class="cost">5 300 руб.</span>
                  </div>
                </article>
              </a>

             <a href="product.php?product_type=rollers&model_id=2" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/2_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">SEBA FR1 80 Blue 2015</h3>
                    <span class="cost">17 300 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=rollers&model_id=3" target="blanck" style="border-right: 2px solid #F6F6F6; ">
                <article class="good new">
                  <figure class="good-img">
                    <img src="image/rollers/3_1.jpg" alt="">
                  </figure>
                  <div class="good-info" >
                    <h3 class="title">Bladerunner Formula 82 W 2015</h3>
                    <span class="cost">8 650 руб.</span>
                  </div>
                </article>
              </a>


              <a href="product.php?product_type=rollers&model_id=4" target="blanck">
                <article class="good hot">
                  <figure class="good-img">
                    <img src="image/rollers/4_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Bladerunner Formula 82 W 2015</h3>
                    <span class="cost">3 999 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=rollers&model_id=5" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/5_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">WAVE МУЖ. FILA</h3>
                    <span class="cost">7 499 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=rollers&model_id=6" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/6_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">FILA PLUME ЖЕН. FILA</h3>
                    <span class="cost">9 999 руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=rollers&model_id=7" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/7_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">СК Omega, лайм (2012)</h3>
                    <span class="cost">3 668 руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=rollers&model_id=8" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/8_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Expert Male (2014)</h3>
                    <span class="cost">3 363 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=rollers&model_id=9" target="blanck" id="item">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/9_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Fila Nrk Sd Black/Green</h3>
                    <span class="cost">21 000 руб.</span>
                  </div>
                </article>
              </a>

             <div class="left_block" >
                <div class="row_1">
              <a href="product.php?product_type=rollers&model_id=10" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/10_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Maxcity Spliter , фиолетовый (2012)</h3>
                    <span class="cost">3 840 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=rollers&model_id=11" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/11_1.jpg" alt="">
                  </figure>
                  <div class="good-info" >
                    <h3 class="title">Bladerunner Pro 80 W (2013)</h3>
                    <span class="cost">3 300 руб.</span>
                  </div>
                </article>
              </a>
              </div>
              <div class="row_2">
              <a href="product.php?product_type=rollers&model_id=12" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/12_1.jpg" alt="" >
                  </figure>
                  <div class="good-info" >
                    <h3 class="title">СК Rental RS-2 2013</h3>
                    <span class="cost">4 493 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=rollers&model_id=13" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/13_1.jpg" alt="" >
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Explore Cougar Aggressive 2011</h3>
                    <span class="cost">5 500 руб.</span>
                  </div>
                </article>
              </a>
              </div>
                      
                <div class="b" >
              
                   <a class="butt" href="product.php?product_type=rollers&model_id=4" target="blanck">
                      <span>Посмотреть +</span>
                      <div class="overlay"></div>
                    </a>
                <article class='promo-good'>
                    <h1 class='title'><b>Bladerunner Formula</b></h1>
                    <span class="title_1">Для опытных пользователей и простого передвижения по городу.<br> За секунды превращает обувь в ролики.</span><br>
                    <span class="cost">3 999 руб.</span>
                </article>
            </div>
            </div>

                <a href="product.php?product_type=rollers&model_id=14" target="blanck">
                    <article class="good">
                    <figure class="good-img">
                        <img src="image/rollers/14_1.jpg" alt="">
                    </figure>
                    <div class="good-info">
                        <h3 class="title">Larsen Flower</h3>
                        <span class="cost">2 107 руб.</span>
                    </div>
                    </article>
                </a>
                <a href="product.php?product_type=rollers&model_id=15" target="blanck">
                    <article class="good">
                    <figure class="good-img">
                        <img src="image/rollers/15_1.jpg" alt="" >
                    </figure>
                    <div class="good-info">
                        <h3 class="title">ATEMI X7 lady</h3>
                        <span class="cost">2 429 руб.</span>
                    </div>
                    </article>
                </a>
                <a href="product.php?product_type=rollers&model_id=16" target="blanck">
                    <article class="good">
                    <figure class="good-img">
                        <img src="image/rollers/16_1.jpg" alt="" >
                    </figure>
                    <div class="good-info">
                        <h3 class="title">Larsen Energy G</h3>
                        <span class="cost">2 490 руб.</span>
                    </div>
                    </article>
                </a>
                <a href="product.php?product_type=rollers&model_id=17" target="blanck" id="last_item">
                    <article class="good">
                    <figure class="good-img">
                        <img src="image/rollers/17_1.jpg" alt="" >
                    </figure>
                    <div class="good-info">
                        <h3 class="title">Larsen Flash V</h3>
                        <span class="cost">2 216 руб.</span>
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
            
              <a href="rollers.php">
                <button class="wrapper-left" type="button">1</button>
              </a>
            
            
              <a href="rollers_2.php">
                <button class="wrapper-right" type="button">2</button>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script src="http://yastatic.net/jquery/2.1.3/jquery.min.js"></script>        
    <script src="slick/slickk.js"></script>
    <script src="JS/index.js"></script>
    <script src="JS/script.js"></script>
</body>
</html>