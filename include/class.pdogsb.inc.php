<?php
/**
 * Classe d'accès aux données.

 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO
 * $monPdoGsb qui contiendra l'unique instance de la classe

 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsb_appli_frais';
      	private static $user='GSB' ;
      	private static $mdp='GSB' ;
		private static $monPdo;
		private static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp);
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function __destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 *
 * @return Objet_PDO l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;
	}
/**
 * Retourne les mois qui font l'objet de fiche de frais.

 * Effectue une requete SQL qui recherche tous les mois de la table ficheFrais
 * @param Booleen optionnel: si etat et vrai nous affinons la recherche sur l'etat des fiches de frais
 * @return Tableau_String contenant les mois
*/
	public function getLesMois($etat = false){
		$req = "";
		if ($etat == true){
			$req = "SELECT DISTINCT mois
					FROM ficheFrais
					WHERE idEtat='VA'
					ORDER BY mois";
		}else {
			$req = "SELECT DISTINCT mois
					FROM ficheFrais
					ORDER BY mois";
		}
		$rs = PdoGsb::$monPdo -> query($req);
		//$tableau = $rs -> setFetchMode(PDO::FETCH_ASSOC);
		return $rs/*$tableau*/;
	}

/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
 * concernées par les deux arguments

 * La boucle foreach ne peut être utilisée ici car on procède
 * à une modification de la structure itérée - transformation du champ date-
 * @param String idVisiteur
 * @param String mois sous la forme aaaamm

 * @return Tableau avec tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif
*/
	public function getLesFraisHorsForfait($idVisiteur,$mois){
		$req = "SELECT *
				FROM lignefraishorsforfait
				WHERE idvisiteur ='$idVisiteur'
				AND mois = '$mois' ";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i=0; $i<$nbLignes; $i++){
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes;
	}
/**
 * Retourne le nombre de justificatif d'un visiteur pour un mois donné

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @return le nombre entier de justificatifs
*/
	public function getNbjustificatifs($idVisiteur, $mois){
		$req = "SELECT fichefrais.nbjustificatifs AS nb
				FROM  fichefrais
				WHERE fichefrais.idvisiteur ='$idVisiteur'
				AND fichefrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne['nb'];
	}
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments

 * @param String idVisiteur
 * @param String mois sous la forme aaaamm

 * @return Tableau associatif comportant l'id, le libelle et la quantité sous la forme d'un tableau associatif
*/
	public function getLesFraisForfait($idVisiteur, $mois){
			$req = "SELECT id AS idfrais, libelle, quantite
					FROM lignefraisforfait INNER JOIN fraisforfait
					ON id = idfraisforfait
					WHERE idvisiteur ='$idVisiteur'
					AND mois='$mois'
					ORDER BY idfraisforfait";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

/**
 * Retourne tous les id de la table FraisForfait

 * @return un tableau associatif
*/
	public function getLesIdFrais(){
		$req = "SELECT fraisforfait.id AS idfrais FROM fraisforfait ORDER BY fraisforfait.id";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
/**
 * Met à jour la table ligneFraisForfait

 * Met à jour la table ligneFraisForfait pour un visiteur et
 * un mois donné en enregistrant les nouveaux montants

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
 * @return un tableau associatif
*/
	public function majFraisForfait($idVisiteur, $mois, $lesFrais){
		$lesCles = array_keys($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "UPDATE lignefraisforfait
					SET lignefraisforfait.quantite = $qte
					WHERE lignefraisforfait.idvisiteur = '$idVisiteur'
					AND lignefraisforfait.mois = '$mois'
					AND lignefraisforfait.idfraisforfait = '$unIdFrais'";
			PdoGsb::$monPdo->exec($req);
		}

	}

	/**
	 * Met à jour la table ligneFraisHorsForfait

	 * Met à jour la table ligneFraisHorsForfait pour un visiteur et
	 * un mois donné en enregistrant les nouveaux montants

	 * @param $idVisiteur
	 * @param $mois sous la forme aaaamm
	 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
	 * @return un tableau associatif
	*/
		public function majFraisHorsForfait($idVisiteur,$mois){
			$req = "UPDATE lignefraishorsforfait
					SET etatFraisHF = 'VA'
					WHERE idvisiteur = '$idVisiteur'
					AND mois = '$mois'";
			PdoGsb::$monPdo->exec($req);
		}

/**
 * met à jour le nombre de justificatifs de la table ficheFrais
 * pour le mois et le visiteur concerné

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
*/
	public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs){
		$req = "UPDATE fichefrais
				SET nbjustificatifs = $nbJustificatifs
				WHERE fichefrais.idvisiteur = '$idVisiteur'
				AND fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux
*/
	public function estPremierFraisMois($idVisiteur,$mois)
	{
		$ok = false;
		$req = "SELECT COUNT(*) AS nblignesfrais
				FROM fichefrais
				WHERE fichefrais.mois = '$mois'
				AND fichefrais.idvisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		if($laLigne['nblignesfrais'] == 0){
			$ok = true;
		}
		return $ok;
	}
/**
 * Retourne le dernier mois en cours d'un visiteur

 * @param $idVisiteur
 * @return le mois sous la forme aaaamm
*/
	public function dernierMoisSaisi($idVisiteur){
		$req = "SELECT MAX(mois) AS dernierMois
				FROM fichefrais
				WHERE fichefrais.idvisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}

/**
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés

 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles
 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idVisiteur,$mois){
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
		if($laDerniereFiche['idEtat']=='CR'){
				$this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL');

		}
		$req = "INSERT INTO fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat)
				VALUES('$idVisiteur','$mois',0,0,now(),'CR')";
		PdoGsb::$monPdo->exec($req);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$unIdFrais = $uneLigneIdFrais['idfrais'];
			$req = "INSERT INTO lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite)
					VALUES('$idVisiteur','$mois','$unIdFrais',0)";
			PdoGsb::$monPdo->exec($req);
		 }
	}
/**
 * Crée un nouveau frais hors forfait pour un visiteur un mois donné
 * à partir des informations fournies en paramètre

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$date,$montant){
		$dateFr = dateFrancaisVersAnglais($date);
		$req = "INSERT INTO lignefraishorsforfait
				VALUES(null,'$idVisiteur','$mois','$libelle','$dateFr','$montant',null)";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Supprime le frais hors forfait dont l'id est passé en argument

 * @param $idFrais
*/
	public function supprimerFraisHorsForfait($idFrais){
		$req = "DELETE
				FROM lignefraishorsforfait
				WHERE lignefraishorsforfait.id =$idFrais ";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Retourne les mois pour lesquel un visiteur a une fiche de frais

 * @param $idVisiteur
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant
*/
	public function getLesMoisDisponibles($idVisiteur){
		$req = "SELECT fichefrais.mois AS mois
				FROM  fichefrais
				WHERE fichefrais.idvisiteur ='$idVisiteur'
				ORDER BY fichefrais.mois DESC ";
		$res = PdoGsb::$monPdo->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		    "mois" => "$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch();
		}
		return $lesMois;
	}
	/**
	 *	Méthode qui retourne les noms des visiteurs qui ont saisi une fiche de frais
	 * @param Int optionnel indiquant le type de recherche.
	 * si mois != 0 la recherche se concentre sur idEtat et le mois passé en argument
	 * @return liste des noms sous la forme d'un tableau associatif
	*/
		public function getNomVisiteurFicheFrais($mois = 0){
			$req = "";
			if ($mois == 0) {
				$req = "SELECT DISTINCT nom, idVisiteur
						FROM visiteur INNER JOIN fichefrais
						ON id = idVisiteur";
			}else{
				$req = "SELECT DISTINCT nom, idVisiteur
				FROM fichefrais INNER JOIN visiteur
				ON idVisiteur = id
				WHERE idEtat = 'VA'
				AND mois = $mois ";
			}
			$rs = PdoGsb::$monPdo -> query($req);
			$retour = $rs -> fetchAll(PDO::FETCH_ASSOC);
			return $retour;
		}
	/**
	 * Retourne les informations d'un visiteur

	 * @param $login
	 * @param $mdp
	 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
	*/
		public function getInfosVisiteur($login, $mdp){
			$req = "SELECT visiteur.id AS id, visiteur.nom AS nom, visiteur.prenom AS prenom, visiteur.id_service AS idService
					FROM visiteur
					WHERE visiteur.login='$login'
					AND visiteur.mdp='$mdp'";
			$rs = PdoGsb::$monPdo->query($req);
			$ligne = $rs->fetch();
			return $ligne;
		}
	/**
	* Retourne le nom du service de l'utilisateur qui vient de se connecter.

	* @param $login
	* @return Le nom du service correspondant à l'utilisateur
	*/
		public function getLibelleService($idService){
			$req = "SELECT DISTINCT service.libelle_service AS libelle_service
					FROM service
					WHERE service.id_service='$idService' ";
			$rs = PdoGsb::$monPdo->query($req);
			$ligne = $rs->fetch();
			return $ligne;
		}
	/**
	 * Retourne les informations d'un visiteur

	 * @param $login
	 * @param $mdp
	 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
	*/
		public function getLesMenu($idService){
			$req = "SELECT *
					FROM menu
					WHERE idService ='$idService'";
			$rs = PdoGsb::$monPdo->query($req);
			$ligne = $rs->fetchAll(PDO::FETCH_ASSOC);
			return $ligne;
		}

/**
 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état
*/
	public function getLesInfosFicheFrais($idVisiteur,$mois){
		$req = "SELECT ficheFrais.idEtat AS idEtat, ficheFrais.dateModif AS dateModif, ficheFrais.nbJustificatifs AS nbJustificatifs,
				ficheFrais.montantValide AS montantValide, etat.libelle AS libEtat
				FROM  fichefrais
				INNER JOIN Etat
				ON ficheFrais.idEtat = Etat.id
				WHERE fichefrais.idvisiteur ='$idVisiteur'
				AND fichefrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}
/**
 * Modifie l'état, la date de modification et le montant validé d'une fiche de frais
 * Si le montant n'est pas connu, le montant sera mis à 0

 * Modifie le champ idEtat et met la date de modif à aujourd'hui
 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @param $etat sous la forme XX
 * @param $montantValide (optionnel)
 */

	public function majEtatFicheFrais($idVisiteur,$mois,$etat,$montantValide = 0){
		$req = "UPDATE ficheFrais
				SET idEtat = '$etat', dateModif = now(), montantValide = $montantValide
				WHERE fichefrais.idvisiteur ='$idVisiteur'
				AND fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Refuse la ligne de frais hors forfait dont l'id est passé en argument
 *
 * @param l'id d'une ligne de frais hors forfait
*/
	public function refuserFraisHorsForfait($idFrais){
		$req = "UPDATE `lignefraishorsforfait` SET `etatFraisHF`= 'RF' WHERE id = $idFrais";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Reporte au mois suivant une ligne de frais hors forfait
 * dont l'id du frais est passé en argument.
 * @param l'id d'une ligne de frais hors forfait
*/
	public function reporterFraisHorsForfait($idFrais){
		//Recup du mois de la ligne passsé en argument
		$req = "SELECT mois
				FROM lignefraishorsforfait
				WHERE id = $idFrais";
		$res = PdoGsb::$monPdo->query($req);
		$date = $res -> fetch();
		$ladate = $date['mois'];
		$anneeMois = intval($ladate);
		$annee = substr($anneeMois,0,4);
		$mois =  substr($anneeMois,4,2);
		$lemois = 0;
		//Passage d'une année à l'autre
		if ($mois == 12) {
			$annee++;
			$mois = 01;
			$lemois = $annee.$mois;
			$lemois = strval($lemois);
		}else{
			$anneeMois++;
			$anneeMois = $anneeMois;
			$anneeMois = strval($anneeMois);
		}
		//Maj de la db
		$req = "UPDATE lignefraishorsforfait
				SET mois = '$lemois'
				WHERE id = $idFrais";
		//Si le visiteur n'a pas encore fait de fiche frais pour le mois suivant, on crée une nouvelle fiche frais qu'on attribue à "CR"
		if(!PdoGsb::$monPdo->exec($req)){
			$maReq = "SELECT idVisiteur FROM lignefraishorsforfait WHERE id = $idFrais";
			$maRes = PdoGsb::$monPdo->query($maReq);
			$visiteur = $maRes -> fetch();
			$idVisiteur = $visiteur['idVisiteur'];
			$laDerniereReq = "INSERT INTO `fichefrais`(`idVisiteur`, `mois`, `nbJustificatifs`, `montantValide`, `dateModif`, `idEtat`)
							  VALUES ('$idVisiteur','$lemois',0,0,now(),'CR')";
			PdoGsb::$monPdo->exec($laDerniereReq);
			PdoGsb::$monPdo->exec($req);
		}
	}
/**
 * Calcule le total des frais forfait et hors forfait
 * pour un visiteur et un mois choisi

 * @param $idVisiteur
 * @param $mois sous la forme aaaamm
 * @return Float : qui vaut le total des frais
*/
	public function getTotalFraisValide($idVisiteur, $mois){
		$total = 0;
		$req = "SELECT id,montant
				FROM FraisForfait ";
		$res = PdoGsb::$monPdo->query($req);
		$ligne = $res -> fetchAll();
		foreach ($ligne as $key => $value) {
			$id = $value["id"];
			$montant = $value['montant'];
			$req = "SELECT quantite
					FROM ligneFraisForfait
					WHERE idFraisForfait = '$id'
					AND mois = '$mois'";
			$res = PdoGsb::$monPdo->query($req);
			$maVar = $res -> fetch();
			$quantite = $maVar['quantite'];
			$total += $montant * $quantite;
		}
		$req = "SELECT montant
				FROM lignefraishorsforfait
				WHERE idVisiteur = '$idVisiteur'
				AND mois = '$mois'
				AND etatFraisHF is NULL ";
		$res = PdoGsb::$monPdo->query($req);
		$ligne = $res -> fetchAll();
		foreach ($ligne as $value) {
			$montantHF = $value['montant'];
			$total += $montantHF;
		}
		return $total;
	}
	/**
	 * Retourne le nom et l'idVisiteur des fiches de frais qui sont à l'état CL
     * @param Int numéro du mois
	 * @return Tableau  associatif contenant l'idVisiteur et le mois
	*/
		public function getIdVisiteurFraisValide($mois){
			$req = "SELECT  nom,idVisiteur
					FROM fichefrais INNER JOIN visiteur
					ON idVisiteur = id
					WHERE idEtat = 'VA'
					AND mois = $mois";
			$res = PdoGsb::$monPdo->query($req);
			$retour = $res -> fetchAll(PDO::FETCH_ASSOC);
			return $retour;
		}
	// /**
	//  * Retourne le nom et l'idVisiteur des fiches de frais qui sont à l'état VA
    //  * @param Int numéro du mois
	//  * @return Tableau  associatif contenant l'idVisiteur et le mois
	// */
	// 	public function getLesInfosFicheFrais($idVisiteur,$mois){
	// 		$req = "SELECT idEtat, dateModif, nbJustificatifs, montantValide, libelle
	// 				FROM  fichefrais
	// 				INNER JOIN Etat
	// 				ON idEtat = id
	// 				WHERE idvisiteur ='$idVisiteur'
	// 				AND mois = '$mois'"
	// 				AND idEtat = 'VA';
	// 		$res = PdoGsb::$monPdo->query($req);
	// 		$laLigne = $res->fetch();
	// 		return $laLigne;
	// 	}
}

?>
