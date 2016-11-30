<?php session_start();
			include '../bdd/bdd.php';
			$connexion=new BDD('rechstage');
			
			// si pas connecté, retour index
			if(!isset($_SESSION['et_code'])){
				header("location: ../index.php");
			}
			
			$message="";
			$et_code=$_SESSION['et_code'];
			//recuperation du nom/prenom de l'etudiant a partir du $_session
			$requete="select et_nom,et_prenom from etudiants where et_code='$et_code';";
			$tab=$connexion->select($requete);
			$lignereq=$tab[0];
			$et_nom=$lignereq['et_nom'];
			$et_prenom=$lignereq['et_prenom'];
			$e_code=$_GET['e_code'];
					
			if (isset($_SESSION['et_code'])){
				$input_date;
				$input_description;
				if(isset($_POST['input_date'])){
					$input_date=$_POST['input_date'];
					$input_description=$_POST['input_description'];
					//verification d'entree
					if (empty($_POST['input_date']) || empty($_POST['input_description'])) {
						$message = "Vous devez saisir une date et une description";
					}
					else{
					$requete="insert into contact(date,e_code,et_code,description_du_contact) values('$input_date',$e_code,$et_code,'$input_description')";
					$tab=$connexion->insert($requete);	
					}
				}
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
		
<div id="retour"><a href="affentreprise.php" />retour</a></div>
		<h1>Ajouter un contact</h1>
			<div class="form">
				<form method="post" action="ajout_contact.php?e_code=<?php echo $e_code; ?>" >
					<div>
						<p>Ajouté par <?php echo $et_prenom." ".$et_nom; ?> </p><!-- recuperation du nom de l'utilisateur connecté -->
						<p>Nom de l'entreprise:
						<?php 
							//recuperation du nom de l'entreprise
							$connexion=new BDD('rechstage');
							$requete="select e_nom from entreprise where e_code=$e_code";
							$tab=$connexion->select($requete);
							$result=$tab[0]['e_nom'];
							echo " $result";
						?>
						</p>
						
						<p>Date de prise de contact <input type="text" name="input_date" id="date" value="<?php $input_date; ?>"/><span id="cmntrdate">  (yyyy-mm-dd) </span></p> <!-- value=var date_contact -->
					
							
					
						<p>Description du contact </p> 
						<p><textarea cols="20" rows="3" type="text" name="input_description" value="<?php $input_description; ?>"/></textarea></p>  <!-- value var description contact -->
					</div>
							
					<div>
						<p><input type="submit" value="Ajouter" method="post" id="bouton"/></p>
					</div>
				</form>
			</div>
			
		<div id="message"> <?php echo $message ?></div>
		</section>
		
	            <script src="../jquery/jquery.js"></script>
            <script>
				$(document).ready(function(){
					 var $date = $('#date')
						 
					 
				
				
				// le code précédent se trouve ici

				$date.keyup(function(){
				if($(this).val().length < 10){ // si la chaîne de caractères est inférieure à 5
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
		
	<?php include'footer.html'; ?>

	</body>
</html>