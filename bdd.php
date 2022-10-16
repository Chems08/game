<?php
include 'index.php';

$bdd = new PDO('mysql:host=localhost;dbname=game','user1','A!!Cud!PgDyA)OsG');

$requete = "SELECT * FROM connexion3";
$req = $bdd->prepare($requete);
$req->execute();
$count = $req->rowCount();

// //-------------------------------------------------------------------------------------------------------------
for ($i = 1; $i<$count+1; $i++){
	$bdd = new PDO('mysql:host=localhost;dbname=game','user1','A!!Cud!PgDyA)OsG');

	$requete = "SELECT * FROM connexion3 WHERE id = :id";

	$req = $bdd->prepare($requete);
	$req->bindParam(':id', $i);
	$req->execute();
	


	while($sites = $req->fetch(PDO::FETCH_OBJ)){
		$rep = unserialize($sites->PL1);
		$PL1 = $rep;
	}


	
	$count_industry = 0;
	$count_energy = 0;
	$prod_indus = 0;
	$prod_energ = 0;

	for ($j=0; $j<$PL1->nbRessources; $j++){
		if ($PL1->ressources[$j]->indale==0){
			$count_industry++;
			$prod_indus += $PL1->ressources[$j]->production;
		}
		else if ($PL1->ressources[$j]->indale==1){
			$count_energy++;
			$prod_energ += $PL1->ressources[$j]->production;
		}
	}
	

	$PL1->industry += $count_industry * $prod_indus;
	$PL1->energy += $count_energy * $prod_energ;
	
	

	$PL1 = serialize($PL1);
	

	
	// //-------------------------------------------------------------------------------------------------------------

	$bdd = new PDO('mysql:host=localhost;dbname=game','user1','A!!Cud!PgDyA)OsG');

	$requete = "UPDATE connexion3 SET PL1 = :PL1 WHERE id = :id";

	$req = $bdd->prepare($requete);

	$req->bindParam(':id', $i);
	$req->bindParam(':PL1', $PL1);
	$req->execute();

	
}
//-------------------------------------------------------------------------------------------------------------


?>
