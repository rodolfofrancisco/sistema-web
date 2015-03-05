<?php
	session_start();
	
	if(isset($_SESSION["login"]) && isset($_SESSION["senha"]))
    {        
		if(isset($_COOKIE["logado"]))
        {
			echo "Usuario ".$_SESSION["login"]." conectado com sucesso!";
			setcookie("logado", 'ok', time()+30);			
		} 
        
        else
        {
			session_destroy();
			header("Location: login.php");
		}	
	}
    
    else
    {	
		$conexao = mysqli_connect('localhost','root','', 'sistemawebdb'); 
        
		if (!$conexao) 
        { 
			die('Erro ao conectar com o Banco de Dados: ' . mysql_error()); 
		}
        
        else
        {		
			//Verifica se usuário digitado está cadastrado
			$sql = "SELECT count(NomeUsuario) as qtd from login where NomeUsuario = '".$_POST['login']."' and senha = '".$_POST['senha']."'";
            
			$result = mysqli_query($conexao, $sql, $field=0);
			
            if (mysqli_num_rows($result) > 0)
            {
				while($row = mysqli_fetch_assoc($result)) 
                {
					$achou = $row["qtd"];
				}	
                
				if($achou)
                {				
					echo "Usuario ".$_POST["login"]." conectado com sucesso!";
					setcookie("logado", 'ok', time()+60);
					$_SESSION["login"] = $_POST['login'];	
					$_SESSION["senha"] = $_POST['senha'];	
                    if ($_POST["login"] == "thiagopaivamed")
                    {
                        header("Location: Index.php");   
                    }
				}
                
                else
                {   
                    echo "Usuario e/ou senha invalido(s)";
					session_destroy();
					header("Location: login.php?msg=Usuario ou Senha Inválido!");                        
				}
			}				
			mysqli_close($conexao);
		}
	}		
?>