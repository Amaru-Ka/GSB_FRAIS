<div class="container-fluid page">
	<?php
	include 'vues/v_sommaire.php';
	?>
<div class="container tableSelection">
	<?php
	$action = $_GET['action'];
	switch ($action) {
		case 'selectionnerFiche':
			$lesMois = $pdo -> getLesMois(true);
			$lesMoisVA = $lesMois -> fetchAll(PDO::FETCH_ASSOC);
			include "vues/v_selectionnerFicheValide.php";
			if (isset($_POST['leMois'])) {
				$leMoisChoisi = $_POST['leMois'];
				$_SESSION['leMois'] = $leMoisChoisi;
				$IdVisiteur= $pdo -> getIdVisiteurFraisValide($leMoisChoisi);
				include "vues/v_selectionnerVisiteurFicheValide.php";
			}
			break;
		case "afficherFiche":
			$leMois = $_SESSION['leMois'];
			$idVisiteur = $_POST['choixVisiteur'];
			$_SESSION['idVisiteur'] = $idVisiteur;
			$nbJustificatifs = $pdo -> getNbjustificatifs($idVisiteur,$leMois);
			$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur,$leMois);
			$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
			include "vues/v_afficherFiche.php";
			break;
		case "mettreEnPaiement":
			$leMois = $_SESSION['leMois'];
			$idVisiteur = $_SESSION['idVisiteur'];
			$etat = "RB";
			$montantValide = $pdo-> getTotalFraisValide($idVisiteur,$leMois);
			$pdo -> majEtatFicheFrais($idVisiteur,$leMois,$etat,$montantValide);
			$lesMois = $pdo -> getLesMois(true);
			$lesMoisVA = $lesMois -> fetchAll(PDO::FETCH_ASSOC);
			include "vues/v_selectionnerFicheValide.php";
			break;
	}
	?>
</div>
</div>
