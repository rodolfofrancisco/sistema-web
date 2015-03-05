<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Usuários Cadastrados</title>
    
    <link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap-3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
  
   <div class="container">
   <h4 class="row">Usuários Cadastrados</h4>
   <div class="row">   
   </br>
   <a href="Cadastro.php" class="btn btn-link">Cadastrar</a>    
   </br> 
   </br> 
   <table class="table table-hover table-condensed table-striped table-bordered" style="width: 75%;">
      <thead>
           <tr>
               <th>Nome</th>
               <th>Data Nascimento</th>
               <th>Email</th>
               <th>Sexo</th>
               <th>Grupo</th>
               <th>Nivel</th>
               <th>Privilegio</th>
               <th>Ações</th>
           </tr>
       </thead>
       
       <tbody>
           <?php 
            error_reporting(E_ALL ^ E_DEPRECATED);

           $conexao = mysqli_connect('localhost', 'root', '', 'SistemaWebDB');
            
            if (!$conexao)
            {
                echo "Não conectou </br>";
            }

            else
            { 

                  //$sql = "SELECT Nome, DataNascimento, Email FROM sistemawebdb.usuarios";
                  $sql = "SELECT U.ID, U.Nome, U.DataNascimento, U.Email, S.Sigla, GE.Nome as Grupo,                               TG.Nome AS Nivel, TU.Tipo AS Privilegio FROM sistemawebdb.usuarios AS U Inner                           Join sistemawebdb.Sexo as S on U.SexoID = S.ID Inner Join                                               sistemawebdb.grupoestudo as GE on U.GrupoEstudoID = GE.ID Inner Join                                     sistemawebdb.tipogrupo as TG on GE.TipoGrupoID = TG.ID Inner Join                                       sistemawebdb.tipousuario as TU on U.TipoUsuarioID = TU.ID";
                
                  $dados = mysql_query($sql);

                  while ($linha = mysql_fetch_array($dados))
                  {
                      echo '<tr>';
                      echo '<td>'.$linha['Nome'].'</td>';
                      echo '<td>'.$linha['DataNascimento'].'</td>';
                      echo '<td>'.$linha['Email'].'</td>';
                      echo '<td>'.$linha['Sigla'].'</td>';
                      echo '<td>'.$linha['Grupo'].'</td>';
                      echo '<td>'.$linha['Nivel'].'</td>';
                      echo '<td>'.$linha['Privilegio'].'</td>';                        
                      echo '<td width=250>';
                      echo '<a class="btn btn-xs btn-success " href="Atualizar.php?                                                 id='.$linha['ID'].'">Atualizar</a>';
                      echo ' ';
                      echo '<a class="btn btn-xs btn-danger" href="Excluir.php?                                                     id='.$linha['ID'].'">Excluir</a>';
                      echo '</td>';                      
                      echo '</tr>';
                  }    

                  mysqli_close($conexao);
            }          

            ?>
       </tbody>
   </table>
</div>
</div>  
</body>
</html>