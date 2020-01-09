<!doctype html>
<html lang="pt-br">
	<head>
		<title>CFB Veículos</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="estilos.css"/> 
	</head>
	<body>
	
		<header>
			<?php
				require_once("topo.php");
			?>
		</header>
		
		<section class="banner">
			<?php
				require_once("slider.html");
			?>
		</section>
		
		<section id="buscador">
			<?php
				require_once("buscador.php");
			?>
		</section>
		
		<section id="destaques">
			<?php
				require_once("destaques.html");
			?>
		</section>
		
		<footer>
			<?php
				require_once("rodape.html");
			?>
		</footer>
		
	</body>
</html> 