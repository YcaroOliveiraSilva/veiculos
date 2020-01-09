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
		
			<a href="gerenciamento.php?num=<?php echo $n1; ?>" target="_self" class="btmenu">voltar</a>
			<h1>Marcas / Modelos</h1>
			
			<?php
			
				if(isset($_GET["codigo"])){
					$vcod=$_GET["codigo"];
					if($vcod==1){
						//Nova Marca
						$vmarca=$_GET["f_marca"];
						$sql="INSERT INTO tb_marcas (marca) VALUES ('$vmarca')";
						mysqli_query($con,$sql);
						$linhas=mysqli_affected_rows($con);
						if($linhas >= 1){
							echo "<script>alert('Nova marca adicionada com sucesso');</script>";
						}else{
							echo "<script>alert('ERRO ao adicionar nova marca');</script>";
						}
					}else if($vcod==2){
						//Novo Modelo
						$vmodelo=$_GET["f_modelo"];
						$vidmarca=$_GET["f_marcas"];
						$sql="INSERT INTO tb_modelos (modelo,id_marca) VALUES ('$vmodelo',$vidmarca)";
						mysqli_query($con,$sql);
						$linhas=mysqli_affected_rows($con);
						if($linhas >= 1){
							echo "<script>alert('Novo modelo adicionado com sucesso');</script>";
						}else{
							echo "<script>alert('ERRO ao adicionar novo modelo');</script>";
						}
					}else if($vcod==3){
						//Deleta Marca
						$vidmarca=$_GET["f_del_marcas"];
						$sql="DELETE FROM tb_marcas WHERE id_marca=$vidmarca";
						mysqli_query($con,$sql);
						$linhas=mysqli_affected_rows($con);
						if($linhas >= 1){
							echo "<script>alert('Marca deletada com sucesso');</script>";
						}else{
							echo "<script>alert('ERRO ao deletar marca');</script>";
						}
					}else if($vcod==4){
						//Deleta Modelo
						$vidmodelo=$_GET["f_modelos"];
						$sql="DELETE FROM tb_modelos WHERE id_modelo=$vidmodelo";
						mysqli_query($con,$sql);
						$linhas=mysqli_affected_rows($con);
						if($linhas >= 1){
							echo "<script>alert('Modelo deletado com sucesso');</script>";
						}else{
							echo "<script>alert('ERRO ao deletar modelo');</script>";
						}
					}
				}
			
			?>
			
			<div id="f_add">
			
				<form name="f_nova_marca" action="marcas_modelos.php" method="get" class="">
					<input type="hidden" name="num" value="<?php echo $n1; ?>">
					<input type="hidden" name="codigo" value="1">
					<label>Nova Marca</label>
					<input type="text" name="f_marca" maxlength="50" size="50" required="required">
					<input type="submit" value="gravar marca" class="btmenu" name="f_bt_nova_marca">
				</form>
				
				<form name="f_novo_modelo" action="marcas_modelos.php" method="get" class="">
					<input type="hidden" name="num" value="<?php echo $n1; ?>">
					<input type="hidden" name="codigo" value="2">
					<label>Selecione uma marca</label>
					<select name="f_marcas" size="10" required="required">
						<?php
							$sql="SELECT * FROM tb_marcas";
							$col=mysqli_query($con,$sql);
							//$total_col=mysqli_num_rows($col);
							while($exibe=mysqli_fetch_array($col)){
								echo "<option value='".$exibe['id_marca']."'>".$exibe['marca']."</option>";
							}
						?>
					</select>
					<label>Novo Modelo</label>
					<input type="text" name="f_modelo" maxlength="50" size="50" required="required">
					<input type="submit" value="gravar modelo" class="btmenu" name="f_bt_novo_modelo">
				</form>
			
			</div>
			
			<div id="f_del">
			
				<form name="f_del_marca" action="marcas_modelos.php" method="get" class="">
					<input type="hidden" name="num" value="<?php echo $n1; ?>">
					<input type="hidden" name="codigo" value="3">
					<label>Selecione uma marca</label>
					<select name="f_del_marcas" size="10" required="required">
						<?php
							$sql="SELECT * FROM tb_marcas";
							$col=mysqli_query($con,$sql);
							//$total_col=mysqli_num_rows($col);
							while($exibe=mysqli_fetch_array($col)){
								echo "<option value='".$exibe['id_marca']."'>".$exibe['marca']."</option>";
							}
						?>
					</select>
					<input type="submit" value="deleter marca" class="btmenu" name="f_bt_del_marca">
				</form>
			
				<form name="f_del_modelo" action="marcas_modelos.php" method="get" class="">
					<input type="hidden" name="num" value="<?php echo $n1; ?>">
					<input type="hidden" name="codigo" value="4">
					<label>Selecione um modelo</label>
					<select name="f_modelos" size="10" required="required">
						<?php
							$sql="SELECT * FROM tb_modelos";
							$col=mysqli_query($con,$sql);
							//$total_col=mysqli_num_rows($col);
							while($exibe=mysqli_fetch_array($col)){
								echo "<option value='".$exibe['id_modelo']."'>".$exibe['modelo']."</option>";
							}
						?>
					</select>
					<input type="submit" value="deleter modelo" class="btmenu" name="f_bt_del_modelo">
				</form>
			
			</div>
					
		</section>
		
	</body>
</html> 