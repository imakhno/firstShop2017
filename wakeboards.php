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

    $select_all = "SELECT `quantity`, `subtotal`  FROM `shopping_cart` WHERE `email` = '$session'";
    $result_select_all = mysqli_query($conection, $select_all);
    
    while($row = mysqli_fetch_assoc($result_select_all))
    {

        $number += $row['quantity'];
        $sum += $row['subtotal'];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вейкборды  | SUPER SHOP</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="css_style/wakeboards.css" rel="stylesheet" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>  
    </script>
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
                        <p>ВЕЙКБОРДЫ</p>
                    </h1>
                    <p class="description">Показано 1-17 товаров из 20</p>
                </div>
            </section>

    <main class="content container fadeInUp">
      <section class="goods new">
        <header class="goods-header">
          <h2 class="title">Страницы</h2>
          <div class="toggle-btns">
            
              <a href="wakeboards.php">
                <button class="wrapper-left" type="button">1</button>
              </a>
            
            
              <a href="wakeboards_2.php">
                <button class="wrapper-right" type="button">2</button>
              </a>
            
          </div>
        </header>
 


    <div class="catalog">

        <section class='promo-goods'>

            <div class="a">
                <article class='promo-good'>
                    <h1 class='title'><b>ВЕЙКБОРДЫ</b></h1>
                    <span class="title_1">Вейкбординг или вейкборд — экстремальный вид спорта,<br>
                       сочетающий в себе элементы воднолыжного слалома,<br>
                        акробатику и прыжки. Вейкбординг имеет схожести
                        <br> со сноубордом,скейтбордом и сёрфингом.</span>
                </article>
            </div>


             <a href="product.php?product_type=wakeboards&model_id=1" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/1_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Wake Park PRO</h3>
                    <span class="cost">10 880руб.</span>
                  </div>
                </article>
              </a>

             <a href="product.php?product_type=wakeboards&model_id=14" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/14_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Harley LTD 2014</h3>
                    <span class="cost">16 730 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=wakeboards&model_id=15" target="blanck" style=" border-right: 2px solid #F6F6F6; ">
                <article class="good new">
                  <figure class="good-img">
                    <img src="image/wakeboards/15_1.jpg" alt="">
                  </figure>
                  <div class="good-info" >
                    <h3 class="title">B.O.B. 2013</h3>
                    <span class="cost">20 540 руб.</span>
                  </div>
                </article>
              </a>


              <a href="product.php?product_type=wakeboards&model_id=2" target="blanck">
                <article class="good hot">
                  <figure class="good-img">
                    <img src="image/wakeboards/2_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Dream Grind 2014</h3>
                    <span class="cost">11 120 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=wakeboards&model_id=3" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/3_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Liquid Force Jett Grind 2014</h3>
                    <span class="cost">15 840 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=wakeboards&model_id=4" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/4_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title"> Slingshot Shredtown 2013 (139 см)</h3>
                    <span class="cost">18 980 руб.</span>
                  </div>
                </article>
              </a>
              <a  href="product.php?product_type=wakeboards&model_id=5" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/5_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Кайт Серф борд Slingshot 2015 Tyrant</h3>
                    <span class="cost">56 900 руб.</span>
                  </div>
                </article>
              </a>

              <a  href="product.php?product_type=wakeboards&model_id=6" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/6_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Hyperlite Union ss14</h3>
                    <span class="cost">28 000 руб.</span>
                  </div>
                </article>
              </a>
              <a  href="product.php?product_type=wakeboards&model_id=7" target="blanck" id="item">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/7_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Liquid force Jett Grind 2014</h3>
                    <span class="cost">13 770 руб.</span>
                  </div>
                </article>
              </a>



             <div class="left_block" >
                <div class="row_1">
              <a  href="product.php?product_type=wakeboards&model_id=8" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/8_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">ATTITUDE 139 С КРЕПЛЕНИЯМИ</h3>
                    <span class="cost">9 795 руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=wakeboards&model_id=9" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/9_1.jpg" alt="">
                  </figure>
                  <div class="good-info" >
                    <h3 class="title">LIQUID FORCE DREAM GRIND</h3>
                    <span class="cost">12 780 руб.</span>
                  </div>
                </article>
              </a>
              </div>
              <div class="row_2">
              <a href="product.php?product_type=wakeboards&model_id=10" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/10_1.jpg" alt="">
                  </figure>
                  <div class="good-info" >
                    <h3 class="title">CWB JIVE 2013 (137 СМ)</h3>
                    <span class="cost">14 040 руб.</span>
                  </div>
                </article>
              </a>
              <a href="product.php?product_type=wakeboards&model_id=11" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/11_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">ВЕЙКБОРД SLINGSHOT OLI 2014</h3>
                    <span class="cost">22 940 руб.</span>
                  </div>
                </article>
              </a>
              </div>
                      
                <div class="b" >
              
                   <a class="butt" href="product.php?product_type=wakeboards&model_id=3" target="blanck">
                      <span>Посмотреть +</span>
                      <div class="overlay"></div>
                    </a>
                <article class='promo-good'>
                    <h1 class='title'><b>ВЕЙКБОРД B.O.B. 2013</b></h1>
                    <span class="title_1">Liquid Force B.O.B. - представляем вам следующее<br>
                     поколение модели PRO. Новая форма доски<br> собрала в себе массу новых технологий, эти<br>
                      инновационные особенности<br>
                        делают доску буквально живой!</span><br>
                    <span class="cost" >10 880 руб.</span>
                </article>
            </div>
            </div>

                <a href="product.php?product_type=wakeboards&model_id=12" target="_blanck">
                    <article class="good">
                    <figure class="good-img">
                        <img src="image/wakeboards/12_1.jpg" alt="">
                    </figure>
                    <div class="good-info">
                        <h3 class="title">SLINGSHOT RESPONSE 2014</h3>
                        <span class="cost">21 790 руб.</span>
                    </div>
                    </article>
                </a>
                <a href="product.php?product_type=wakeboards&model_id=13" target="blanck">
                    <article class="good">
                    <figure class="good-img">
                        <img src="image/wakeboards/13_1.jpg" alt="">
                    </figure>
                    <div class="good-info">
                        <h3 class="title">LIQUID FORCE SLAB 2013 (139)</h3>
                        <span class="cost">19 180 руб.</span>
                    </div>
                    </article>
                </a>
                    <a href="product.php?product_type=wakeboards&model_id=17" target="blanck">
                    <article class="good">
                    <figure class="good-img">
                        <img src="image/wakeboards/17_1.jpg" alt="">
                    </figure>
                    <div class="good-info">
                        <h3 class="title">SLINGSHOT HOOKE 2013</h3>
                        <span class="cost">19 800 руб.</span>
                    </div>
                    </article>
                </a>
                <a href="product.php?product_type=wakeboards&model_id=18" target="blanck" id="last_item">
                    <article class="good">
                    <figure class="good-img">
                        <img src="image/wakeboards/18_1.jpg" alt="">
                    </figure>
                    <div class="good-info">
                        <h3 class="title">SLINGSHOT WINDSOR 2015</h3>
                        <span class="cost">35 950 руб.</span>
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
            
              <a href="wakeboards.php">
                <button class="wrapper-left" type="button">1</button>
              </a>
            
            
              <a href="wakeboards_2.php">
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script src="http://yastatic.net/jquery/2.1.3/jquery.min.js"></script>        
    <script src="slick/slickk.js"></script>
    <script src="JS/index.js"></script>
    <script src="JS/script.js"></script>
</body>
</html>