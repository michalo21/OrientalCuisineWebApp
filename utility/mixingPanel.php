<?php
  session_start();
  if(!isset($_SESSION["admin"]) && $_SESSION["admin"] != 1){
    header('Location: index.php');
    exit();
  }
  //dynamicznie wyszukiwanie produktow w bazie
  if(isset($_POST['productss'])){
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

    $products = json_decode($_POST['productss']);
    $products = trim(htmlspecialchars($products));

    $like = '%' . mb_strtolower($products) . '%';

    $stmt = $pdo -> prepare("SELECT nazwa_skladnika FROM ingredients WHERE
                             lower(nazwa_skladnika) LIKE ? ORDER BY INSTR(nazwa_skladnika, ?) LIMIT 4");
    $stmt -> execute(array($like, $products));
    $data = $stmt -> fetchAll();
    echo json_encode($data);
  }
  //laczenie many-to-many recipe z ingredient
  if(isset($_POST['nameMix']) && isset($_POST['listMix'])){
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

    $nazwa = json_decode($_POST["nameMix"]);
    $nazwa = trim(htmlspecialchars($nazwa));
    $like = mb_strtolower($nazwa);

    $produkty = json_decode($_POST["listMix"]);
    $produkty = array_map("htmlspecialchars", $produkty);
    $like2 = array_map("mb_strtolower", $produkty);

    //statement do zebrania id przepisu
    $stmt1 = $pdo -> prepare("SELECT id_przepisu FROM recipes WHERE lower(nazwa_przepisu) like ?");
    $stmt1 -> execute(array($like));
    $id1 = $stmt1 -> fetchAll(PDO::FETCH_COLUMN);

    if(count($id1) == 0){
      echo json_encode(false);
    }else{
      //statement do zebrania id_ingre
      $placeholders1 = str_repeat('?,', count($produkty) - 1)  . '?';
      $stmt2 = $pdo -> prepare("SELECT id_skladnika FROM ingredients WHERE lower(nazwa_skladnika) IN ($placeholders1)");
      $stmt2 -> execute($like2);
      $id2 = $stmt2 -> fetchAll(PDO::FETCH_COLUMN);

      if(count($id2) == 0){
        echo json_encode(false);
      }else{
        $string = str_repeat('('.$id1[0].',?),', count($id2)-1).'('.$id1[0].',?)';
        $stmt3 = $pdo -> prepare("INSERT INTO reci_ingre (id_przepisu, id_skladnika) VALUES $string");
        $stmt3 -> execute($id2);
        if($stmt3){
          echo json_encode(true);
        }
      }
    }
  }

?>
