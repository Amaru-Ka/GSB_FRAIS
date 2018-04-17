<div class="container  toutLesTableaux">
  <div class="span7">
		  <div class="widget stacked widget-table action-table listeMois">
			  <div class="widget-header">
				  <i class="icon-th-list"></i>
				  <h3>Valider mes fiche de frais</h3>
			  </div>
			  <div class="widget-content">
				  <table>
					<thead>
						<table class="table table-striped table-bordered">
	  					  <thead>
	  						  <form action="index.php?uc=etatFrais&action=voirEtatFrais" method="post">
	  						  <tr><td>Mois :</td>
	  							  <td>
	  								  <select name="lstMois">
	  								  <?php
	  								  /**
	  								   * Bouble foreach afin d'afficher tous les mois dans les options d'un <select>
	  								  */
	  								  foreach ($lesMois as $unMois){
	  									  $mois = $unMois['mois'];
	  									  $numAnnee =  $unMois['numAnnee'];
	  									  $numMois =  $unMois['numMois'];
	  									  if($mois == $moisASelectionner){
	  									  ?>
	  										  <option selected value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
	  									  <?php
	  									  }
	  									  else{ ?>
	  										  <option value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
	  									  <?php
	  									  }
	  								  }
	  								  ?>
	  							  </select>
	  						  </td>
	  						  <td>
	  								<button type="submit" name="valider" value="Ajouter" class="btn btn-block btn-success">Valider</button>
	  						  </td>
	  					  </tr>
	  				  	  </form>
	  					  </thead>
	  				  </table>
					</thead>
					<tbody>
