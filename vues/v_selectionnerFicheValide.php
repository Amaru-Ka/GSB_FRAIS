<div class="span7 col-md-12 col-lg-12 col-sm-12 content">
	<div class="widget stacked widget-table action-table">
		<div class="widget-header">
			<i class="icon-th-list"></i>
			<h3>Fiches de frais mises en paiement</h3>
		</div>
		<div class="widget-content">
			<form action="index.php?uc=suiviPaiement&action=selectionnerFiche" method="post">
			<table class="table table-striped table-bordered">
					<thead>

					</thead>
					<tbody>
						<td>
							<div class="span7 col-md-12 col-lg-12 col-sm-12 content">
								<div class="widget stacked widget-table action-table listeMois">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Selection d'un mois</h3>
									</div>
									<div class="widget-content">
										<form action="index.php?uc=suiviPaiement&action=selectionnerFiche" method="post">
										<table class="table table-striped table-bordered">
												<thead>
													<td>Mois :</td>
													<td>
														<select name="leMois">
														<?php
															foreach ($lesMoisVA as $value) {
																$leMois = $value['mois'];
																$numAnnee =substr( $leMois,0,4);
																$numMois =substr( $leMois,4,2);
																$retourEcran = "<option value='".$leMois."'>".$numMois." / ".$numAnnee."</option>" ;
																echo $retourEcran;
															}
														?>
														</select>
													</td>
													<td><button type="submit" name="valider" class="btn btn-block btn-success" >Valider</button></td>
												</thead>
										</table>
									</form>
									</div>
								</div>
							</div>
						</td>
