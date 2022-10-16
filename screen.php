
<?php
session_start(); 
include "css.php";
include "index.php";



function addUser($req) {
  while($sites = $req->fetch(PDO::FETCH_OBJ)){
    $user = [];
    $tmp = unserialize($sites->PL1);

    $x = $tmp->x;
    $y = $tmp->y;
    $color = $tmp->color;
    $nbEnergy = $tmp->energy;
    $nbIndustry = $tmp->industry;
    $score = $tmp->score;

    $count_offensive = 0;
    for ($z=0; $z<$tmp->nbBuildings; $z++){
      if ($tmp->buildings[$z]->id == "Offensive" && $tmp->buildings[$z]->health>0){
        $count_offensive++;
      }
    }
    
    $count_logistique = 0;
    for ($r=0; $r<$tmp->nbBuildings; $r++){
      if ($tmp->buildings[$r]->id == "Logistique" && $tmp->buildings[$r]->health>0){
        $count_logistique++;
      }
    }

    $count_canon = 0;
    for ($s=0; $s<$tmp->nbBuildings; $s++){
      if ($tmp->buildings[$s]->id == "Canon" && $tmp->buildings[$s]->health>0){
        $count_canon++;
      }
    }

    

    $user['x'] = $x;
    $user['y'] = $y;
    $user['color'] = $color;
    $user['energy'] = $nbEnergy;
    $user['industry'] = $nbIndustry;
    $user['score'] = $score;
    $user['offensive'] = $count_offensive;
    $user['logistique'] = $count_logistique;
    $user['canon'] = $count_canon;


  }
  return $user;
}


if (!isset($_SESSION['username'])){
  echo "<script type='text/javascript'>document.location.replace('login.php');</script>";
}
$current_user = $_SESSION['username'];
echo('<br> current user : ');
print_r($current_user);
echo('<br>');


$players = [];

  
  $bdd = new PDO('mysql:host=localhost;dbname=game','user1','A!!Cud!PgDyA)OsG');

  $requete = "SELECT * FROM connexion3 WHERE identifiant = :identifiant";
  $req = $bdd->prepare($requete);
  $req->bindParam(':identifiant', $current_user);
  $req->execute();


  $user = addUser($req);
  $players[$current_user] = $user;


  $requete = "SELECT * FROM connexion3";
  $req = $bdd->prepare($requete);
  $req->execute();
  $count = $req->rowCount();


  for ($i=1; $i<$count+1; $i++){ 

  $requete = "SELECT * FROM connexion3 WHERE id = $i";
  $req = $bdd->prepare($requete);
  $req->execute();

  $user = addUser($req);


  $requete = "SELECT * FROM connexion3 WHERE id = $i";
  $req = $bdd->prepare($requete);
  $req->execute();

  while($sites = $req->fetch(PDO::FETCH_OBJ)){
    $identifiant = $sites->identifiant;
  };
  
  $players[$identifiant] = $user;

  }



//-------------------------------------------------------

function updateUser($tmp,$nom){
  $user = serialize($tmp);

  $bdd = new PDO('mysql:host=localhost;dbname=game','user1','A!!Cud!PgDyA)OsG');

  $requete = "UPDATE connexion3 SET PL1 = :PL1 WHERE identifiant = :identifiant";

  $req = $bdd->prepare($requete);
  $req->bindParam(':identifiant', $nom);
  $req->bindParam(':PL1', $user);
  $req->execute();

}


function getUser($user){

  $bdd = new PDO('mysql:host=localhost;dbname=game','user1','A!!Cud!PgDyA)OsG');

  $requete = "SELECT * FROM connexion3 WHERE identifiant = :identifiant";
  $req = $bdd->prepare($requete);
  $req->bindParam(':identifiant', $user);
  $req->execute();

  while($sites = $req->fetch(PDO::FETCH_OBJ)){
    $user = [];
    $tmp = unserialize($sites->PL1);
  }
  return $tmp;
}

$tmp = getUser($current_user);

//Rajouter des ressources 
// $tmp->industry = 8000;
// $tmp->energy = 4000;

echo('tmp : ');
print_r($tmp);
echo('<br> nbRessources : <br>');
print_r($tmp->nbRessources);






if (!isset($_POST['add'])) {
  $_SESSION['industrie'] = $count_indus; 

}

if (!isset($_POST['add1'])) {
  $_SESSION['central_energie'] = $count_energ;

}
if (!isset($_POST['add2'])) {
  $_SESSION['logistique'] = $count_logistique; 

}
if (!isset($_POST['add3'])) {
  $_SESSION['offensive'] = $count_offensive; 

}
if (!isset($_POST['add4'])) {
  $_SESSION['canon'] = $count_canon;

}
  

?>
<head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<h1 style="color:white;font-size:2em;position:fixed;top: 15px; left: 20px">Ugame</h1>
<h3 style="color:white;font-size:1em;position:fixed;top: 100px; left: 50px"> <?=$_SESSION['username']?></h3>


<div id="info">
</div>

<div id="info1">
<?php
$count_indus = 0;
for ($i=0; $i<$tmp->nbRessources; $i++){
  if ($tmp->ressources[$i]->indale == 0){
    $count_indus++;
  }
}
?>
<form method='post' action= "screen.php">
<h4>Industrie : <?=$count_indus?> </h4>
<input name='add' type="submit" value='Ajouter'>
<input name ="up_indus" placeholder="max <?=$count_indus?>" style="width:100px" min="0" max=<?=$count_indus?> type="number" value="">
<input name='add7' type="submit" value='Up level'>
</form>

<?php
function industry($tmp,$tmp2,$current_user){
  if ($tmp->getIndustry()==0){
    $tmp2++;
    $_SESSION['industrie'] = $tmp2;
    updateUser($tmp,$current_user);
  }

}
function up_indus($n,$tmp,$current_user){
    $tmp->upgradeType($n-1, 0);
    updateUser($tmp,$current_user);
  }

if ($_POST['add'] > $count_indus){
  industry($tmp, $_SESSION['industrie'],$current_user);
  echo "<script type='text/javascript'>document.location.replace('screen.php');</script>";
}
if (null!==$_POST['add7'] && null !== $_POST['up_indus']){
  up_indus($_POST['up_indus'],$tmp,$current_user);
  echo "<script type='text/javascript'>document.location.replace('screen.php');</script>";
}
?>

<hr>

<?php
$count_energ = 0;
for ($i=0; $i<$tmp->nbRessources; $i++){
  if ($tmp->ressources[$i]->indale == 1){
    $count_energ++;
  }
}
?>

<form method='post'>
<h4>Centrale energie : <?=$count_energ?></h4>
<input name='add1' type="submit" value='Ajouter'>
<input name ="up_eng" placeholder="max <?=$count_energ?>" style="width:100px" min="0" max=<?=$count_energ?> type="number" value="">
<input name='add8' type="submit" value='Up level'>
</form>

<?php
function energy($tmp,$tmp2,$current_user){
  if ($tmp->getEnergy()==0){
    $tmp2++;
    $_SESSION['central_energie'] = $tmp2;
    updateUser($tmp,$current_user);
  }
}
function up_energ($n,$tmp,$current_user){
  $tmp->upgradeType($n-1, 1);
  updateUser($tmp,$current_user);
}

if ($_POST['add1'] > $count_energ){
  energy($tmp, $_SESSION['central_energie'],$current_user);
  echo "<script type='text/javascript'>document.location.replace('screen.php');</script>";
}
if (null!==$_POST['add8'] && null!== $_POST['up_eng']){
  up_energ($_POST['up_eng'],$tmp,$current_user);
  echo "<script type='text/javascript'>document.location.replace('screen.php');</script>";
}
?>

<hr>

<?php
$count_logistique = 0;
for ($i=0; $i<$tmp->nbBuildings; $i++){
  if ($tmp->buildings[$i]->id == "Logistique" && $tmp->buildings[$i]->health>0){
    $count_logistique++;
  }
}
?>

<form method='post'>
<h4>Troupes logistique : <?=$count_logistique ?> </h4>
<input name='add2' type="submit" value='Ajouter'>
</form>

<?php
function logistique($tmp,$tmp2,$current_user){
  $tmp->getTroop(2);
  $tmp2++;
  $_SESSION['logistique'] = $tmp2;
  //echo $_SESSION['logistique'];
  updateUser($tmp,$current_user);

}
if ($_POST['add2'] > $count_logistique){
  if ($tmp->industry > 10){
  logistique($tmp, $_SESSION['logistique'],$current_user);
  echo "<script type='text/javascript'>document.location.replace('screen.php');</script>";
  }
}
?>

<hr>

<?php
$count_offensive = 0;
for ($i=0; $i<$tmp->nbBuildings; $i++){
  if ($tmp->buildings[$i]->id == "Offensive" && $tmp->buildings[$i]->health>0){
    $count_offensive++;
  }
}
?>

<form method='post'>
<h4>Troupes offensive : <?=$count_offensive?> </h4>
<input name='add3' type="submit" value='Ajouter'>
</form>

<?php
function offensive($tmp,$tmp2,$current_user){
  $tmp->getTroop(1);
  $tmp2++;
  $_SESSION['offensive'] = $tmp2;
  
  updateUser($tmp,$current_user);

}
if ($_POST['add3'] > $count_offensive){
  if ($tmp->industry > 10){
    offensive($tmp, $_SESSION['offensive'],$current_user);
    echo "<script type='text/javascript'>document.location.replace('screen.php');</script>";
  }
}
?>

<hr>

<?php
$count_canon = 0;
for ($i=0; $i<$tmp->nbBuildings; $i++){
  if ($tmp->buildings[$i]->id == "Canon" && $tmp->buildings[$i]->health>0){
    $count_canon++;
  }
}
?>

<form method='post'>
<h4>Canons : <?=$count_canon ?> </h4>
<input name='add4' type="submit" value='Ajouter'>
</form>

<?php
function canon($tmp,$tmp2,$current_user){
  $tmp->getTroop(0);
  $tmp2++;
  $_SESSION['canon'] = $tmp2;
  //echo $_SESSION['offensive'];
  updateUser($tmp,$current_user);

}
if ($_POST['add4'] > $count_canon){
  if ($tmp->energy > 2 && $tmp->industry > 15){
  canon($tmp, $_SESSION['canon'],$current_user);
  echo "<script type='text/javascript'>document.location.replace('screen.php');</script>";
  }
}

?>
</div>


<div id="info2">

<form method='post'>
<!-- <h3>Canons : <?php //echo $_SESSION['canon']++ ?> </h3> -->
<br>
<label for="quantity">Troupes attack: <br> <p> (si troupe non selectionnée mettre 0)</p></label>
  <h5> Troupes offensive : <input type="number" id="quantity_offensive" placeholder="max <?=$count_offensive?>" style="width:100px" name="quantity_offensive" min="0" max=<?=$count_offensive?>></h5>
  <h5> Canon : <input type="number" id="quantity_canon" placeholder="max <?=$count_canon?>" style="width:100px" name="quantity_canon" min="0" max=<?=$count_canon?>></h5>
  <h5> Troupes logistique : <input type="number" id="quantity_logistique" placeholder="max <?=$count_logistique?>" style="width:100px" name="quantity_logistique" min="0" max=<?=$count_logistique?>></h5>
  <br>
  <h5> Cible : </h5>
  <pre> x: <input type="number" id="x" style="width:100px" name="x" min="0" max="500"><pre>
  <pre> y: <input type="number" id="y" style="width:100px" name="y" min="0" max="500"><pre>
  <br>
  <input type="submit" value="Attaquer">
</form>


<?php

if(null!=$_POST['quantity_offensive'] && null!=$_POST['quantity_canon'] && null!=$_POST['quantity_logistique'] && null!=$_POST['x'] && null!=$_POST['y']){
      $nbOffens = $_POST['quantity_offensive'];
      $nbCanon = $_POST['quantity_canon'];
      $nbLogist = $_POST['quantity_logistique'];
      $nb_x = $_POST['x'];
      $nb_y = $_POST['y'];
      

      foreach ($players as $attacked => $player){
        if( $player['x'] == $nb_x && $player['y'] == $nb_y){
          $cible = $attacked;
        }
      }

      if (isset($cible)){

      $troupsList = [$nbCanon, $nbOffens,  $nbLogist];
      
      $finalTroops = [];

      for ($i = 0; $i<$tmp->nbBuildings; $i++){
        if ($troupsList[1]>0){
          if ($tmp->buildings[$i]->id == "Offensive"){
            if ($tmp->buildings[$i]->health>0){
                  $troupsList[1]-=1;
                  array_push($finalTroops, $i);
            }
          }
        }
      }
      
      for ($i = 0; $i<$tmp->nbBuildings; $i++){
        if ($troupsList[0]>0){
          if ($tmp->buildings[$i]->id == "Canon"){
            if ($tmp->buildings[$i]->health>0){
                  $troupsList[0]-=1;
                  array_push($finalTroops, $i);
            }
          }
        }
      }

      for ($i = 0; $i<$tmp->nbBuildings; $i++){
        if ($troupsList[2]>0){
          if ($tmp->buildings[$i]->id == "Logistique"){
            if ($tmp->buildings[$i]->health>0){
                  $troupsList[2]-=1;
                  array_push($finalTroops, $i);
            }
          }
        }
      }


      
      

      //FAIRE LA FONCTION D'ATTAQUE ICI !!!!!!!!!!!!!!!!!!!!!!

      //calculer la duré de l'attaque pour atteindre la cible
      $distance = sqrt((($tmp->x)-$nb_x)**2+(($tmp->y)-$nb_y)**2);
      $time = round($distance/5);

      
      
      $tmp_cible = getUser($cible);

      //sleep($time);
      $tmp_Ts = $tmp->prepareAttack($tmp, $finalTroops);
      $t = $tmp->tradeAttack($tmp_Ts,$finalTroops,$tmp_cible);
     
      //print_r($t);
      //echo('<br> tmp_cible Canon : ');
      // for ($i=0; $i<$tmp_cible->nbBuildings; $i++){
      //   if ($tmp_cible->buildings[$i]->id == "Canon" && $tmp_cible->buildings[$i]->health>0){
      //     print_r($tmp_cible->buildings[$i]);
      //   }
      // }
      
      
      
      updateUser($tmp,$current_user);
      updateUser($tmp_cible,$cible);
     
      
      //5 tours
      //for ($i=0; $i<5; $i++){
        //if (buildings->health>0){
          //attack avec les troupes restantes
        //}
      //}

      echo("Compte rendu : ");
      if ($t[0]>$t[3] && $t[1]>$t[2] || $t[3] == 0 && $t[2] == 0){echo("Succès<br>");}
      else if ($t[0]<$t[3] && $t[1]<$t[2]) {echo("Echec<br>");}
      else {echo('Echec<br>');}
      
      print_r($current_user); echo(' a attaqué: '); print_r($cible);
      echo("<br><br>Troupes :");
      echo('<br> quantité offensive : '); print_r($nbOffens); 
      echo('<br> canon : '); print_r($nbCanon);
      echo('<br> quantité logistique: '); print_r($nbLogist);
      echo('<br><br> distance : '); print_r(round($distance)); 
      echo('<br> time : '); print_r($time);
      echo('<br><br><br><br>');


      $_POST['quantity_offensive'] == null;
      $_POST['quantity_canon']==null;
      $_POST['quantity_logistique']==null;

      }
}


?>

</div>

<script>
  var infodiv = document.getElementById("info");
  function setInfo(name, x, y, nv_industrie, nv_energie, score, canon, logistique, offensive)
  {
    infodiv.innerHTML = " &nbsp " + name + " (X: " + x + " / Y: " + y + ") <br><br /> &nbsp <span class='material-symbols-outlined' style='font-size:12px; font-family:'Roboto', sans-serif;'>construction </span>" + 
    "Niveau industrie : " + nv_industrie + "&nbsp//&nbsp <span class='material-symbols-outlined' style='font-size:12px; font-family:'Roboto', sans-serif;'>electric_bolt </span>" +  "Niveau d'énergie : " + nv_energie + "&nbsp//&nbsp score : " + score + 
    "<br/><br/> &nbsp canon : " + canon + "&nbsp//&nbsp troupes logistique : " + logistique + "&nbsp//&nbsp troupes offensive : " + offensive ;
    
    
  }


</script>




<div id="screen">
  <?php foreach ($players as $name => $player) { ?>
    <div
       class="player_dot"
       style="top: <?=$player["y"] * 3; ?>; left: <?=$player["x"] * 3; ?>; background-color: <?=$player["color"]; ?>;"
       onmouseover="setInfo('<?=$name; ?>', <?=$player['x']; ?>, <?=$player['y']; ?>, <?=$player['industry']; ?>, <?=$player['energy']; ?>, <?=$player['score']; ?>, <?=$player['canon']?>, <?=$player['logistique']?>, <?=$player['offensive']?>);"
    >
    </div>
  <?php } ?>
</div>


