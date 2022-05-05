<?php
session_start();

if(!isset($_SESSION["login"])){
	$_SESSION["login"]=false;
}
if(!isset($_SESSION["error"])){
	$_SESSION["error"]=false;
}

if(!isset($_GET['id'])){
	$_GET['id']= null;
}

//system de connexion securisé
if($_SESSION["error"] == TRUE){
	session_regenerate_id(true);
}
if(session_id() != $_GET['id']){
	if($_SESSION["login"] == TRUE){
		session_destroy();
		header('Location: index.php');
		session_start();
		$_SESSION["error"] = TRUE;
	}else{
		if(!isset($page_no_redirection)){
			header('Location: index.php');
		}
	}
}else{
	$_SESSION["error"] = FALSE;
}
if(isset($bouton_deconnection)){
	session_destroy();
	header('Location: index.php');
	session_start();
	$_SESSION["error"] = TRUE;
}
if($_SESSION["login"] == FALSE){
	if($_GET['id'] != null){
		header('Location: index.php');
	}
}

//id utiliser pour le system de connexion
$sess = session_id();

echo "
<!DOCTYPE HTML>
<html>
	<head>
		<title>CRUD PRODUIT BDD VIA API</title>
		<meta name='viewport' content='width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0'>
		<link rel='stylesheet' href='http://localhost//APP_CRUD/Views/shared/styles_new.css' type='text/css' media='screen' />
	</head>
	<body>
		<div id='root'>
			<div id='topnav' class='topnav'>";
				if ($_SESSION["login"] == "true"){
					echo"<style>#topnav_menu {margin-left: calc(100% - 235px);margin-top: 4px;}</style>
			    	<nav role='navigation' id='topnav_menu' class='button_header'>
			    	    <a id='home_link' class='home' href='http://localhost/APP_CRUD/index.php?id=".$sess."'>Accueil</a>						
			    	    <div class='menu_deroulant'>
						    <nav class='nav_bar'>
						      	<ul class='ul_bar'>
						        	<li class='deroulant li_bar'><a href='#' class='a_bar'>".$_SESSION['nom']."</a>
						          		<ul class='sous ul_bar'>
						            		<li class='li_bar' style='margin-left:-8px'><a href='http://localhost/APP_CRUD/service/deconnexion.php?id=".$sess."' class='a_bar'>Disconnect</a></li>
						          		</ul>
						        	</li>
						      	</ul>
						    </nav>
			    	    </div>
			    	</nav>
			    	<a id='topnav_hamburger_icon' href='javascript:void(0);' onclick='showResponsiveMenu()'>
			    	    <!-- Some spans to act as a hamburger -->
			    	    <span></span>
			    	    <span></span>
			    	    <span></span>
			    	</a>
			    	<!-- Responsive Menu -->
			    	<nav role='navigation' id='topnav_responsive_menu'>
			    	    <ul>
			    	        <h2><a href='http://localhost/APP_CRUD/index.php?id=".$sess."' class='home'>Accueil</a></h2>
			    	        <h1><li>Account</li></h1>
			    	        <a href='http://localhost/APP_CRUD/service/deconnexion.php?id=".$sess."' class='home'>Disconnect</a>
			    	    </ul>
			    	</nav>";
				}else{
					echo"
			    	<nav role='navigation' id='topnav_menu' class='button_header'>
			    	    <a id='home_link' class='home' href='http://localhost/APP_CRUD/index.php'>Accueil</a>
						<a id='home_link' class='home' href='http://localhost/APP_CRUD/Views/compte/connexion.php'>Connexion</a>
			    	</nav>
			    	<a id='topnav_hamburger_icon' href='javascript:void(0);' onclick='showResponsiveMenu()'>
			    	    <!-- Some spans to act as a hamburger -->
			    	    <span></span>
			    	    <span></span>
			    	    <span></span>
			    	</a>
			    	<!-- Responsive Menu -->
			    	<nav role='navigation' id='topnav_responsive_menu'>
			    	    <ul>
							<a id='home_link' class='home' href='http://localhost/APP_CRUD/index.php'>Accueil</a>
							<a id='home_link' class='home' href='http://localhost/APP_CRUD/Views/compte/connexion.php'>Connexion</a>
			    	    </ul>
			    	</nav>";
				}
			echo"
			</div>
		</div>
		<div class='parent_links'>";
?>	