<?php
	$conexao = mysqli_connect('localhost','root','root', 'sistemaweb'); 
        
	if (!$conexao) { 
		die('Erro ao conectar com o Banco de Dados: ' . mysql_error()); 
	}
?>