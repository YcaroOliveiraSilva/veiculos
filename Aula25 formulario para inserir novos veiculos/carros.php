<?php
  
  include "conexao.inc";
?>

<!doctype html>
<html lang=“pt-br”>
	<head>
		<title>CFB Veículos</title>
		<meta charset=“utf-8”/>
		<link rel="stylesheet" href="estilos.css"/> 
	</head>
	<body>
	
		<header>
			<?php
				include "topo.php";
			?>
		</header>
		
		<section id="main">
			<?php  
               
                 $sql="SELECT * FROM tb_carros";
                 $res=mysqli_query($con,$sql);
                 while($exibe=mysqli_fetch_array($res)) {
                 	echo "ID carro: ".$exibe['id_carro']."<br>".
                 	 "Marca: ".$exibe['id_marca']."<br>".
                 	 "Modelo: ".$exibe['id_modelo']."<br>".
                 	 "Versão: ".$exibe['versao']."<br>".
                 	 "Ano Fab: ".$exibe['ano_fab']."<br>".
                 	 "Ano Mod: ".$exibe['ano_mod']."<br>".
                 	 "OBS: ".$exibe['obs']."<br>".
                 	 "Valor: R$".number_format($exibe['valor'],2,',','.')."<br>". // number_format(valor, casas decimais, sep_dec, sep_mil);
                 	 "Foto 1: ".$exibe['foto1']."<br>".
                 	 "Foto 2: ".$exibe['foto2']."<br>".
                 	 "Mini 1: ".$exibe['mini1']."<br>".
                 	 "Mini 2: ".$exibe['mini2']."<br>".
                 	 "Opc 1: ".$exibe['opc1']."<br>".
                 	 "Opc 2: ".$exibe['opc2']."<br>".
                 	 "Opc 3: ".$exibe['opc3']."<br>".
                 	 "Vendido: ".$exibe['vendido']."<br>".
                 	 "Bloq: ".$exibe['bloqueado']."<br>"
                 	 ;
                 }
               
			?>
		</section>
		


		<footer>
			<?php
				include "rodape.html";
			?>
		</footer>
		
	</body>
</html> 