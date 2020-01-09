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
		<link rel="stylesheet" href="estilos.css"/>
		<meta charset="utf-8"> 
	</head>
	<body>
	
		<header>
			<?php
				include "topo.php";
			?>
		</header>

		<section id="main">
		
			<a href="gerenciamento.php?num=<?php echo $n1; ?>" target="_self" class="btmenu">voltar</a>
			<h1>Excluir Usuario</h1>
	           
         <?php

         if (isset($_GET["f_bt_excluir_colaborador"])) {
         	 $vid=$_GET["f_colaboradores"];
         	 $sql="DELETE FROM tb_colaboradores WHERE id_colaborador=$vid";
         	 mysqli_query($con,$sql);
         	 $linhas=mysqli_affected_rows($con);
         	 if ($linhas >= 1) {
         	   echo "<p>Colaborador deletado com sucesso</p>";
         	 } else {
         	 	echo "<p>Erro ao deletar colaborador</p>";
         	 }
         }

       ?>

			<form name="f_excluir_colaborador" action="excluir_usuario.php" class="f_colaborador" method="get">
				<input type="hidden" name="num" value="<?php echo $n1; ?>">
				<label>Selecione o colaborador</label>
				<select name="f_colaboradores" size="10">
					<?php
                       $sql="SELECT * FROM tb_colaboradores";
                       $col=mysqli_query($con,$sql);
                     //  $total_col=mysqli_num_rows($col);
                       while($exibe=mysqli_fetch_array($col)) {
                            echo "<option value='".$exibe['id_colaborador']."'>".$exibe['nome']."</option>";
                       }

                       ?>
				</select>
                
           
				<input type="submit" name="f_bt_excluir_colaborador" class="btmenu" value="excluir">
			</form>
		
		</section>
		
	</body>
</html> 