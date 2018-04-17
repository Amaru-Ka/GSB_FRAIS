					<?php
						foreach($_REQUEST['erreurs'] as $erreur){
						      echo "<div class='container'><div class='row'><div class='span7 col-md-4 col-lg-4 col-sm-5'>
							  	  <div class='widget stacked widget-table action-table selectVisiteur'>
							  		  <div class='widget-header'>
							  			  <i class='icon-th-list'></i>
							  			  <h3>".$erreur."</h3>
							  		  </div>
							  		  <div class='widget-content'>
							  			</div> <!-- /widget-content -->
							  		</div> <!-- /widget -->
							  	</div></div></div>";
							}
					?>
