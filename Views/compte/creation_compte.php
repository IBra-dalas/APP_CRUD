<?php
$page_no_redirection = '1';

include ('../shared/header.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$login = 1;

if(isset($_POST['login'])){
	
	$url = "http://localhost/API_CRUD/front/setSession/'".$_POST['login']."'";
    $raw = file_get_contents($url);
    $json = json_decode($raw);
    if(!isset($json[0] -> id)){
		$login = 0;
	}
	if(empty($_POST['mdp']) ){
		$login = 2;
	}
	if(strlen($_POST['mdp']) > 30){
		$login = 3;
	}
	if(strlen($_POST['mdp']) < 7){
		$login = 4;
	}
	if(!isset($_POST['conditions'])){
		$login = 5;
	}
	if($_POST['mdp'] != $_POST['mdp2'] ){
		$login = 6;
	}
}
// req nouveau pré-compte
if(isset($_POST['login']) && $login == 0 ){
	
	$url = "http://localhost/API_CRUD/front/setSession/'".$_POST['login']."'/'".$_POST['mdp']."'";
    $raw = file_get_contents($url);

	echo "
		<div class='bloc_central'>
			<h3>Creation du compte reussi</h3>
			Votre a bien été creer, vous pouver donc vous connecté via ce bouton<br/><br/>
			<a href='connexion.php' class='connexion'>Connexion</a>
		</div>
	";
}

if(!isset($_POST['login']) || $login != 0 || !isset($_POST['conditions'])){

//---pass the data from a textarea input into an input type = text---
echo "
<script>
	function Pass_candidature(){
		document.getElementById('form_candidature').submit();
	}
</script>";
echo "	<div class='bloc_central_inscription'>
			<form method='post' charset='UTF-8' enctype='multipart/form-data' id='form_candidature' name='form_candidature' action='#'>

				<br/><div class='bienvenue' style='font-size:40px'>Account creation</div><br/>
				<br/><br/><br/><input type='text' name='login' placeholder='login' class='input_login_page crea_login'/><br/>
				<br/><input type='password' name='mdp' placeholder='Mot de passe' class='input_login_page crea_mdp1'/><br/>
				<br/><input type='password' name='mdp2' placeholder='Confirmation mot de passe' class='input_login_page crea_mdp2'/><br/>";

				//----simple passage de login à autre chose que 0 selon le pb-----
				if($login == 1 && isset($_POST['login'])){echo "<br/><div class='error'>Ce login est deja utilisé pour un autre compte</div>";}
				if($login == 2 && isset($_POST['login'])){echo "<br/><div class='error'>Veuiller rentrer un mot de passe</div>";}
				if($login == 3 && isset($_POST['login'])){echo "<br/><div class='error'>Votre mot de passe fait plus de 30 caracteres</div>";}
				if($login == 4 && isset($_POST['login'])){echo "<br/><div class='error'>Votre mot de passe fait moins de 7 caracteres</div>";}
				if($login == 5 && isset($_POST['login'])){echo "<br/><div class='error'>Veuiller cocher les conditions generale d'utilisation</div>";}
				if($login == 6 && isset($_POST['login'])){echo "<br/><div class='error'>Les deux mots de passe ne sont pas identiques</div>";}

echo "
				<br/>
				<label>
					<input type='checkbox' name='conditions'>
					<span></span>
				</label> J'accepte les 
				<a href='' target='_BLANK' class = 'link_green'> conditions générales d'utilisation</a>
				<br/>
				<br/><input type='button' value='Création de compte' name='creation_compte' class='link_white' onclick='Pass_candidature()'/><br/><br/>
			</form>
			<a href='index.php' class = 'link_green'>Return</a>
		</div>
";}

include ('../shared/footer.php');

?>
