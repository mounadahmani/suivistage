<?php
		session_start();
?>
		

<html>
	<head>
		<meta charset='utf-8' />
		<link rel='stylesheet' href='../css/style.css' />
		
		<title>afficher_entreprises</title>
			
	</head>

 	<body>
		<?php include'header.html'; ?>
		<div id="aff">
		
		<div id="afftable">
		
		<div id="retour"><a href="connexion_etu.php" />retour</a></div>
		<?php
		include '../bdd/bdd.php';
			
	 
		if(!isset($_SESSION['$et_code'])){
			 $e_nom='';
			 $e_prenom='';
			 $s_nom='';
			 $f_libelle='';
				 
				$connexion=new BDD('rechstage'); 

				if (isset($_SESSION['et_code'])){
					$et_code=$_SESSION['et_code'];
					//preparer le requete
					$requete="select e_code,e_nom,e_adresse1,e_adresse2,e_ville,e_cpostal,e_nom_correspondant,e_tel,e_mail,te_code
					from entreprise ;";
					$resultats=$connexion->select($requete);
					//on recupere la taille du tableau
					$max = count($resultats);
				
					//creation du tableau
					for ($i = 0; $i < $max; $i = $i + 1) {
						$ligne = $resultats[$i];
						
						echo "<div><div><table class='cadreaff'><tr><td>",$ligne['e_nom'],"</td><td>",$ligne['e_code'],"</td></tr>
						<tr><td>Adresse 1 :</td><td>",$ligne['e_adresse1'],"</td></tr>
						<tr><td>Adresse 2 :</td><td>:",$ligne['e_adresse2'],"</td></tr>
						<tr><td>Ville :</td><td>",$ligne['e_ville'],"</td></tr>
						<tr><td> code postal :</td><td>",$ligne['e_cpostal']," </td></tr>
						<tr><td>nom correspondant : </td><td>",$ligne['e_nom_correspondant'],"</td></tr>
						<tr><td> téléphone: </td><td>",$ligne['e_tel'],"</td></tr>
						<tr><td>mail : </td><td>",$ligne['e_mail'],"</td></tr>
						<tr><td>type entreprise : </td><td>",$ligne['te_code'],"</td></tr></table></div>
						<div id='img'><a href='ajout_contact.php?e_code=",$i+1,"'><img src='../css/plus-sign.png' alt='modifier'/></a>
						<a href='affcontact.php?e_code=",$i+1,"''><img src='../css/fleche.png' alt='afficher'/></a></div></div>
						";
					}
				}
			}
			
			else {
				header("location: ../index.php");
			}
		?>
		</div>

		</div>
		
		<?php include'footer.html'; ?>
	</body>
</html>
	


	
	
	