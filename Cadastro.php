<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>  
    <link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap-3.3.2/js/bootstrap.min.js"></script>  
</head>
<body>      
   <div class="container">
    <div class="span10 offset1">
   <div class="row">
       <h3>Cadastro de Usuários</h3>
   </div>
   <div class="span10 offset1">
    <form class="form-horizontal" action="ValidarDados.php" method="post">            
          <div class="well">
           <fieldset>                
            <legend>Pessoa</legend>
                <br/>   
                <div class="control-group">
                <label class="control-label" for="Nome">Nome</label>   
                <div class="controls">
                <input type="text" name="Nome"/>  
                </div>
                </div>                 
                <br/>
                <br/>
       
               <div class="control-group">
               <label class="control-label" for="DataNascimento">Data de Nascimento</label>
               <div class="controls">
               <input type="date" name="DataNascimento"/>
               </div>
               </div>
               <br/>
               <br/>

               <div class="control-group">
               <label class="control-label" for="Email">Email</label>
               <div class="controls">
               <input type="email" name="Email"/>
                </div>
                </div>
               <br/>
               <br/>

                <div class="control-group">
               <label class="control-label" for="Sexo">Sexo</label>
               <div class="controls">               
               <input type="radio" name="Sexo" value="Masculino" checked />Masculino
               <input type="radio" name="Sexo" value="Feminino" />Feminino               
                </div>
                </div>
               <br/>
               <br/>
               
                <div class="control-group">
               <label class="control-label" for="GrupoEstudos">Grupo de Estudos</label>
               <div class="controls">
                <?php
                    error_reporting(E_ALL ^ E_DEPRECATED);
                    mysql_connect('localhost', 'root', '');
                    mysql_select_db('SistemaWebDB');

                    $sql = "SELECT Nome FROM grupoestudo"; 
                    $dados =  mysql_query($sql);  

                    echo "<select name='GrupoEstudos'>";
                    echo "<option value='Selecione'>Selecione</option>";
                    while ($linha = mysql_fetch_array($dados))
                    {
                        echo "<option value='" . $linha['Nome'] ."'>" . $linha['Nome'] ."</option>";
                    }

                    echo "</select>";

                    mysql_close();

               ?>   
                </div>
                </div>
               <br/>  
               <br/>       
        </fieldset> 
        </div>
        
        <div class="well">
        <fieldset>
            <legend>Endereço</legend>
                <br/>
                <div class="control-group">
               <label class="control-label" for="Rua">Rua</label>
               <div class="controls">
                <input type="text" name="Rua"/>
                </div>
                </div>
                <br/>  
                <br/>
                
                <div class="control-group">
               <label class="control-label" for="Numero">Número</label>
               <div class="controls">
               <input type="number" name="Numero"/>
               </div>
               </div>
               <br/>  
               <br/>   
               
               <div class="control-group">
               <label class="control-label" for="Bairro">Bairro</label>
               <div class="controls">
               <input type="text" name="Bairro"/>
               </div>
               </div>
               <br/>   
               <br/>  
               
               <div class="control-group">
               <label class="control-label" for="Cidade">Cidade</label>
               <div class="controls">
               <input type="text" name="Cidade"/>
               </div>
               </div>
               <br/>  
               <br/>              
       </fieldset>
       </div>
       
       <div class="well">
       <fieldset>
           <legend>Telefone</legend>
               <br/>
               
               <div class="control-group">
               <label class="control-label" for="TelefoneResidencial">Telefone Residencial</label>
               <div class="controls">
               <input type="tel" name="TelefoneResidencial"/>
                </div>
                </div>
               <br/>
               <br/>
       
               <div class="control-group">
               <label class="control-label" for="TelefoneComercial">Telefone Comercial</label>
               <div class=controls>
               <input type="tel" name="TelefoneComercial"/>
                </div>
                </div>
               <br/>
               <br/>
       
               <div class="control-group">
               <label class="control-label" for="Celular">Celular</label>
               <div class="controls">
               <input type="tel" name="Celular"/>
               </div>
               </div>
               <br/>
               <br/>
        </fieldset>  
        </div>
        
       <div class="well">
       <fieldset >
           <legend>Usuário</legend> 
               <br/>
               <div class="control-group">
               <label class="control-label" for="NomeUsuario">Nome de Usuário</label>
               <div class="controls">
               <input type="text" name="NomeUsuario"/>
                </div>
                </div>
               <br/> 
               <br/>    
       
               <div class="control-group">
               <label class="control-label" for="Senha">Senha</label>
               <div class="controls">
               <input type="password" name="Senha"/>
                </div>
                </div>
               <br/>
               <br/>
                
               <div class="control-group">
               <label class="control-label" for="ConfirmarSenha">Confirmar Senha</label>
               <div class="controls">
               <input type="password" name="ConfirmarSenha"/>
                </div>
                </div>
               <br/>
               <br/>
       </fieldset>
       </div>
       <br/>      
       <div class="form-actions">
           <input type="submit" value="Salvar" class= "btn btn-success"/>
           <a class = "btn btn-default" href="Index.php">Voltar</a>  
       </div>      
    </form>
    </div>
    </div>
    </div>
</body>
</html>