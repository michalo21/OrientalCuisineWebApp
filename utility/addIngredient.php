<?php
  session_start();
  if(!isset($_SESSION["admin"]) && $_SESSION["admin"] != 1){
    header('Location: index.php');
    exit();
  }

  if(isset($_POST['list'])){
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
    $list = json_decode($_POST['list']);
    $list = array_map("htmlspecialchars", $list);
    $dynamicInput = str_repeat('(?),', count($list)-1);

    $stmt = $pdo -> prepare("INSERT INTO ingredients (nazwa_skladnika) VALUES $dynamicInput (?)");
    $stmt -> execute($list);
    if($stmt == true){
      echo json_encode(true);
    }else{
      echo json_encode(false);
    }
  }
?>
