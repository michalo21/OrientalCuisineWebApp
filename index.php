<?php
session_start();

?>
<!DOCTYPE html>
<html  lang="pl">

  <head>

    <meta http-equiv="Content-Language" content="pl">
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="kuchnia">
    <meta name="author" content="michas">

    <title>Orientalne kuchnie</title>

    <!-- Bootstrap css-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <!--Moj css -->
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <!--FONT AWSOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- JS do BOOTSTRAP!-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- MOJ JS-->
    <script type="text/javascript" src="js/ajaxbyjq.js"> </script>
    <script type="text/javascript" src="js/addproduct.js"> </script>
    <script type="text/javascript" src="js/ajaxfilter.js"> </script>
    <script type="text/javascript" src="js/login.js"> </script>
    <script src="vendor/jquery/jquery-ui.js"></script>




    <!--PRZYDATNE DO PIERDOL WYGLADOWYCH -->


  </head>


  <body data-spy="scroll" data-target=".navbar" data-offset="5">
    <!-- user login -->

    <?php if(!isset($_SESSION["admin"])){
      echo '<i id="loginUser" class="fa fa-user-circle fa-2x btn dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
        <div class="dropdown-menu" id="loginDiv">
            <div class="form-group">
              <input id="logge" type="text" placeholder="Username" class="form-control"></input>
            </div>
            <div class="form-group">
              <input id="passe" type="password" placeholder="Password" class="form-control"></input>
            </div>
            <div class="form-group">
              <i id="clicko" class="fas fa-sign-in-alt fa-2x"></i>
            </div>
        </div>';
    }else if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1){
        echo '<a href="../utility/logout.php"><i id="loginUser" class="fas fa-sign-out-alt fa-2x"></i></a>';
        }
    ?>

    <!-- Co w stronce piszczy -->


      <div class="container-fluid" id="index">
        <div class="row">
          <div class="col-sm ">
            <h1 class="display-3">Kuchnia orientalna</h1>
            <p > Niepowtarzalne połączenia smakowe oraz doskonałe aromaty potraw stanowią wyjątkową ucztę dla naszych zmysłów. Przedstawię Ci najpopularniejsze dania z kuchnii japońskiej, tajskiej, indyjskiej oraz chińskiej. </p>
          </div>
        </div>
      </div>


      <div class="container-fluid" id="japan">
        <div class="row">
          <div class="col-sm">
            <h1 class="display-3">Japonia</h1>
            <p> Sushi to najpopularniejsza potrawa kraju kwitnącej wiśni. Złożona z gotowanego ryżu zaprawionego octem ryżowym oraz najróżniejszych dodatków w postaci, przeważnie surowych: owoców morza, wodorostów nori, kawałków ryb, warzyw, grzybów, a także omletu japońskiego, tofu, ziarna sezamowego. Ze względu na bardzo krótki termin przydatności do spożycia, w restauracjach japońskich jest przygotowywana po dokonaniu zamówienia. </p>
          </div>
        </div>
      </div>

      <div class="container-fluid" id="tai" >
        <div class="row">
          <div class="col-sm ">
            <h1 class="display-3">Tajlandia</h1>
            <p>Głównym składnikiem Pad Thai jest makaron ryżowy. Dodatki mogą być różne, w zależności od przepisu kucharza, ale zazwyczaj są to: omlet, krewetki albo kurczak (czasem też mięso wieprzowe), kiełki fasoli mung, pasta tamaryndowca, tofu, czosnek, rzepa marynowana, papryczka chilli oraz sos rybny. Danie udekorowane jest najczęściej orzeszkami ziemnymi oraz drobno posiekanym szczypiorkiem.
              Dziś Pad Thai ma wiele wariacji i przyrządzane jest w wielu azjatyckich krajach.</p>
          </div>
        </div>
      </div>

      <div class="container-fluid"  id="india">
        <div class="row">
          <div class="col-sm ">
            <h1 class="display-3">Indie</h1>
            <p>Najpopularniejsza potrawą indyjską jest Curry. W gęstym, głębokim sosie pływają kawałki mięsa (kurczak lub baranina), ryb, owoców morza lub owoców. O smaku potrawy decyduje sos. Bardzo często przyrządzany jest na bazie mleka kokosowego.
              Curry bywa niezwykle pikantne, możemy jednak spotkać się także z wersjami łagodnymi, niemal słodkimi. Wszystko zależy od tego, jakich przypraw i dodatków użyjemy.</p>
          </div>
        </div>
      </div>

      <div class="container-fluid" id="china">
        <div class="row">
          <div class="col-sm ">
            <h1 class="display-3">Chiny</h1>
            <p>W Chinach króluje potrawa o wdzięcznej nazwie Kurczak Gong Bao. Nazwana na cześć gubernatora prowincji Syczuan, Ding Baozhen. Jest to smażony, pocięty w kostke kurczak z dodatkiem imbiru, szczypiorku, papryczek chilli i orzeszków ziemnych. Na bazie jasnego sosu sojowego, wina Shaoxing i skrobi kukurydzianej. </p>
          </div>
        </div>
      </div>

      <div class="container-fluid" id="recipes">
        <div class="row">
          <div class="col-sm" id="logoRecipes">
            <h1 class="display-3">Przepisy</h1>
            <p>Znajdź swój ulubiony przepis i przyrządź go już dziś!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
              <div class="form-group">
                <p class="lead">Wybierz kraj potrawy!</p>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="japanCheck" value="japonia">
                  <label class="form-check-label" for="japanCheck">Japonia</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="thaiCheck" value="tajlandia">
                  <label class="form-check-label" for="thaiCheck">Tajlandia</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="indiaCheck" value="indie">
                  <label class="form-check-label" for="indiaCheck">Indie</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="chinaCheck" value="chiny">
                  <label class="form-check-label" for="chinaheck">Chiny</label>
                </div>
                <p class="lead">Wprowadź produkt, który ma się zawierać w potrawie </p>
                  <input type="text" list="resultSearch" id="searchProduct" autocomplete="off" placeholder="np. papryka" >
                  <span class="fa fa-search"></span>
                  <datalist id="resultSearch"></datalist>
                  <ul class="list-group" id="listProduct"></ul>
              </div>
          </div>
          <div class="col-sm-8">
            <p class="lead">Wyszukane przepisy, nacisnij by wyświetlić</p>
            <div id="carouselDishes" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner" id="carouselDishesInner">

              <a class="carousel-control-prev" href="#carouselDishes" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselDishes" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal" tabindex="-1" role="dialog" id="modalRecipe">
        <div class="modal-dialog moda-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button btn-light" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Smacznego :)</button>
            </div>
          </div>
        </div>
      </div>
    </div>

      <div class="container-fluid" id="me" >
        <div class="row">
          <div class="col-sm">
            <h1 class="display-3">Projekt</h1>
            <p>Aplikacja webowa mająca za zadanie choć trochę przybliżyć orientalną kuchnię świata użytkownikowi umożliwiając mu znalezienie ciekawych przepisów na podstawie wybranych składników.
               Technlogoie w niej użyte to Bootstrap 4, HTML5, JavaScript, AJAX, PHP, JSON, JQUERY.</p>
          </div>
        </div>
      </div>

      <!-- Menu  -->
      <nav class="navbar navbar-expand-sm navbar-dark bg-transparent fixed-bottom">
        <div class="container">
          <a class="navbar-brand" href="#index">Home</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse " id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="#me">O stronie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#japan">Japonia</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tai">Tajlandia</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#india">Indie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#china">Chiny</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#recipes">Przepisy</a>
              </li>
              <?php
              if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1 ){
                echo '<li class="nav-item">
                  <a class="nav-link" href="panel.php">Panel</a>
                </li>';
              }

              ?>
            </ul>
          </div>
        </div>
      </nav>

  </body>

</html>
