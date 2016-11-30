<?php session_start();
if(! isset($_SESSION['$et_code'])){

    include '../bdd/bdd.php';
	// On n'effectue les traitement qu'à la condition que
	// les informations aient été effectivement postées
	$message = "";
	if (isset($_POST['login'])) {
		
		//verif saisie
		if (empty($_POST['login']) || empty($_POST['mdp'])) {
			$message = "Vous devez saisir le login et le mot de passe";
		} 
		else {	
			$connexion=new BDD('rechstage');
			$login=$_POST['login'];
			$mdp=$_POST['mdp'];
			
		
			$requete="select et_code,et_nom from etudiants where et_login='$login' and et_mdp='$mdp';";
			$ligne= $connexion->select($requete);
			//si juste, redirection vers affich entreprise
			if ($ligne != null){
				$message="Bienvenue ".$ligne[0]['et_nom'];
				$_SESSION['et_code']=$ligne[0]['et_code']; 

				header("location: affentreprise.php");
			}
			//sinon erreur
			else{
			$message="Vous devez vérifier votre login ou mot de passe !";
			
			}
		}
	}
}
else {
	//si déja connecté
	header("location: affentreprise.php");
}


?>
		

	
<html>
	<head>
		<meta charset='utf-8' />
		<link rel='stylesheet' href='../css/style.css' />
		
		<title>espace étudiants</title>
			
	</head>
	
	<body>

	<?php include'header.html'; ?>
		<section class="authen">
		<div id="retour"><a href="../index.php" />retour</a></div>
				<h1>Authentification</h1>
				<div class="form">
					<form name="identification" method="POST" action="connexion_etu.php" >
						<p>Login</p> <input name="login" type="text" id="login"/>
						<p>Mot de passe</p> <input name="mdp" type="password" id="mdp" />
						<p><input type="submit" id="bouton"/></p>
					</form>
				</div>
				<br/>
				<div id="message"> <?php echo $message ?></div>
		</section>

	<?php include'footer.html'; ?>
	
	            <script src="../jquery/jquery.js"></script>
            <script>
				$(document).ready(function(){
					 var $login = $('#login'),
						 $mdp = $('#mdp')
						 

				$login.keyup(function(){
				if($(this).val().length < 2){ // si la chaîne de caractères est inférieure à 2
					$(this).css({ // on rend le champ rouge
						borderColor : 'red',
					color : 'red'
					});
				 }
				 else{
					 $(this).css({ // si tout est bon, on le rend vert
					 borderColor : 'green',
					 color : 'green'
				 });
				 }
				});
				
				
				
});	
			
            </script>

</body>
</html>
