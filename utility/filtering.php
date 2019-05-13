<?php
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

  if(isset($_POST['list']) && isset($_POST['country'])){ //query where we want filtering by ingre list and country
    $list = json_decode($_POST['list']);
    $list = array_map("htmlspecialchars", $list);
    $country = json_decode($_POST['country']);
    $country = array_map("htmlspecialchars", $country);
    $merge = array_merge($list,$country);
    $numberofparam = count($list);
    if(count($list)-1 >= 0 && count($country)-1 >= 0){
      $placeholders1 = str_repeat('?,', count($list) - 1)  . '?';
      $placeholders2 = str_repeat('?,', count($country) - 1) . '?';
      $stmt = $pdo->prepare("SELECT DISTINCT
                             r.nazwa_przepisu, r.opis_przepisu, r.zdjecie_przepisu, r.przygotowanie_przepisu, r.kraj_pochodzenia, r.spis_produktow
                             FROM recipes r
                             JOIN reci_ingre ri on r.id_przepisu = ri.id_przepisu
                             JOIN ingredients i on ri.id_skladnika = i.id_skladnika
                             WHERE i.nazwa_skladnika IN ($placeholders1) AND (kraj_pochodzenia IN ($placeholders2))
                             GROUP BY r.id_przepisu
                             HAVING COUNT(r.id_przepisu) = $numberofparam
                             ORDER BY COUNT(r.id_przepisu) DESC");
      $stmt->execute($merge);
      $data = $stmt->fetchAll();
      echo json_encode($data);
    }


  }else if((empty($_POST['list']) && isset($_POST['country'])) || (empty(json_decode($_POST['list'], true)) && isset($_POST['country']))){//query where we want filterin only by country
    $country = json_decode($_POST['country']);
    $country = array_map("htmlspecialchars", $country);

    if(count($country)-1 >= 0){
      $placeholders = str_repeat('?,', count($country) - 1) . '?';
      $stmt = $pdo->prepare("SELECT DISTINCT
                             r.nazwa_przepisu, r.opis_przepisu, r.zdjecie_przepisu, r.przygotowanie_przepisu, r.kraj_pochodzenia, r.spis_produktow
                             FROM recipes r
                             WHERE kraj_pochodzenia IN ($placeholders)");
      $stmt->execute($country);
      $data = $stmt->fetchAll();
      echo json_encode($data);
  } exit();





}else if((isset($_POST['list']) && empty($_POST['country'])) || (isset($_POST['list']) && empty(json_decode($_POST['country'], true)))){ // query where we want only filtering by ingredients list
    $list = json_decode($_POST['list']);
    $list = array_map("htmlspecialchars", $list);
    $numberofparam = count($list);
    if(count($list)-1 >= 0){
      $placeholders = str_repeat('?,', count($list) - 1) . '?';
      $stmt = $pdo->prepare("SELECT DISTINCT
                             r.nazwa_przepisu, r.opis_przepisu, r.zdjecie_przepisu, r.przygotowanie_przepisu, r.kraj_pochodzenia, r.spis_produktow
                             FROM recipes r
                             JOIN reci_ingre ri on r.id_przepisu = ri.id_przepisu
                             JOIN ingredients i on ri.id_skladnika = i.id_skladnika
                             WHERE i.nazwa_skladnika IN ($placeholders)
                             GROUP BY r.id_przepisu
                             HAVING COUNT(r.id_przepisu) = $numberofparam
                             ORDER BY COUNT(r.id_przepisu) DESC");
      $stmt->execute($list);
      $data = $stmt->fetchAll();
      echo json_encode($data);
    }

  exit();
}

?>
