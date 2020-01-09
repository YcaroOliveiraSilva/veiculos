<?php
  session_start();
  if(isset($_SESSION["numlogin"])){
    if (isset($_GET["num"])) {
       $n1=$_GET["num"];
     }  elseif (isset($_POST["num"])) {
        $n1=$_POST["num"];
     }  
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
    <script src="jquery-3.1.1.min.js"></script>

       <script>
              $(document).ready(function() {
                   $('select[name="f_marca"]').on('change',function() {
                        var vmarcas=this.value;
                        $('select[name="f_modelo"] option').each(function() {
                             var $this=$(this);
                              if ($this.data('marca') == vmarcas) {
                                   $this.show();
                           } else {
                                $this.hide();
                           }
                        });
                   });

                   $('select[name="f_modelo"]').val('');
              });

       </script>











  </head>
  <body>
  
    <header>
      <?php
        include "topo.php";
      ?>
    </header>

    <section id="main">
    
      <a href="gerenciamento.php?num=<?php echo $n1; ?>" target="_self" class="btmenu">voltar</a>
      <h1>Novo Carro</h1>
      
         <?php

             $vetOpc=array();
             $vetOpc[0]="Vidro Eletrico";
             $vetOpc[1]="Teto Solar";
             $vetOpc[2]="Ar Condicionado";

             if (isset($_POST["f_bt_novo_carro"])) {
                $vetFotos=array();
                $vetMnis=array();
                $if=0;
                $qtdeFotos=2;

                $dir='carros/'; 
                //$dir='home/pasta_site/public_html/carros/' // quando no servidor hospedado
                
                for ($if=0; $if<$qtdeFotos; $if++) { 
                      $vetFotos[$if]="";
                      $vetMinis[$if]="";
                  }

                  for ($if=0; $if<$qtdeFotos; $if++) { 
                        if(isset($_FILES['f_foto'.($if+1)]['name'])) {
                          if ($_FILES['f_foto'.($if+1)]['name']!="") {
                                  
                              $ex=strtolower(substr($_FILES['f_foto'.($if+1)]['name'],-4));   
                              $novo_nome=uniqid().$ex;
                              move_uploaded_file($_FILES['f_foto'.($if+1)]['tmp_name'],$dir.$novo_nome);
                               
                                   

                             } else {
                               $vetFotos[$if]="";
                               $vetMinis[$if]="";

                             }
                          } else {
                             $vetFotos[$if]="";
                             $vetMinis[$if]="";
                       }
                  }

             }
         ?>

      
      <form name="f_novo_carro" action="novo_carro.php" class="f_novocarro" method="post" enctype="multipart/form-data">
        <input type="hidden" name="num" value="<?php echo $n1; ?>">
          <label>Marca</label>
               <select name="f_marca">
                  <option value=""></option>
                    <?php
                    
                         $sql="SELECT * FROM tb_marca";
                         $res=mysqli_query($con,$sql);
                         while ($linha=mysqli_fetch_row($res)) {
                          
                         

                         echo "<option value='".$linha[0]."'>".$linha[1]."</option>";

                         //  $linha=mysqli_fetch_row(mysqli_query($con))

                             }

                    ?>    
               </select>

                      <label>Modelo</label>
               <select name="f_modelo">
                  <option value=""></option>
                    <?php
                    
                         $sql="SELECT * FROM tb_modelos";
                         $res=mysqli_query($con,$sql);
                         while ($linha=mysqli_fetch_row($res)) {
                          
                         

                         echo "<option value='".$linha[0]."' data-marca='".$linha[2]."'>".$linha[1]."</option>";

                         //  $linha=mysqli_fetch_row(mysqli_query($con))

                   }

                    ?>    
               </select>
                  
                     <label>Versao</label>
                 <input type="text" name="f_versao" maxlength="50" size="50" required="required">
                      <label>Ano Fabricacao</label>
                 <input type="text" name="f_anofab" maxlength="4" size="4" pattern="[0-9]{4}" required="required">
                       <label>Ano Modelo</label>
                 <input type="text" name="f_anomod" maxlength="4" size="4" pattern="[0-9]{4}" required="required">
                       <label>Observacao</label>
                 <textarea name="f_obs" rows="5" cols="51" required="required"></textarea>
                       <label>Valor R$</label>
                 <input type="text" name="f_valor" maxlength="11" size="11" pattern="[0-9]+$" required="required">
                      <label>Foto 1</label>
                 <input type="file" name="f_foto1">
                       <label>Foto 2</label>
                 <input type="file" name="f_foto2">
                        <label>Opcionais</label>
                         <div>
                          <input type="checkbox" name="f_opc1" value="1"><label><?php echo $vetOpc[0]; ?></label>
                          <input type="checkbox" name="f_opc2" value="1"><label><?php echo $vetOpc[1]; ?></label>
                          <input type="checkbox" name="f_opc3" value="1"><label><?php echo $vetOpc[2]; ?></label>
                         </div>

       <input type="submit" name="f_bt_novo_carro" class="btmenu" value="gravar">
      </form>
    
    </section>
    
  </body>
</html> 