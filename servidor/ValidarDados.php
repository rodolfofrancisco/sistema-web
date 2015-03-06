<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validação de Dados</title>
</head>

<body>
     <?php

        //usuario
        $nome = $_POST["Nome"];
        $dataNascimento = $_POST["DataNascimento"];
        $email = $_POST["Email"];
        $sexo = $_POST["Sexo"];
        $sexoID = null;
        $grupoEstudos = $_POST["GrupoEstudos"];
        $grupoEstudosID = null;
        
        //endereço
        $rua = $_POST["Rua"];
        $numero = $_POST["Numero"];
        $bairro = $_POST["Bairro"];
        $cidade = $_POST["Cidade"];        
        
        //Telefone
        $telefoneResidencial = $_POST["TelefoneResidencial"];
        $telefoneComercial = $_POST["TelefoneComercial"];
        $celular = $_POST["Celular"];
        
        //Usuario
        $nomeUsuario = $_POST["NomeUsuario"];
        $senha = $_POST["Senha"];
        $confirmarSenha = $_POST["ConfirmarSenha"];
        

        $erro = false;
        $conexao = mysqli_connect('localhost', 'root', '', 'SistemaWebDB');

        //Validação pessoa
        if (empty($nome))
        {                            
            echo "Preencha seu nome </br>";
            $erro = true;
        }
            
        if (strlen($nome) > 100)
        {                            
            echo "O tamanho máximo é 100 caracteres </br>";
            $erro = true;
        }

        if (empty($dataNascimento))
        {                            
            echo "Preencha sua data de nascimento </br>";
            $erro = true;
        }
            
        if (empty($email) or strstr($email, ' '))
        {                            
           echo "Preencha seu email </br>";
           $erro = true;
        }
            
        if (!ValidarEmail($email))
        {
            echo "Email inválido </br>";
            $erro = true;
        }

        if ($sexo == "Feminino")
            $sexoID = 1;
        else
            $sexoID = 2;

        if ($grupoEstudos == "Selecione")
        {                            
            echo "Escolha seu grupo de estudo </br>";
            $erro = true;
        } 

        //Validação Endereço        
        if (empty($rua))
        {                            
            echo "Preencha sua rua </br>";
            $erro = true;
        }
            
        if (strlen($rua) > 100)
        {                            
            echo "O tamanho máximo é 100 caracteres </br>";
            $erro = true;
        }

        if (empty($numero))
        {                            
            echo "Preencha o numero </br>";
            $erro = true;
        }
            
        if (empty($bairro))
        {                            
           echo "Preencha seu bairro </br>";
           $erro = true;
        }            
        
        if (empty($cidade))
        {                            
            echo "Preencha a cidade </br>";
            $erro = true;
        }         
            
        //Validação telefone   
        if (empty($telefoneResidencial))
        {                            
            echo "Preencha seu telefone residencial </br>";
            $erro = true;
        }
                
        if (empty($telefoneComercial))
        {                            
            echo "Preencha seu telefone comercial </br>";
            $erro = true;
        }
                    
        if (empty($celular))
        {                            
            echo "Preencha seu celular </br>";
            $erro = true;
        }                  
        
        //Validação usuário
        if (empty($nomeUsuario))
        {                            
            echo "Preencha seu nome de usuário </br>";
            $erro = true;
        }
            
        if (strlen($nomeUsuario) > 100)
        {                            
            echo "O tamanho máximo é 100 caracteres </br>";
            $erro = true;
        }     
            
        if (empty($senha) or strstr($senha, ' '))
        {                            
            echo "Preencha a senha </br>";
            $erro = true;
        }
                
        if (empty($confirmarSenha))
        {                            
            echo "Confirme sua senha </br>";
            $erro = true;
        }

        if ($senha != $confirmarSenha)
        {
            echo "As senhas não são iguais";
            $erro = true;
        }

        function ValidarEmail($email)
        {
            if (ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$", $email ) )
            {
               return true;
            }
            
            else
            {
                return false;
            }
        }

        if (!$conexao)
        {
            echo "Não conectou </br>";
        }
    
        else
        {
            if ($erro == true)
            {
                echo "Há erros no sistema e nada será inserido no banco de dados !!!! </br>";
            }
            
            else
            {
                $selecao = "SELECT ID FROM sistemawebdb.grupoestudo WHERE Nome = '$grupoEstudos'";
                $dados = mysql_query($selecao) or die(mysql_error());
                $grupoEstudosID = mysql_fetch_row($dados);     
                
                
               // echo "ID Grupo =======>" .$grupoEstudosID[0];
                
                
                $inserirCliente = "Insert into `usuarios`(Nome, DataNascimento, Email, SexoID, TipoUsuarioID, GrupoEstudoID) Values                                             ('$nome','$dataNascimento','$email', '$sexoID', '2', '$grupoEstudosID[0]')";  
                mysqli_query($conexao, $inserirCliente);
                
                
                //pegar ultimo id de usuarios
                $selecao = "SELECT ID FROM sistemawebdb.usuarios AS U ORDER BY U.ID DESC LIMIT 1 ";
                $dados = mysql_query($selecao);
                $usuarioID = mysql_fetch_row($dados); 
                
               // echo "ID Usuario =======>" .$usuarioID[0];
                
                $inserirEndereco = "Insert into `endereco`(UsuarioID, Rua, Numero, Bairro, Cidade) Values                                                                       ('$usuarioID[0]','$rua','$numero', '$bairro', '$cidade')";  
                mysqli_query($conexao, $inserirEndereco);
                
                $inserirTelefoneResidencial = "Insert into `telefone`(TipoTelefoneID, UsuarioID, Numero) Values                                                                       ('2','$usuarioID[0]','$telefoneResidencial')";  
                mysqli_query($conexao, $inserirTelefoneResidencial);
                
                $inserirTelefoneComercial = "Insert into `telefone`(TipoTelefoneID, UsuarioID, Numero) Values                                                                       ('1','$usuarioID[0]','$telefoneComercial')";  
                mysqli_query($conexao, $inserirTelefoneComercial);
                
                $inserirCelular = "Insert into `telefone`(TipoTelefoneID, UsuarioID, Numero) Values                                                                       ('3','$usuarioID[0]','$celular')";  
                mysqli_query($conexao, $inserirCelular);
                
                 $inserirLogin = "Insert into `login`(UsuarioID, NomeUsuario, Senha) Values                                                                       ('$usuarioID[0]','$nomeUsuario','$senha')";  
                mysqli_query($conexao, $inserirLogin);
                
                
                //echo "ID =====>" . $tipoid[0];
                
                //$sql = "Insert into `grupoestudo`(codigo, nome, tipogrupoid) Values ('$codigo','$nome','$tipoid[0]') ";  
                //mysqli_query($conexao, $sql); 
            }
                           
            mysqli_close($conexao);
        }
        
     ?>      
        
                
</body>
</html>