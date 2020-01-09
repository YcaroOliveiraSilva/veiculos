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
				
				$sql="SELECT * FROM tb_carros LIMIT $inicio,$maximo_registros_exibidos";
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
					    "<div id='d1'>".
					    "<img src='".$exibe['mini1']."'>". 
					  "</div>".
					  "<div id='d2'>".
					  "<div id='titulo'>".
					  "<div id='t1'>".
						 "<p>".$exibe['id_marca']."</p>".
						"<p>".$exibe['id_modelo']."</p>".
						"<p>".$exibe['versao']."</p>".
						
						"</div>".
						"<div id='t2'>".
						"<p>R$".number_format($exibe['valor'],2,',','.')."</p>". //number_format(valor, casas_decimais, sep_dec, sep_mil);
                        "</div>".
                        "</div>".
						"<div id='dados'>".
						"<p>".$exibe['ano_fab']."/".
					       $exibe['ano_mod']."</p>".
						"<p>".$exibe['vendido']."</p>".
						"</div>".
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