<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container login">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="form-login">
            	<h4>Connexion au portail utilisateur</h4>
				<form action="index.php?uc=connexion&action=valideConnexion" method="POST">
	            	<input type="text" name="login" id="userName" class="form-control input-sm chat-input" placeholder="Login" />
	            		</br>
	            	<input type="password" name="password" id="userPassword" class="form-control input-sm chat-input" placeholder="Mot de passe" />
	            		</br>
	            	<div class="wrapper">
		            	<span class="group-btn">
							<button type="submit" class="btn btn-primary btn-md btn-login"  name="valider">Connexion  <i class="fa fa-sign-in"></i></button>
		            	</span>
	            	</div>
				</form>
			</div>
        </div>
    </div>
</div>
