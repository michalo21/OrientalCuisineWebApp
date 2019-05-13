<?php
  session_start();
  if(!isset($_SESSION["admin"]) && $_SESSION["admin"] != 1){
    header('Location: index.php');
    exit();
  }
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'kuchnie_projekt';

  try{
      $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);

    }
  catch(PDOException $e){
      echo $e->getMessage();
    }

  if(isset($_POST["name"]) && isset($_POST["desc"]) && isset($_POST["path"]) && isset($_POST["prep"]) && isset($_POST["country"]) && isset($_POST["product"])){

    $name = trim(htmlspecialchars(json_decode($_POST["name"])));
    $like = mb_strtolower($name);

    $stmt1 = $pdo -> prepare("SELECT id_przepisu FROM recipes WHERE lower(nazwa_przepisu) like ?");
    $stmt1 -> execute(array($like));
    $date = $stmt1 -> fetchAll();
    if( empty($date) ){
      $desc = trim(htmlspecialchars(json_decode($_POST["desc"])));
      $path = trim(htmlspecialchars(json_decode($_POST["path"])));
      $prep = trim(htmlspecialchars(json_decode($_POST["prep"])));
      $country = trim(htmlspecialchars(json_decode($_POST["country"])));
      $product = trim(htmlspecialchars(json_decode($_POST["product"])));

      $stmt = $pdo -> prepare("INSERT INTO recipes (nazwa_przepisu, opis_przepisu, zdjecie_przepisu, przygotowanie_przepisu, kraj_pochodzenia, spis_produktow)
                                VALUES (?,?,?,?,?,?)");
      $stmt -> execute(array($name,$desc,$path,$prep,$country,$product));
      if($stmt){
        echo json_encode(true);
      }else{
        echo json_encode(false);
      }
    }else{
        echo json_encode("contain");
    }

  }
?>
