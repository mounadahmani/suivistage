<?php
		session_start();
?>

<html>
	<head>
		<meta charset='utf-8' />
		<link rel='stylesheet' href='../css/style.css' />
		
		<title>afficher_contacts</title>
			
	</head>

 	<body>
		<?php include'header.html'; ?>
		<div id="aff">
		<div id="afftable">
		<div id="retour"><a href="affentreprise.php" />retour</a></div>
		<?php
		include '../bdd/bdd.php';
			
		if(!isset($_SESSION['$et_code'])){
			 $e_nom='';
			 $e_prenom='';
			 $s_nom='';
			 $f_libelle='';
				 
			$connexion=new BDD('rechstage'); 
				//si connecté
				if (isset($_SESSION['et_code'])){
					$et_code=$_SESSION['et_code'];
					$e_code=$_GET['e_code'];
					
					if($_GET['err']==1){
						echo "Modification impossible: Vous n'êtes pas créateur de ce contact!";
					}
					//creation de la requete
					$requete="select contact.date,contact.description_du_contact,contact.c_code,etudiants.et_nom,etudiants.et_prenom,entreprise.e_nom
					from contact inner join etudiants
					on etudiants.et_code=contact.et_code
					inner join entreprise
					on entreprise.e_code=contact.e_code
					where contact.e_code=$e_code
					;";
					
					$resultats=$connexion->select($requete);
					//on recupere la taille du tableau
					$max = count($resultats);
					
					
					for ($i = 0; $i < $max; $i = $i + 1) {
						//creation du tableau
						$ligne = $resultats[$i];
						echo "<div><div><table class='cadreaff'><tr><td>",$ligne['et_nom'],"</td><td>",$ligne['et_prenom'],"</td></tr>
						<tr><td>nom de l'entreprise :</td><td>",$ligne['e_nom'],"</td></tr>
						<tr><td>date :</td><td>",$ligne['date'],"</td></tr>				
						<tr><td>description du contact</td><td>",$ligne['description_du_contact'],"</td></tr></table></div>
						<div id='img'><a href='modification_contact.php?c_code=",$ligne['c_code'],"'><img src='../css/modifier.png' alt='modifier'/></a>
						</div>
						";
					
					}

				}
		}
	//si pas co, retour a l'accueil
	else {
		header("location: ../index.php");
	}
	?>
	</div>

	</div>
	
	<?php include'footer.html'; ?>
</body>
</html>
	


	
	
	