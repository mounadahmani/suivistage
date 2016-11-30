<?php session_start();

if (isset($_SESSION['et_code'])) {
	include '../bdd/bdd.php';
	$message="";
	$connexion=new BDD('rechstage');
	$c_code = $_GET['c_code'];
	$et_code = $_SESSION['et_code'];
	//verification
	$requete="select et_code,e_code,date from contact where c_code=$c_code;";
	$tab=$connexion->select($requete);
	$lignereq=$tab[0];
	if ($lignereq!=''){
	
		$date=$lignereq['date'];
		$e_code=$lignereq['e_code'];
		
		//On verifie que l'étudiant qui modifie est le créateur du contact
		if($lignereq['et_code']!=$et_code){
			header("location: affcontact.php?e_code=$e_code&err=1");
		}
		else{
		//suppression
			$requete="DELETE FROM contact where c_code = $c_code;";
			$message=$connexion->exec($requete);
			header("location: affcontact.php?e_code=$e_code");
			}
	}
	else {
		$message="erreur";
	}
}
else {
	header ("location: ../index.php");
}
?>
<html>
	<head>
		<title> Suppression </title>
	</head>
	<body>
		<section>
		supression ...
		<div><?php echo $message ?></div>
		</section>
	</body>
</html>
	
	