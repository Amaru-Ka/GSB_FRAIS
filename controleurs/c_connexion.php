<?php
if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeConnexion';
}
$action = $_GET['action'];
switch($action){
	// Dirige vers l'interface de connexion
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	// Dirige vers le controle de la connexion
	case 'valideConnexion':{
		$login = $_POST['login'];
		$mdp = $_POST['password'];
		// Appel de la methode getInfosVisiteur.
		// $visiteur est un tableau contenant les infos de l'utilisateur
		$visiteur = $pdo->getInfosVisiteur($login,$mdp);
		// Si $visiteur n'est pas un tableau, appel de la fonction ajouterErreur puis redirection vers v_erreurs puis v_connexion.
		if(!is_array( $visiteur)){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else{
			//Récup. des infos visiteurs
			$id = $visiteur['id'];
			$nom =  $visiteur['nom'];
			$prenom = $visiteur['prenom'];
			$idService = $visiteur['idService'];
			$libelleService = $pdo -> getLibelleService($idService);
			// Puis transfert dans $_SESSION
			connecter($id,$nom,$prenom);
			$_SESSION['libelleService'] = $libelleService['libelle_service'];

			$lesMenus = $pdo->getLesMenu($idService);
			$_SESSION['lesMenus'] = $lesMenus;
			?><div class="container-fluid page"><?php 
			include "vues/v_sommaire.php";
 			?></div><?php
		}
		break;
	}
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>
