<?php
  session_start();
  if(!isset($_SESSION["admin"]) && $_SESSION["admin"] != 1){
    header('Location: index.php');
    exit();
  }
  if(isset($_POST['products'])){
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

    $products = json_decode($_POST['products']);
    $products = trim(htmlspecialchars($products));

    $like = mb_strtolower($products);

    $stmt = $pdo -> prepare("SELECT nazwa_skladnika FROM ingredients WHERE
                             lower(nazwa_skladnika) LIKE ?");
    $stmt -> execute(array($like));
    $data = $stmt -> fetchAll();
    if($stmt && empty($data) ){
      echo json_encode(true);
    }else{
      echo json_encode(false);
    }
  }
?>
