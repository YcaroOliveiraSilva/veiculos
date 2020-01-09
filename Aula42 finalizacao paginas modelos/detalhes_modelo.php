<?php
	include "conexao.inc";
?>
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
				include "topo.php";
			?>
		</header>
		
		<section id="main">
			<?php
			
				//$sql="SELECT * FROM tb_carros";
				//$res=mysqli_query($con,$sql);

				$maximo_registros_exibidos=3;
				if(isset($_GET["pg"])){
					$pagina_atual=$_GET["pg"];
				}else{
					$pagina_atual=1;
				}
				
				$inicio=$pagina_atual-1;
				$inicio*=$maximo_registros_exibidos;
				
				$sql="SELECT tb_carros.*, tb_marcas.*,tb_modelos.* FROM tb_carros INNER JOIN tb_marcas ON tb_carros.id_marca = tb_marcas.id_marca INNER JOIN tb_modelos ON tb_carros.id_modelo = tb_modelos.id_modelo LIMIT $inicio,$maximo_registros_exibidos";

				$res=mysqli_query($con,$sql);
				$total_registros=mysqli_num_rows(mysqli_query($con,"SELECT * FROM tb_carros"));
				$total_paginas=$total_registros/$maximo_registros_exibidos;
				
				$anterior=$pagina_atual-1;
				$proxima=$pagina_atual+1;
				
				if($pagina_atual>1){
					echo "<a class='btmenu' href='carros.php?pg=$anterior'>Anterior</a>";
				}
				if($pagina_atual<$total_paginas){
					echo "<a class='btmenu' href='carros.php?pg=$proxima'>Próxima</a>";
				}
				echo "<br>";
				for($ip=0;$ip<$total_paginas;$ip++){
					echo "<a href='carros.php?pg=".($ip+1)."'>[ ";
					if($pagina_atual == ($ip+1)){
						echo "<strong>".($ip+1)."</strong>";
					}else{
						echo ($ip+1);
					}
					echo " ]</a>";
				}
				echo "<br><br>";
				
				while($exibe=mysqli_fetch_array($res)){
					echo"<article>".
					    "<div id='dvminis'>".
					    "<img src='".$exibe['mini1']."' class='mini'>".
					    "<img src='".$exibe['mini2']."' class='mini'>". 
					  "</div>".
					  "<div id='dvdetalhes'>".
					  "<div id='dvc1'>".
                          "id: ".$exibe['id_carro']."<br>".
                          "marca: ".$exibe['marca']."<br>".
                          "modelo: ".$exibe['modelo']."<br>".
                          "versão: ".$exibe['versao']."<br>".
                          "Preço: R$".number_format($exibe['valor'],2,',','.')."<br>". 					
						   "Ano: ".$exibe['ano_fab']."/".$exibe['ano_mod']."<br>".
						"</div>".
						"<div id='dvc2'>".
						  "Observação: ".$exibe['obs']."<br>".
						  "Opc1: ".$exibe['opc1']."<br>".
						  "Opc2: ".$exibe['opc2']."<br>".
						  "Opc3: ".$exibe['opc3']."<br>".
						  "Vendido: ";
						  if ($exibe['vendido']=='0') {
						  	echo "não";
						  } else {
						  	echo "sim";
						  }
						  echo "<br>".
						  "</div>".
					
		        "</article>"
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