<?php


class Ressource{
	public int $lvl;
	public int $upgradeCost_Ind;
	public int $upgradeCost_Ene;
	public int $production;
	public int $indale;
	
	public function __construct(int $indale){
		$this->lvl = 1;
		$this->indale = $indale;
		if ($indale == 0){//industrie
			$this->upgradeCost_Ind = 400;
			$this->upgradeCost_Ene = 20;
			$this->production = 5;
		}
		else{//energie
			$this->upgradeCost_Ind = 40;
			$this->upgradeCost_Ene = 400;
			$this->production = 7;
		}
	}
	private function upgrade(){
		$this->lvl += 1;
		$this->upgradeCost_Ind *= 2;
		$this->upgradeCost_Ene *= 2;
		$this->production *= 2;
	}
	function askUpgrade(int $indus, int $energ){
		if ($indus >= $this->upgradeCost_Ind && $energ >= $this->upgradeCost_Ene){
			$this->upgrade();
			return 1;
		}
		return 0;
	}
}

class Building{
	public int $health;
	public string $id;
	public int $status;
	public int $force;
	public int $capacity;
	public int $attacking;

	public function __construct(string $id, int $health){
		$this->health = $health;
		$this->id = $id;
		$this->status = 1;
		$this->force = 0;
		$this->capacity = 0;
		$this->attacking = 0;
	}
	function setForce(int $n){
		$this->force = $n;
	}
	function takeDamage(int $n){
		if ($this->status == 0)
			return 1;
		$this->health -= $n;
		if ($this->health <= 0){
			$this->status = 0;
		}
		//var_dump($this->health);
		return 0;
	}

	function attack(Building $target){
		$target->takeDamage($this->force);
		if ($target->status == 0){
			echo "The $this->id has destroyed $target->id.<br>";
		}
		else{
			echo "The $this->id has attacked $target->id for $this->force damage.<br>The $target->id has $target->health hp remaining.<br>";
		}
	}
}


class Player{
    public int $id;
    public int $x;
    public int $y;
    public string $nametag;
    public string $color;
    public int $industry;
    public int $energy;
	public int $score;

	public int $indpt;
	public int $enept;
	
    public array $ressources;
    public int $nbRessources;
    public array $buildings;
    public int $nbBuildings;
	
    public function __construct(int $id, int $x, int $y, string $nametag){
	    $this->id = $id;
        $this->x = $x;
	    $this->y = $y;
        $this->nametag = $nametag;
        $this->color = "";
        $this->industry = 500;
        $this->energy = 200;
        $this->score = 0;

		$this->indpt = 0;
		$this->enept = 0;

        $this->ressources = [];
        $this->nbRessources = 0;
        $this->buildings = [];
		$this->nbBuildings = 0;
        }
	
	function updateRPT(){
		$this->indpt = 0;
		$this->enept = 0;
		for ($i = 0; $i < $this->nbRessources; $i++){
			if ($this->ressources[$i]->indale == 0){
				$this->indpt += $this->ressources[$i]->production;
			}
			else{
				$this->enept += $this->ressources[$i]->production;
			}
		}
	}

	function getIndustry(){
		if ($this->industry >= 200 && $this->energy>= 10){
			array_push($this->ressources, new Ressource(0));
			$this->industry-=200;
			$this->score+=200;
			$this->energy-=10;
			$this->nbRessources += 1;
			$this->updateRPT();
			return 0; //chems
		}
		else{
			//echo "Insuffisent ressources.<br>";
			return 1; //chems
		}	
	}

	function getEnergy(){
		if ($this->industry >= 20 && $this->energy>=200){
			array_push($this->ressources, new Ressource(1));
			$this->industry-=20;
			$this->energy -= 200;
			$this->nbRessources += 1;
			$this->updateRPT();
			return 0; //chems
		}
		else{
			//echo "Insuffisent ressources.<br>";
			return 1; //chems
		}
	}
	
	function getTroop(int $ol){
			if ($ol == 0){
				$this->industry-=15;
				$this->energy-=2;
				array_push($this->buildings, new Building("Canon", 7));
				$this->buildings[$this->nbBuildings]->setForce(7);
				$this->buildings[$this->nbBuildings]->capacity = 0;
				$this->nbBuildings+=1;
			}
			else if ($ol == 1){
				$this->industry-=10;
				array_push($this->buildings, new Building("Offensive", 5));
				$this->buildings[$this->nbBuildings]->setForce(5);
				$this->buildings[$this->nbBuildings]->capacity = 0;
				$this->nbBuildings+=1;
			}
			else if ($ol == 2){
				$this->industry-=10;
				array_push($this->buildings, new Building("Logistique", 5));
				$this->buildings[$this->nbBuildings]->capacity = 50;
				$this->nbBuildings+=1;
			}
			else{
				echo "autre";
			}
	}
	

	function prepareAttack(Player $pl, array $Troops){
		//return -> [attack sum ; health sum; stockage capacity]
		
		$Ts = [0, 0, 0];
		for ($i = 0; $i<count($Troops); $i++){
			$Ts[0] += $pl->buildings[$Troops[$i]]->force;
			$Ts[1] += $pl->buildings[$Troops[$i]]->health;
			$Ts[2] += $pl->buildings[$Troops[$i]]->capacity;
		}
		return $Ts;
	}

	function tradeAttack(array $Ts, array $Troops, Player $Target){
		//Selection of Defending troops
		
		$TsT = [0, 0, 0];
		$TroopsT = [];
		
		for ($i = 0; $i < $Target->nbBuildings; $i++){
			if (!$Target->buildings[$i]->attacking && $Target->buildings[$i]->health > 0){
				array_push($TroopsT, $i);
			}
		}
		// echo "TroopsT: ";
		// print_r($TroopsT);
		// echo "<br>";
		$TsT = $this->prepareAttack($Target, $TroopsT);
		//Attacking Troops taking damage
		
		$i = 0;
		// echo "TsT: ";
		// print_r($TsT);
		// echo "<br>Ts: ";
		// print_r($Ts);
		// echo "<br>";
		while ($i<count($Troops) && $Ts[1]>0 && $TsT[0]>0){
			if($TsT[0] > $this->buildings[$Troops[$i]]->health){
				$TsT[0] -= $this->buildings[$Troops[$i]]->health;
				$this->buildings[$Troops[$i]]->health = 0;
				$i++;
				// echo "dead. remaining: ";
				// print_r($TsT);
				// echo "<br>";
			}
			else{
				$this->buildings[$Troops[$i]]->health -= $TsT[0];
				$TsT[0] = 0;
			}
		}
		//Defending Troops taking damage
		$y = 0;
		while ($y<count($TroopsT) && $TsT[1]>0 && $Ts[0]>0){
			if($Ts[0] >= $Target->buildings[$TroopsT[$y]]->health){
				$Ts[0] -= $Target->buildings[$TroopsT[$y]]->health;
				$Target->buildings[$TroopsT[$y]]->health = 0;
				$y++;
			}
			else {
				$Target->buildings[$TroopsT[$y]]->health -= $Ts[0];
				$Ts[0] = 0;
			}
		}
		 /**/
			$a = $Ts[0]; //sum attack attacker //chems
			$b = $Ts[1]; //sum health attacker //chems
			$c = $TsT[0]; //chems
			$d = $TsT[1]; //chems
			$list = [$a, $b, $c, $d]; //chems
		return $list; //chems
		
	}	

	function upgradeRsc(int $n){
		if ($n>=$this->nbRessources){
			return 0;
		}
		if($n < count($this->ressources) && $this->ressources[$n]->askUpgrade($this->industry, $this->energy)){
				$this->industry -= $this->ressources[$n]->upgradeCost_Ind/2;
				$this->energy -= $this->ressources[$n]->upgradeCost_Ene/2;
				$this->updateRPT();
		}
		else
			echo "Insuffisent ressources.<br>";
	}

	function displayRPT(){
		echo "Current industry/t: $this->indpt<br>Current energy/t: $this->enept<br><br>";
	}

	function upgradeType(int $n, int $rscType){
		for ($i = 0; $i<count($this->ressources); $i++){
			if ($this->ressources[$i]->indale == $rscType && $n <= 0){
				$this->upgradeRSC($i);
				return;
			}
			else if ($this->ressources[$i]->indale == $rscType){
				$n--;
			}
		}
	}
}


?>
