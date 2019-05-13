<?php

  session_start();

  function verify(){
    if(isset($_POST["username"]) && isset($_POST["password"])){
      $usero = trim(htmlspecialchars(json_decode($_POST["username"])));
      $passwo = trim(htmlspecialchars(json_decode($_POST["password"])));
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

      $stmt = $pdo -> prepare("SELECT id_user FROM users WHERE name = ? AND pass = ? ");
      $stmt -> execute(array($usero, $passwo));
      $data = $stmt -> fetchAll();
      if(!empty($data)){
        echo json_encode(true);
        return true;
      }else{
        session_destroy();
        echo json_encode(false);
      }

    }else{
      return false;
    }
  }

  if(verify() == true){
    $_SESSION["admin"] = 1;
  }else{
    session_destroy();
  }















?>
