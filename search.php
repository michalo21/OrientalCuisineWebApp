<?php
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'kuchnie_projekt';

  $mysqli = new mysqli($host, $user, $password, $database);

  $products = $_POST['products'];
  $products = trim(htmlspecialchars($products));

  $like = '%' . strtolower($products) . '%';

  $statement = $mysqli -> prepare('SELECT nazwa_skladnika FROM ingredients WHERE
   lower(nazwa_skladnika) LIKE ? ORDER BY INSTR(nazwa_skladnika, ?) LIMIT 4');

  if(
    $statement &&
    $statement -> bind_param('ss', $like, $products) &&
    $statement -> execute() &&
    $statement -> store_result() &&
    $statement -> bind_result($nazwa_skladnika)){
      $array = [];
      while($statement -> fetch()){
        $array[] = ['nazwa_skladnika' => $nazwa_skladnika];
      }
      echo json_encode($array);
      exit();
    }








?>
