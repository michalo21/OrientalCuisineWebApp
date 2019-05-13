<?php
  session_start();
  if(!isset($_SESSION["admin"]) && $_SESSION["admin"] != 1){
    header('Location: index.php');
    exit();
  }
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
    <link href="css/mainPanel.css" type="text/css" rel="stylesheet">
    <!--FONT AWSOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- JS do BOOTSTRAP!-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- MOJ JS -->
    <script type="text/javascript" src="js/adding.js"> </script>



  </head>

  <body>
    <!-- LOGoUT -->
    <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1){
        echo '<a href="../utility/logout.php"><i id="loginUser" class="fas fa-sign-out-alt fa-2x"></i></a>';
        }
    ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm">
          <h1 id="re" class="display-4">Dodaj przepis!</h1>
          <div id="formRecipe">
              <div class="form-group">
                <input id="nameReci" type="text" class="form-control"  placeholder="Nazwa"></input>
              </div>
              <div class="form-group">
                <textarea id="descReci" class="form-control"  placeholder="Opis produktów"></textarea>
              </div>
              <div class="form-group">
                <input  id ="pathImg" type="text" class="form-control"  placeholder="Ścieżka do zdjęcia ( ../pics/dishes/nazwa_zdj.jpg)"></input>
              </div>
              <div class="form-group">
                <textarea id="prepReci" class="form-control"  placeholder="Przygotowanie produktów"></textarea>
              </div>
            <!--  <div class="form-group">
                <input id="countryReci" type="text" class="form-control"  placeholder="Kraj"></input>
              </div>-->
              <div class="form-group">
                <select class="form-control" id="countryReci">
                  <option value="" disabled selected>Wybierz kraj</option>
                  <option>Japonia</option>
                  <option>Tajlandia</option>
                  <option>Indie</option>
                  <option>Chiny</option>
                </select>
              </div>
              <div class="form-group">
                <textarea id="productReci" class="form-control"  placeholder="Spis produktów"></textarea>
              </div>
                <button id="clickRecip" class="btn btn-light">Dodaj do bazy!</button>
          </div>
        </div>

        <div class="col-sm">
          <h1 id="in" class="display-4">Dodaj składniki!</h1>
          <div id="formIngre">
            <div class="form-group">
              <input id="searchingNoProduct" type="text" class="form-control" autocomplete="off" placeholder="Dodaj do listy produktu, którego nie ma"></input>
            </div>
            <ul class="list-group list-unstyled" id="panelListProduct"> </ul>
              <button id="addProd" class="btn btn-light"  placeholder="Spis produktów">Dodaj do bazy!</button>
        </div>
      </div>

        <div class="col-sm">
          <h1 id="mi" class="display-4">Wymieszaj!</h1>
          <div id="formCreate">
              <div class="form-group">
                <input id="recipeName" type="text" class="form-control"  placeholder="Nazwa przepisu"></input>
              </div>
              <div class="form-group">
                <input list="resultSearch" id="searchProduct" type="text" class="form-control" placeholder="Dodaj produkt"></input>
                <datalist id="resultSearch"></datalist>
              </div>
              <ul class="list-group list-unstyled" id="listPanel"> </ul>
                <button id="addMix" class="btn btn-light"  placeholder="Spis produktów">Wymieszaj!</button>
          </div>
        </div>
      </div>
  </div>

  <!-- Menu  -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-transparent fixed-bottom">
    <div class="container">
      <a class="navbar-brand" href="/index.php">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php#me">O stronie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#japan">Japonia</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#tai">Tajlandia</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#india">Indie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#china">Chiny</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#recipes">Przepisy</a>
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
