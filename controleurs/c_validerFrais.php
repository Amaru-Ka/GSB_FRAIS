<div class="container-fluid page">
	<?php
	include 'vues/v_sommaire.php';
	?>
<div class="container tableSelection">


	<?php
	$action = $_GET['action'];
	switch ($action) {
		case 'selectionnerVisiteur':{
			$liste = $pdo -> getNomVisiteurFicheFrais();
			include 'vues/v_selectionnerVisiteur.php';

			if(isset($_POST['choixVisiteur'])){
			 	$visiteurChoisi = $_POST['choixVisiteur'];
				$_SESSION['idVisiteur'] = $visiteurChoisi;
				$lesMois = $pdo -> getLesMoisDisponibles($visiteurChoisi);
		 		include 'vues/v_selectionnerMois.php';
			}

			if (isset($_POST['choixMois'])){
				$leMois = $_POST['choixMois'];
				$_SESSION['leMois'] = $leMois;
				$idVisiteur = $_SESSION['idVisiteur'];
				$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
				$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
				//Formatage de la date
				$numAnnee =substr( $leMois,0,4);
				$numMois =substr( $leMois,4,2);
				$nomMois = "de " . getNomMois($numMois);
				$libEtat = $lesInfosFicheFrais['libEtat'];
				$montantValide = $lesInfosFicheFrais['montantValide'];
				$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
				$dateModif =  $lesInfosFicheFrais['dateModif'];
				$dateModif =  dateAnglaisVersFrancais($dateModif);
				include 'vues/v_validerListeFrais.php';
			}

			break;
		}
		case 'actualiserInfosFiche':{
				if (isset($_POST['lesFrais'])) {
					$fraisActualise = $_POST['lesFrais'];
					$idVisiteur = $_SESSION['idVisiteur'];
					$leMois = $_SESSION['leMois'];
					$pdo -> majFraisForfait($idVisiteur,$leMois, $fraisActualise);
					$pdo -> majFraisHorsForfait($idVisiteur,$leMois);
					$lesFraisForfait = $pdo -> getLesFraisForfait($idVisiteur,$leMois);
					$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
					$liste = $pdo -> getNomVisiteurFicheFrais();
					include 'vues/v_selectionnerVisiteur.php';
					include 'vues/v_voirFraisForfait.php';
					$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
					$nbJustificatifs = $pdo -> getNbjustificatifs($idVisiteur,$leMois);
					include 'vues/v_voirFraisHorsForfait.php';

				}
				else{
					ajouterErreur("Les valeurs des frais doivent être numériques");
					include("vues/v_erreurs.php");
				}
			break;
		}

		case 'refuserFraisHorsForfait':{
			$idFrais = $_GET['idFrais'];
			$idVisiteur = $_SESSION['idVisiteur'];
			$leMois = $_SESSION['leMois'];
			if(isset($_GET['reporterFrais'])){
				$pdo -> reporterFraisHorsForfait($idFrais);
			}else{
				$pdo->refuserFraisHorsForfait($idFrais);
			}
			$lesFraisForfait = $pdo -> getLesFraisForfait($idVisiteur,$leMois);
			$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
			$liste = $pdo -> getNomVisiteurFicheFrais();
			include 'vues/v_selectionnerVisiteur.php';
			include 'vues/v_voirFraisForfait.php';
			$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
			$nbJustificatifs = $pdo -> getNbjustificatifs($idVisiteur,$leMois);
			include 'vues/v_voirFraisHorsForfait.php';
			break;
		}
		case 'fraisValide':{
			$idVisiteur = $_SESSION['idVisiteur'];
			$leMois = $_SESSION['leMois'];
			$etat = "VA";
			$total = $pdo -> getTotalFraisValide($idVisiteur,$leMois);
			$pdo -> majEtatFicheFrais($idVisiteur,$leMois,$etat,$total);
			$pdo -> majFraisHorsForfait($idVisiteur,$leMois);
			$liste = $pdo -> getNomVisiteurFicheFrais();

			include 'vues/v_selectionnerVisiteur.php';
			break;
		}
	}
	 ?>
</div>
</div>
