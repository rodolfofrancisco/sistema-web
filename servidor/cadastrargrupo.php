<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <title>Validação de grupos</title>
</head>
<body>
   
    <?php
    $tipoid;
    $codigo = $_POST["Codigo"];
    $nome = $_POST["Nome"];
    $tipo = $_POST["Tipo"];
    $erro = false;
    $selecao;
    $conexao = mysqli_connect('localhost', 'root', '', 'SistemaWebDB');
    
    if (empty($codigo) or strstr($codigo, ' '))
    {                            
        echo "Preencha o código </br>";
        $erro = true;
    }
    
    if (strlen($codigo) > 100)
    {                            
        echo "O tamanho máximo do código é 10 caracteres </br>";
        $erro = true;
    }

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
    
    if ($tipo == "Selecione")
    {                            
        echo "Preencha o tipo </br>";
        $erro = true;           
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
            $selecao = "SELECT ID FROM sistemawebdb.tipogrupo WHERE Nome = '$tipo'";
            $dados = mysql_query($selecao);
            $tipoid = mysql_fetch_row($dados);                
            
                //echo "ID =====>" . $tipoid[0];
            
            $sql = "Insert into `grupoestudo`(codigo, nome, tipogrupoid) Values                                             ('$codigo','$nome','$tipoid[0]') ";  
            mysqli_query($conexao, $sql); 
        }
        
        mysqli_close($conexao);
    }
    
    ?>
    
    
    
</body>
</html>