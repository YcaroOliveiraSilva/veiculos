<?php
	session_start();
	if(isset($_SESSION["numlogin"])){
		$n1=$_GET["num"];
		$n2=$_SESSION["numlogin"];
		if($n1!=$n2){
			echo "<p>Login não efetuado</p>";
			exit;
		}
	}else{
		echo "<p>Login não efetuado</p>";
		exit;
	}
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
		
			<a href="gerenciamento.php?num=<?php echo $n1; ?>" target="_self" class="btmenu">voltar</a>
			<h1>Excluir Carros</h1>
			
			<?php
			
				if(isset($_GET["f_bt_excluir_carro"])){
					$vid=$_GET["f_carros"];
					//SELEÇÃO DE IMAGENS DOS CARROS
					$sql="SELECT * FROM tb_carros WHERE id_carro='$vid'";
					$res=mysqli_query($con,$sql);
					 while($exibe=mysqli_fetch_assoc($res)){
					 	$fotos=array($exibe["foto1"],$exibe["foto2"]);
					 	$minis=array($exibe["mini1"],$exibe["mini2"]);
					 }


					$sql="DELETE FROM tb_carros WHERE id_carro=$vid";
					mysqli_query($con,$sql);
					$linhas=mysqli_affected_rows($con);
					if($linhas >= 1){
						for($i=0; $i<2; $i++) { 
							if ($fotos[$i]!="") {
								try {
								unlink($fotos[$i]);
								unlink($minis[$i]);
							}catch(Exception $e){
								echo "";
							}
							}
						}
						echo "<p>Carro deletado com sucesso</p>";
					}else{
						echo "<p>Erro ao deletar carro</p>";
					}
				}
			
			?>
			
			<form name="f_excluir_carro" action="excluir_carro.php" class="f_colaborador" method="get">
				<input type="hidden" name="num" value="<?php echo $n1; ?>">
				<label>Selecione o colaborador</label>
				<select name="f_carros" size="10">
					<?php
						$sql="SELECT tb_carros.*, tb_marcas.*,tb_modelos.* FROM tb_carros INNER JOIN tb_marcas ON tb_carros.id_marca = tb_marcas.id_marca INNER JOIN tb_modelos ON tb_carros.id_modelo = tb_modelos.id_modelo";
						$col=mysqli_query($con,$sql);
						//$total_col=mysqli_num_rows($col);
						while($exibe=mysqli_fetch_array($col)){
							echo "<option value='".$exibe['id_carro']."'>".$exibe['id_carro']." - ".$exibe['marca']." - ".$exibe['modelo']." - ".$exibe['versao']." - ".$exibe['ano_fab']." /".$exibe['ano_mod']." - ".$exibe['valor']."</option>";
						}
					?>
				</select>
				<input type="submit" name="f_bt_excluir_carro" class="btmenu" value="excluir">
			</form>
		
		</section>
		
	</body>
</html> 