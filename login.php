<?php


session_start();

include 'index.php';

$bdd = new PDO('mysql:host=localhost;dbname=game','user1','A!!Cud!PgDyA)OsG');



if(isset($_GET["identifiant"]) && !empty($_GET["identifiant"] && $_GET["passwd"]) && !empty($_GET["passwd"])){

       $identifiant = $_GET["identifiant"];
       $password = $_GET["passwd"];

       $requete = "SELECT * FROM `connexion3` WHERE `identifiant` =? AND `password`=?";

       $req = $bdd->prepare($requete);

       $req->execute(array($identifiant,$password));

       $answer = $req->fetch(PDO::FETCH_OBJ);

       $rep = $answer->identifiant;

       $_SESSION['username'] = $_GET["identifiant"];

}

?>


<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>

        <h1 style="color:white;text-align:center;font-size:3em;">Ugame</h1>

            <!-- zone de connexion -->

            <div class="split left">
                <div class="centered">
                    <form id="connexion" action="login.php" method="GET">
                        <h1>Connexion</h1>
                    
                        <label for="identifiant"><b>Nom d'utilisateur</b></label>
                        <input type="text" id="identifiant" placeholder="Entrez votre nom d'utilisateur" name="identifiant" required>

                        <label for="identifiant"><b>Mot de passe</b></label>
                        <input type="password" id="passwd" placeholder="Entrez votre mot de passe" name="passwd" required>

                        <input type="submit" id='submit' value='SE CONNECTER' >
                
                    </form>
                </div>
            </div>

    </body>
</html>


<?php

if(isset($_GET["identifiant"]) && !empty($_GET["identifiant"] && $_GET["passwd"]) && !empty($_GET["passwd"])){
       //if ($rep==null){
              //echo ("<hr><br>L'identifiant ou le mot de passe n'est pas valide, veuillez réessayer ! <br>");
       //}
       if ($rep!=null){
              //echo ("<hr><br>Bienvenue ".$rep.", vous êtes connecté !");
              echo "<script type='text/javascript'>document.location.replace('screen.php');</script>";
         }      

}



$bdd = new PDO('mysql:host=localhost;dbname=game','user1','A!!Cud!PgDyA)OsG');

if ($_GET["passwd"] != $_GET["other_passwd"]){
    echo ("Le mot de passe a mal été saisi");
}

else if(isset($_GET["identifiant"]) && !empty($_GET["identifiant"] && $_GET["passwd"]) && !empty($_GET["passwd"]) && $_GET["passwd"] == $_GET["other_passwd"]){
    $identifiant = $_GET["identifiant"];
    $password = $_GET["passwd"];
    
    $requete = "SELECT * FROM connexion3 WHERE identifiant = :identifiant";
    $req = $bdd->prepare($requete);
    $req->bindParam(':identifiant', $identifiant);
    $req->execute();

    $count = $req->rowCount();
//--------------------------------compt
    $bdd = new PDO('mysql:host=localhost;dbname=game','user1','A!!Cud!PgDyA)OsG');
    $requete = "SELECT * FROM connexion3";
    $req = $bdd->prepare($requete);
    $req->execute();
    $compt = $req->rowCount();
//-------------------------------------

    if ($count<1){
        
        $bdd = new PDO('mysql:host=localhost;dbname=game','user1','A!!Cud!PgDyA)OsG');
        
        $color = ['blue','white','pink','red','black','orange'];

        $playerObject = new Player($compt+1, rand(0, 500), rand(0, 500), $identifiant);
        $playerObject->color = $color[rand(0,6)];
        //print_r($playerObject);
        $playerObject = serialize($playerObject);

        


        $requete = "INSERT INTO connexion3 (identifiant, password, PL1) VALUES(:identifiant, :password, :PL1)";

        $req = $bdd->prepare($requete);
        
        $req->bindParam(':identifiant', $identifiant);
        
        $req->bindParam(':password', $password);
        
        $req->bindParam(':PL1', $playerObject);
        
        $req->execute();
        

    }
    else {
        echo ("L'identifiant est déjà utilisez, veuillez en saisir un autre !");

    }

}
?>

<html>
    <body>
        <div class="split right">
            <div class ="centered">
                <form id="inscription" action="login.php" method="GET">
                    <h1>Inscription</h1>

                    <label for="identifiant"><b>Nom d'utilisateur</b></label>
                    <input type="text" id="identity" placeholder="Entrez votre nom d'utilisateur" name="identifiant" required>

                    <label for="identifiant"><b>Mot de passe</b></label>
                    <input type="password" id="passwd" placeholder="Entrez votre mot de passe" name="passwd" required>

                    <label><b>Confirmez votre mot de passe</b></label>
                    <input type="password" id="other_passwd" placeholder="Rentrez à nouveau votre mot de passe" name="other_passwd" required>
                    
                    <input type="submit" id='submit' value="S'INSCRIRE" >
                </form>
                </div>
        </div> 
    </body>
</html>


<?php
if(isset($_GET["identifiant"]) && !empty($_GET["identifiant"] && $_GET["passwd"]) && !empty($_GET["passwd"])){
    if ($count<1){
        while($sites = $req->fetch(PDO::FETCH_OBJ)){
            $rep = $sites->identifiant;
            print_r($rep);
        }
        //echo ("<br><hr><br>Vous êtes bien enregistré, veuillez vous connecter pour accédez à cotre compte : ");
        echo "<script type='text/javascript'>document.location.replace('login.php');</script>"; 
    }
}
?>









