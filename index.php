<?php
include_once "vues/v_entete.php";
include_once "include/fonction.inc.php";
include_once "include/class.pdogsb.inc.php";
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if(!isset($_GET['uc']) || !$estConnecte){
    $_GET['uc'] = 'connexion';
}
$uc = $_GET['uc'];
switch($uc){
	case 'connexion':{
		include "controleurs/c_connexion.php";
		break;
	}
	case 'gererFrais' :{
		include "controleurs/c_gererFrais.php";
		break;
	}
	case 'etatFrais' :{
		include "controleurs/c_etatFrais.php";
		break;
	}
	case 'validerFrais':{
		include "controleurs/c_validerFrais.php";
		break;
	}
	case 'suiviPaiement':{
		include "controleurs/c_suivreFrais.php";
		break;
	}
}
include_once "vues/v_pied.php";
?>
