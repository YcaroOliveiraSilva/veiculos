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
			<h1>Editar Usuario</h1>
	        

    <form name="f_editar_colaborador" action="editar_usuario.php" class="f_colaborador" method="get">
				<input type="hidden" name="num" value="<?php echo $n1; ?>">
				<label>Selecione o colaborador</label>
				<select name="f_colaboradores" size="10">
					<?php
                       $sql="SELECT * FROM tb_colaboradores";
                       $col=mysqli_query($con,$sql);
                       $total_col=mysqli_num_rows($col);
                       while($exibe=mysqli_fetch_array($col)) {
                            echo "<option value='".$exibe['id_colaborador']."'>".$exibe['nome']."</option>";
                       }

                       ?>
				</select>
                <input type="submit" name="f_bt_editar_colaborador" class="btmenu" value="editar">
			</form>
		
           
           <?php
                  
                if (isset($_GET["f_colaboradores"])) {
                $vid=$_GET["f_colaboradores"];
                $sql="SELECT * FROM tb_colaboradores WHERE id_colaborador=$vid";
                $col=mysqli_query($con,$sql);
                $exibe=mysqli_fetch_array($col);
                if ($exibe >= 1) {
                 	echo "
                        <form name='f_edita_colaborador' action='editar_usuario.php' class='f_colaborador' method='get'>
                        <input type='hidden' name='num' value=$n1>
                        <input type='hidden' name='id' value='".$exibe['id_colaborador']."'>
                        <label>Nome</label>
                        <input type='text' name='f_nome' size='50' maxlength='50' require='required' value='".$exibe['nome']."'>

                        <input type='text' name='f_nome' size='50' maxlength='50' require='required' value='".$exibe['username']."'>

                        <input type='text' name='f_nome' size='50' maxlength='50' require='required' value='".$exibe['senha']."'>

                        <input type='text' name='f_nome' size='50' maxlength='50' require='required' value='".$exibe['acesso']."'placeholder='0 ou 1'>

                        <input type='submit' name='f_bt_editar_colaborador' class='btmenu' value='gravar'>
                 	";
                 } 
               

             }  
           
       
         /*
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
         */

		?>

	</section>
	</body>
</html> 