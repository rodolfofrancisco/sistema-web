<!DOCTYPE html>
<html lang="en">
<head>    
    <title>Cadastro de Grupos</title>
    <meta charset="UTF-8">
</head>
<body>  
    
     <form action="ValidarGrupos.php" method="post">
      
        <label for="Codigo">Código</label>
       <input type="text" name="Codigo"/>
       <br/>
      
       <label for="Nome">Nome</label>
       <input type="text" name="Nome"/>
       <br/>       
      
       
       <label for="Tipo">Tipo de Grupo</label>
        <?php
            
            mysql_connect('localhost', 'root', '');
            mysql_select_db('SistemaWebDB');

            $sql = "SELECT Nome FROM tipogrupo"; 
            $dados =  mysql_query($sql);  

            echo "<select name='Tipo'>";
            echo "<option value='Selecione'>Selecione</option>";
            while ($linha = mysql_fetch_array($dados))
            {
                echo "<option value='" . $linha['Nome'] ."'>" . $linha['Nome'] ."</option>";
            }
            
            echo "</select>";

            mysql_close();

       ?>   
        
       <br/>          
       
       <input type="submit" value="Salvar"/>
       <input type="reset" value="Limpar"/>      
      
        
    </form>   
</body>
</html>