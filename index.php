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
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <title>Главная | SUPER SHOP</title>
    <link rel="shortcut icon" href="image/shop1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css_style/index.css">
    <link rel="stylesheet" href="slick/slick.css">
</head>
<body>
<div class="pl">
  <div class="cat">
    <div class="cat__body"></div>
    <div class="cat__body"></div>
    <div class="cat__tail"></div>
    <div class="cat__head"></div>
  </div>
</div>
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
                    <h1 class='title'>
                        <b>MF DIRT</b>
                        <br>OXELO</p>
                    </h1>
                    <p class='description'>Для катания в стиле дёрт. Катайтесь по любому<br>покрытию с дертовым самокатом от Oxelo!</p>
                </div>

                <a class="butt" href="product.php?product_type=scooters&model_id=6" target="blanck">
                    <span>Посмотреть +</span>
                    <div class="overlay"></div>
                </a>
            </section>
    <main class="content container fadeInUp">
      <section class="goods new">
        <header class="goods-header">
          <h2 class="title">Новые товары</h2>
          <div id="toggle-first" class="toggle-btns">
          </div>
        </header>

        <div class="catalog">
          <div class="jcarousel-row jcarousel">
            <div id="first" class="jcarousel-list">

              <a href="product.php?product_type=wakeboards&model_id=1" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/wakeboards/1_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Wake Park PRO</h3>
                    <span class="cost">10 880 руб.</span>
                  </div>
                </article>
              </a>

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

              <a href="product.php?product_type=rollers&model_id=1" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/1_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Fila Primo Alu Lady</h3>
                    <span class="cost">5 300руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=scooters&model_id=1" target="blanck">
                <article class="good sale">
                  <figure class="good-img">
                    <img src="image/scooters/1_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Explore DECKLINE</h3>
                    <span class="cost">2500руб.</span>
                    <span class="old-cost">5500руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=rockets&model_id=1" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rockets/1_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Wilson BLADE 98</h3>
                    <span class="cost">8800руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=snowboards&model_id=1" target="blanck">
                <article class="good new">
                  <figure class="good-img">
                    <img src="image/snowboards/1_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">BURTON GENIE</h3>
                    <span class="cost">12456руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=wakeboards&model_id=2" target="blanck">
                <article class="good hot">
                  <figure class="good-img">
                    <img src="image/wakeboards/2_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Harley LTD</h3>
                    <span class="cost">16730руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=scooters&model_id=2" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/scooters/2_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">TOWN 7 XPOM OXELO</h3>
                    <span class="cost">8999руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=scooters&model_id=3" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/scooters/3_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">FREESTYLE MF ONE OXELO</h3>
                    <span class="cost">4299руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=rockets&model_id=2" target="blanck">
                <article class="good new">
                  <figure class="good-img">
                    <img src="image/rockets/2_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Wilson Pro Staff 97</h3>
                    <span class="cost">13500руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=snowboards&model_id=2" target="blanck">
                <article class="good hot">
                  <figure class="good-img">
                    <img src="image/snowboards/2_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">BURTON BARRACUDA FW15</h3>
                    <span class="cost">29740руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=skateboards&model_id=2" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/skateboards/2_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Dragon Board Spiderman</h3>
                    <span class="cost">2590руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=rollers&model_id=2" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rollers/2_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">SEBA FRI 80 Blue</h3>
                    <span class="cost">17300руб.</span>
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
                    <span class="cost">2790руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=rockets&model_id=3" target="blanck">
                <article class="good">
                  <figure class="good-img">
                    <img src="image/rockets/3_1.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">Wilson Cierzo Two BLX</h3>
                    <span class="cost">5900руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=snowboards&model_id=3" target="blanck">
                <article class="good hot">
                  <figure class="good-img">
                    <img src="image/snowboards/3.jpg" alt="">
                  </figure>
                  <div class="good-info">
                    <h3 class="title">BURTON BLUNT FW14</h3>
                    <span class="cost">14730руб.</span>
                  </div>
                </article>
              </a>
            </div>
          </div>
        </div>
      </section>

 <section class='promo-goods'>
        <a href='#/promo-good1/'>
          <article class='promo-good'>
            <h1 class='title'><b>BURTON</b><br>BLUNT FW14</h1>
          </article>
        </a>
        <a href='#/promo-good2/'>
          <article class='promo-good'>
            <h1 class='title'><b>Dream</b><br>Grind 2014</h1>
          </article>
        </a>
          <a href='#/promo-good3/'>
          <article class='promo-good'>
            <h1 class='title'><b>Dragon</b><br>Board Surf</h1>
          </article>
        </a>
      </section>

      <section class='goods popular'>
        <header class='goods-header'>
          <h2 class='title'>Популярные товары</h2>
          <div id="toggle-second" class='toggle-btns'>
          </div>
        </header>

        <div class='catalog'>
          <div class="jcarousel-row jcarousel">
            <div id="second" class="jcarousel-list">
              <a href="product.php?product_type=wakeboards&model_id=5" target="blanck">
                <article class='good'>
                  <figure class='good-img'>
                    <img src='image/wakeboards/5_1.jpg' alt=''>
                  </figure>
                  <div class='good-info'>
                    <h3 class='title'>Liquid Force Jett Grind</h3>
                    <span class='cost'>15840руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=scooters&model_id=4" target="blanck">
                <article class='good'>
                  <figure class='good-img'>
                    <img src='image/scooters/4_1.jpg' alt=''>
                  </figure>
                  <div class='good-info'>
                    <h3 class='title'>MF 1.8 OXELO</h3>
                    <span class='cost'>5999руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=snowboards&model_id=4" target="blanck">
                <article class='good sale'>
                  <figure class='good-img'>
                    <img src='image/snowboards/4.jpg' alt=''>
                  </figure>
                  <div class='good-info'>
                    <h3 class='title'>BOXY TORA BRIGHT XC2 BTX</h3>
                    <span class='cost'>19433руб.</span>
                    <span class='old-cost'>25433руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=rockets&model_id=7" target="blanck">
                <article class='good'>
                  <figure class='good-img'>
                    <img src='image/rockets/7_1.jpg' alt=''>
                  </figure>
                  <div class='good-info'>
                    <h3 class='title'>Babolat E-sense Lite</h3>
                    <span class='cost'>4200руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=wakeboards&model_id=10" target="blanck">
                <article class='good'>
                  <figure class='good-img'>
                    <img src='image/wakeboards/10_1.jpg' alt=''>
                  </figure>
                  <div class='good-info'>
                    <h3 class='title'>ATTITUDE 139</h3>
                    <span class='cost'>9795руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=rollers&model_id=4" target="blanck">
                <article class='good new'>
                  <figure class='good-img'>
                    <img src='image/rollers/4_1.jpg' alt=''>
                  </figure>
                  <div class='good-info'>
                    <h3 class='title'>SNEAK-IN B3P OXELO</h3>
                    <span class='cost'>3999руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=snowboards&model_id=5" target="blanck">
                <article class='good hot'>
                  <figure class='good-img'>
                    <img src='image/snowboards/5_1.jpg' alt=''>
                  </figure>
                  <div class='good-info'>
                    <h3 class='title'>BURTON EASY LIVIN FW15</h3>
                    <span class='cost'>25160руб.</span>
                  </div>
                </article>
              </a>

              <a href="product.php?product_type=skateboards&model_id=6" target="blanck">
                <article class='good'>
                  <figure class='good-img'>
                    <img src='image/skateboards/6_1.jpg' alt=''>
                  </figure>
                  <div class='good-info'>
                    <h3 class='title'>JDBug Powersurfer RT169</h3>
                    <span class='cost'>1490руб.</span>
                  </div>
                </article>
              </a>
            </div>
          </div>
        </div>
      </section>

      <section class='about container'>
        <h2 class='title'>О магазине</h2>
        <p class='description'>
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
          Aenean commodo ligula eget dolor. Aenean massa. Cum sociis
          natoque penatibus et magnis dis parturient montes, nascetur
          ridiculus mus. Donec quam felis, ultricies nec, pellentesque
          eu, pretium quis, sem.<br><br>

          Nulla consequat massa quis enim. Donec pede justo, fringilla
          vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus
          ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis
          eu pede mollis pretium. Integer tincidunt. Cras dapi-
        </p>
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
    <script src="slick/slickk.js"></script>
    <script src="JS/index.js"></script>
    <script src="JS/scriptJS.js"></script>
  </body>
</html>