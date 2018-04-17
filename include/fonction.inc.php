﻿<?php
/**
 * Fonctions pour l'application GSB
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 */

 /**
 * Teste si un quelconque visiteur est connecté
 * @return booleen à 1 quand est connecté
 */
function estConnecte(){
  return isset($_SESSION['idVisiteur']);
}
/**
 * Enregistre dans une variable session les infos d'un visiteur
 * @param String id
 * @param String nom
 * @param String prenom
 */
function connecter($id,$nom,$prenom){
	$_SESSION['idVisiteur']= $id;
	$_SESSION['nom']= $nom;
	$_SESSION['prenom']= $prenom;
}
/**
 * Détruit la session active
 */
function deconnecter(){
	session_destroy();
}
/**
 * Transforme une date au format français jj/mm/aaaa vers le format anglais aaaa-mm-jj
 * @param String date au format  jj/mm/aaaa
 * @return String date au format anglais aaaa-mm-jj
*/
function dateFrancaisVersAnglais($maDate){
	@list($jour,$mois,$annee) = explode('/',$maDate);
	return date('Y-m-d',mktime(0,0,0,$mois,$jour,$annee));
}
/**
 * Transforme le numéro de mois en nom de mois
 * @param Int numéro du mois
 * @return String nom du mois
*/
function getNomMois($numMois){
	$nomMois = "";
	switch ($numMois) {
		case '01':
			$nomMois = "janvier";
			break;
		case '02':
			$nomMois = "février";
			break;

		case '03':
			$nomMois = "mars";
			break;
		case '04':
			$nomMois = "avril";
			break;
		case '05':
			$nomMois = "mai";
			break;
		case '06':
			$nomMois = "juin";
			break;
		case '07':
			$nomMois = "juillet";
			break;
		case '08':
			$nomMois = "août";
			break;

		case '09':
			$nomMois = "septembre";
			break;
		case '10':
			$nomMois = "octobre";
			break;
		case '11':
			$nomMois = "novembre";
			break;
		case '12':
			$nomMois = "décenmbre";
			break;
	}
	return $nomMois;
}

/**
 * Transforme une date au format format anglais aaaa-mm-jj vers le format français jj/mm/aaaa
 * @param String date au format  aaaa-mm-jj
 * @return String date au format format français jj/mm/aaaa
*/
function dateAnglaisVersFrancais($maDate){
   @list($annee,$mois,$jour)=explode('-',$maDate);
   $date="$jour"."/".$mois."/".$annee;
   return $date;
}
/**
 * retourne le mois au format aaaamm selon le jour dans le mois
 * @param String date au format  jj/mm/aaaa
 * @return String date au format aaaamm
*/
function getMois($date){
		@list($jour,$mois,$annee) = explode('/',$date);
		if(strlen($mois) == 1){
			$mois = "0".$mois;
		}
		return $annee.$mois;
}

/* gestion des erreurs*/
/**
 * Indique si une valeur est un entier positif ou nul
 * @param Entier valeur
 * @return booleen
*/
function estEntierPositif($valeur) {
	return preg_match("/[^0-9]/", $valeur) == 0;
}

/**
 * Indique si un tableau de valeurs est constitué d'entiers positifs ou nuls
 * @param Tableau d'entiers
 * @return booleen
*/
function estTableauEntiers($tabEntiers) {
	$ok = true;
	foreach($tabEntiers as $unEntier){
		if(!estEntierPositif($unEntier)){
		 	$ok=false;
		}
	}
	return $ok;
}

/**
 * Vérifie si une date est inférieure d'un an à la date actuelle
 * @param String date
 * @return booleen
*/
function estDateDepassee($dateTestee){
	$dateActuelle=date("d/m/Y");
	@list($jour,$mois,$annee) = explode('/',$dateActuelle);
	$annee--;
	$AnPasse = $annee.$mois.$jour;
	@list($jourTeste,$moisTeste,$anneeTeste) = explode('/',$dateTestee);
	return ($anneeTeste.$moisTeste.$jourTeste < $AnPasse);
}
/**
 * Vérifie la validité du format d'une date française jj/mm/aaaa
 * @param String date
 * @return booleen
*/
function estDateValide($date){
	$tabDate = explode('/',$date);
	$dateOK = true;
	if (count($tabDate) != 3) {
	    $dateOK = false;
    }
    else {
		if (!estTableauEntiers($tabDate)) {
			$dateOK = false;
		}
		else {
			if (!checkdate($tabDate[1], $tabDate[0], $tabDate[2])) {
				$dateOK = false;
			}
		}
    }
	return $dateOK;
}

/**
 * Vérifie que le tableau de frais ne contient que des valeurs numériques
 * @param Tableau lesFrais
 * @return booleen
*/
function lesQteFraisValides($lesFrais){
	return estTableauEntiers($lesFrais);
}
/**
 * Vérifie la validité des trois arguments : la date, le libellé du frais et le montant
 * des message d'erreurs sont ajoutés au tableau des erreurs
 * @param String dateFrais
 * @param String libelle
 * @param Float montant
 */
function valideInfosFrais($dateFrais,$libelle,$montant){
	if($dateFrais==""){
		ajouterErreur("Le champ date ne doit pas être vide");
	}
	else{
		if(!estDatevalide($dateFrais)){
			ajouterErreur("Date invalide");
		}
		else{
			if(estDateDepassee($dateFrais)){
				ajouterErreur("date d'enregistrement du frais dépassé, plus de 1 an");
			}
		}
	}
	if($libelle == ""){
		ajouterErreur("Le champ description ne peut pas être vide");
	}
	if($montant == ""){
		ajouterErreur("Le champ montant ne peut pas être vide");
	}
	else
		if( !is_numeric($montant) ){
			ajouterErreur("Le champ montant doit être numérique");
		}
}
/**
 * Ajoute le libellé d'une erreur au tableau des erreurs

 * @param String msg qui est le libellé de l'erreur
 */
function ajouterErreur($msg){
   if (! isset($_REQUEST['erreurs'])){
      $_REQUEST['erreurs']=array();
	}
   $_REQUEST['erreurs'][]=$msg;
}
/**
 * Retoune le nombre de lignes du tableau des erreurs
 * @return Entier indiquant le nombre d'erreurs
 */
function nbErreurs(){
   if (!isset($_REQUEST['erreurs'])){
	   return 0;
	}
	else{
	   return count($_REQUEST['erreurs']);
	}
}
?>
