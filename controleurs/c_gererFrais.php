<div class="container-fluid page">

<?php
include "vues/v_sommaire.php";
$idVisiteur = $_SESSION['idVisiteur'];
$mois = getMois(date("d/m/Y"));
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);
$nomMois = "de " . getNomMois($numMois);
$action = $_GET['action'];
switch($action){
	case 'saisirFrais':{
		if($pdo->estPremierFraisMois($idVisiteur,$mois)){
			$pdo->creeNouvellesLignesFrais($idVisiteur,$mois);
		}
		break;
	}
	case 'validerMajFraisForfait':{
		$lesFrais = $_POST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
	  	 	$pdo->majFraisForfait($idVisiteur,$mois,$lesFrais);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include "vues/v_erreurs.php";
		}
	  break;
	}
	case 'validerCreationFrais':{
		$dateFrais = $_POST['dateFrais'];
		$libelle = $_POST['libelle'];
		$montant = $_POST['montant'];
		valideInfosFrais($dateFrais,$libelle,$montant);
		if (nbErreurs() != 0 ){
			include "vues/v_erreurs.php";
		}
		else{
			$pdo->creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$dateFrais,$montant);
		}
		break;
	}
	case 'supprimerFrais':{
		$idFrais = $_GET['idFrais'];
	    $pdo->supprimerFraisHorsForfait($idFrais);
		break;
	}
}
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$mois);
include "vues/v_listeFraisForfait.php" ;
include "vues/v_ajouterFrais.php";
include "vues/v_listeFraisHorsForfait.php" ;
?>
</div>
