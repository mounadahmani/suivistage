<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8" />
		 <link rel="stylesheet" href='../css/style.css' />
		 <title>ajoutentreprise</title>

	</head>
	<body>
		
		<?php
	//session_start();
	if( isset($_SESSION['$et_code'])){
		header("location: ../index.php");
	}
	else{
include '../bdd/bdd.php';
$connexion = new BDD('rechstage');
$message="";

if ((isset($_POST['nom']))) {	 
    $nom = $_POST['nom'];
    $adr1 = $_POST['adr1'];
	$adr2 = $_POST['adr2'];
	$ville = $_POST['ville'];
	$cpostal = $_POST['cpostal'];
	$nomcorr = $_POST['nomcorr'];
	$tel = $_POST['tel'];
    $mail = $_POST['mail'];
	$te_code=$_POST['te_code'];
		if(strlen($nom) < 1 || strlen($adr1)<1 || strlen($ville)<1 || strlen($cpostal)<1 || strlen($nomcorr)<1 || strlen($tel)<1|| strlen($mail)<=8) {
				$message= "Erreur ! Valeur incorrecte ! ";
				
			}
	
	if ($message==""){
				$message=" Félicitation ! Vous êtes bien inscrit ";

		$nom = $_POST['nom'];
		$adr1 = $_POST['adr1'];
		$adr2 = $_POST['adr2'];
		$ville = $_POST['ville'];
		$cpostal = $_POST['cpostal'];
		$nomcorr = $_POST['nomcorr'];
		$tel = $_POST['tel'];
		$mail = $_POST['mail'];
		$te_code=$_POST['te_code'];
		   
		$requete = "insert into entreprise (e_nom,e_adresse1,e_adresse2,e_ville,e_cpostal,e_nom_correspondant,e_tel,e_mail,te_code) values('$nom','$adr1','$adr2','$ville','$cpostal','$nomcorr','$tel','$mail',$te_code);";
		$resultats = $connexion->insert($requete);
    // permet d'inserer une ligne

    
		echo $resultats;
	}
       
}

	}  
?>
		
	<?php include'header.html'; ?>

<section id="ajent">
	
<div id="retour"><a href="affentreprise.php" />retour</a></div>
	<form method="post" action="ajoutentreprise.php"> 
		
			 <form id="myForm" method="post">

           <h2>Ajouter une entreprise :</h2><br/>

            <label class="form_col" for="nom">Nom :</label>
            <input name="nom" id="nom" type="text"  />
            <span class="tooltip" id="tooltipnom">Un nom ne peut pas faire être vide</span>
            <br /><br />

            <label class="form_col" for="adr1">Adresse 1 :</label>
            <input name="adr1" id="adr1" type="text" />
			<span class="tooltip" id="tooltipadr1">L'adresse ne peut pas être vide</span>
            <br /><br />
			
			
			<label class="form_col" for="adr2">Adresse 2 :</label>
            <input name="adr2" id="adr2" type="text" />
           
            <br /><br />
			
			<label class="form_col" for="ville">Ville :</label>
            <input name="ville" id="ville" type="text" />
            <span class="tooltip" id="tooltipville">Une ville ne peut pas être vide</span>
            <br /><br />
			
			<label class="form_col" for="cpostal">Code postal :</label>
            <input name="cpostal" id="cpostal" type="text" />
            <span class="tooltip" id="tooltipcpostal">Un code postal ne peut pas être vide</span>
            <br /><br />
			
			<label class="form_col" for="nomcorr">nom correspondant :</label>
            <input name="nomcorr" id="nomcorr" type="text" />
            <span class="tooltip" id="tooltipnomcorr">Un nom ne peut pas faire être vide</span>
            <br /><br />
			
			<label class="form_col" for="tel">tel :</label>
            <input name="tel" id="tel" type="text" />
            <span class="tooltip" id="tooltiptel">Un numéro de téléphone ne peut pas être vide</span>
            <br /><br />
			
			<label class="form_col" for="mail">Mail :</label>
            <input name="mail" id="mail" type="text" />
			 <span class="tooltip" id="tooltipmail">Un mail ne peut pas être vide</span>

           
            <br /><br />
			
			<label class="form_col" for="te_code">type entreprise :</label>
			
			
			
			<?php
				$requete = "select te_code,te_libelle from type_entreprise";
				$tab = $connexion->select($requete);
				
				$max=count($tab);
				
				echo '<select name="te_code" id="te_code">';
				for ($i = 0; $i < $max; $i = $i + 1) {
				$ligne = $tab[$i];
                echo "<option value=".$ligne['te_code'].">";
				
                echo $ligne['te_libelle'];
               echo "</option>";
				}
				echo "</select>"
				
				?>
				
            <br /><br />
			
			<span class="form_col"></span><span id="message">
            <input type="submit" value="M'inscrire" /> <input type="reset" value="Réinitialiser le formulaire" />
			
        </form>
				<span id="message"><?php echo $message; ?></span>

		<script>
		
          /*  function validForm() {
			var cdret = false;
                
                //validation du nom
                var tooltipnom = document.getElementById('tooltipnom');
                var nom = document.getElementById("nom");
                if (nom.value.length >= 1) {
                    nom.className = 'correct';
                    tooltipnom.style.display = 'none';
                } else {
                    nom.className = 'incorrect';
                    tooltipnom.style.display = 'inline-block';
					cdret = false;
					
                }
                //validation du adr1
                var tooltipadr1 = document.getElementById('tooltipadr1');
                var adr1 = document.getElementById("adr1");
                if (adr1.value.length >= 1) {
                    adr1.className = 'correct';
                    tooltipadr1.style.display = 'none';
                } else {
                    adr1.className = 'incorrect';
                    tooltipadr1.style.display = 'inline-block';
					cdret = false;
                }
				
				//validation du ville
				var tooltipville = document.getElementById('tooltipville');
                var ville = document.getElementById("ville");
                if (ville.value.length >= 1) {
                    ville.className = 'correct';
                    tooltipville.style.display = 'none';
                } else {
                    ville.className = 'incorrect';
                    tooltipville.style.display = 'inline-block';
					cdret = false;
                }
				//validation du code postal
				var tooltipcpostal = document.getElementById('tooltipcpostal');
                var cpostal = document.getElementById("cpostal");
                if (cpostal.value.length >= 1) {
                    cpostal.className = 'correct';
                    tooltipcpostal.style.display = 'none';
                } else {
                    cpostal.className = 'incorrect';
                    tooltipcpostal.style.display = 'inline-block';
					cdret = false;
                }
				//validation du nom correspondant
				var tooltipnomcorr = document.getElementById('tooltipnomcorr');
                var nomcorr = document.getElementById("nomcorr");
                if (nomcorr.value.length >= 1) {
                    nomcorr.className = 'correct';
                    tooltipnomcorr.style.display = 'none';
                } else {
                    nomcorr.className = 'incorrect';
                    tooltipnomcorr.style.display = 'inline-block';
					cdret = false;
                }
				//validation du tel
				var tooltiptel = document.getElementById('tooltiptel');
                var tel = document.getElementById("tel");
                if (tel.value.length >= 1) {
                    tel.className = 'correct';
                    tooltiptel.style.display = 'none';
                } else {
                    tel.className = 'incorrect';
                    tooltiptel.style.display = 'inline-block';
					cdret = false;
                }
				//validation du nom correspondant
				var tooltipmail = document.getElementById('tooltipmail');
                var mail = document.getElementById("mail");
                if (mail.value.length >= 1) {
                    mail.className = 'correct';
                    tooltipmail.style.display = 'none';
                } else {
                    mail.className = 'incorrect';
                    tooltipmail.style.display = 'inline-block';
					cdret = false;
                }
				if(cdret){
			
					
					  
           

				}
			}*/
			</script>
              
</section>			
	<?php include'footer.html'; ?>

</body>
</html>