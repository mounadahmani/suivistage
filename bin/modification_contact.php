<?php session_start();
			include '../bdd/bdd.php';
			$connexion=new BDD('rechstage');
			if(!isset($_SESSION['et_code'])){
				header("location: ../index.php");
			}
			
			$et_code=$_SESSION['et_code'];
			$c_code=$_GET['c_code'];
			
			//premier passage - Affichage
			if(!isset($_POST['input_date'])){
				//récupération des données nécéssaire a la completion: Infos contact
				$requete="select et_code,e_code,date,description_du_contact from contact where c_code=$c_code;"; 
				$tab=$connexion->select($requete);
				$lignereq=$tab[0];
				
				$date=$lignereq['date'];
				$e_code=$lignereq['e_code'];
				$desc=$lignereq['description_du_contact'];
				
				
				//On verifie que l'étudiant qui modifie est le créateur du contact
				if($lignereq['et_code']!=$et_code){
					header("location: affcontact.php?err=1&e_code=$e_code");
				}
				
				//récupération des données nécéssaire a la completion: Nom etudiant
				$requete="select et_nom,et_prenom from etudiants where et_code=$et_code;";
				$tab=$connexion->select($requete);
				$lignereq=$tab[0];
				
				$et_nom=$lignereq['et_nom']; 
				$et_prenom=$lignereq['et_prenom']; 
				
				//récupération des données nécéssaires a la complétion: Entreprise
				$requete="select e_nom from entreprise where e_code=$e_code;";
				$tab=$connexion->select($requete);
				$lignereq=$tab[0];
				
				$e_nom=$lignereq['e_nom'];
				
				
			}
			//Requete de modification
			else{
				$e_code=$_POST['e_code'];
				
				$requete="select e_nom from entreprise where e_code=$e_code;";
				$tab=$connexion->select($requete);
				$lignereq=$tab[0];
				
				$e_nom=$lignereq['e_nom'];
				
				$requete="select et_nom,et_prenom from etudiants where et_code=$et_code;";
				$tab=$connexion->select($requete);
				$lignereq=$tab[0];
				
				$et_nom=$lignereq['et_nom']; 
				$et_prenom=$lignereq['et_prenom']; 
				
				$date=$_POST['input_date'];
				$desc=$_POST['input_description'];
				$c_code=$_POST['c_code'];
				
				$requete="update contact set date='$date', description_du_contact='$desc' where c_code=$c_code;";
				$message=$connexion->insert($requete);
				echo $message;
			}
			
?>
<html>
	<head>
		<meta charset='utf-8' />
		<link rel='stylesheet' href='../css/style.css' />
			
	</head>
	
	<body>
	<?php include'header.html'; ?>
	
	<section id="ajent">
	
<div id="retour"><a href="affcontact.php" />retour</a></div>
        <form method="post" action="modification_contact.php" >
			<h2>Modifier un contact :</h2>
			<div>
				<!-- input hidden pour recup des données avec passage par post -->
				<input type="hidden" name="e_code" value="<?php echo $e_code ?>">
				<input type="hidden" name="c_code" value="<?php echo $c_code ?>">
				<p>Ajouté par <span id="donneeNONmodif"> <?php echo $et_prenom." ".$et_nom; ?></span> </p>
				<p>Nom de l'entreprise : <span id="donneeNONmodif"><?php echo $e_nom; ?> </span></p>
				<p>Date de prise de contact <input type="text" name="input_date" value="<?php echo $date; ?>"/> <span id="cmntrdate">  (yyyy-mm-dd) </span></p>
				<p>Description du contact  </p>
				<p><textarea type="text" name="input_description" value="<?php echo $desc; ?>"/></textarea> </p>
				
				</div>
					
			<div>
				<p><input type="submit" id="bouton"  value="Ajouter" method="post"/></p>
			</div>
		</form>
	</section>
		
	<?php include'footer.html'; ?>
