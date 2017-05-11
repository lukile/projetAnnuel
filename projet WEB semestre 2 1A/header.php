<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Mon titre</title>
		<meta name="description" content="ma description">
		<link rel="stylesheet" href="public/css/style.css">
 	</head>
	<body>

		<div id="container">

			<header>
				<h1>Mon titre</h1>
				<nav>
					<a href="index.php" title="infobulle" >Accueil</a>
					<?php 
                       if(isConnected()):
                   ?>
              		   
                       <a href="logout.php" title="infobulle" >Se déconnecter</a> 
                       <a href="user.php" title="infobulle"> User DB</a>
                       
                   
                   <?php 
                      else: 
                    ?>
					<a href="subscribe.php" title="infobulle" >Inscription</a>
					<a href="login.php" title="infobulle" >Se connecter</a>
					
					<?php 
                       endif;
                   ?>

				</nav>
			</header>