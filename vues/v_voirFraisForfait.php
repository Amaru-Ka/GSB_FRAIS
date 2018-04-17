<br>
<div class="span7 col-md-12 col-lg-12 col-sm-12 content">
	<div class="widget stacked widget-table action-table">
		<div class="widget-header">
			<i class="icon-th-list"></i>
			<h3>Récapitulatif des frais</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<table class="table table-striped table-bordered">
					<tbody>
						<td>
							<div class="span7 col-md-12 col-lg-12 col-sm-12 content">
								<div class="widget stacked widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Récapitulatif des frais forfaitisés</h3>
									</div> <!-- /widget-header -->
									<div class="widget-content">
										<table class="table table-striped table-bordered">
												<tbody>
													<td>
														<?php
														foreach ( $lesFraisForfait as $unFraisForfait ){
														   $quantite = $unFraisForfait['quantite'];
														   $libelle = $unFraisForfait['libelle'];
														   $retourEcran = "<tr><td>".$libelle."</td>";
														   $retourEcran .= "<td>".$quantite."</td></tr>";
														   echo $retourEcran;
													   }
													   ?>
													</td>
											</tbody>
									</table>
								</div> <!-- /widget-content -->
							</div> <!-- /widget -->
							</div>
						</td>
