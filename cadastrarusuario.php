<?php
require_once("servidor/conexao.php");
session_start();

//Se não tiver logado redireciona para login
if (isset($_SESSION["Usuario"]) && isset($_COOKIE['logado'])){
	setcookie("logado", 'ok', time()+60, "/");			
	
	//Se não for admin redireciona para index
	if ($_SESSION['Usuario']['acesso'] != 1){
		header("Location: index.php");
	}	
}else{
	session_destroy();
	header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cadastro de Usuários</title>  
	<!-- Bootstrap -->
	<link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-3.3.2/js/bootstrap.min.js"></script> 
	<!-- Css de admin -->
	<link href="css/admin.css" rel="stylesheet"> 
</head>
<body>      
	<div class="container content">
		<div class="span10 offset1">
			<div class="row">
				<h3>Cadastro de Usuários</h3>
			</div>
			<div class="span10 offset1">
				<form class="form-horizontal" action="servidor/cadastrarusuario.php" method="post">    
					<div class="well">
						<fieldset>                 
							<div class="control-group">
								<label class="control-label" for="nome">Nome </label>   
								<div class="controls">
									<input type="text" name="nome"/>  
								</div>
							</div>                 
							<div class="control-group">
								<label class="control-label" for="email">Email </label>
								<div class="controls">
									<input type="email" name="email"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="datanasc">Data de Nascimento </label>
								<div class="controls">
									<input type="text" name="datanasc"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="telefone">Telefone </label>
								<div class="controls">
									<input type="text" name="telefone"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="sexo">Sexo </label>
								<div class="controls">               
									<input type="radio" name="sexo" value="M" checked />Masculino
									<input type="radio" name="sexo" value="F" />Feminino               
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="privilegio">Privilégio </label>
								<div class="controls">               
									<select name ="privilegio">
										<option value = "">Selecione</option>
										<option value = "1">Admin</option>
										<option value = "2">Usuario</option>
									</select>               
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="grupo">Grupo de Estudos </label>
								<div class="controls">
									<?php
									$sql = "SELECT * FROM grupo"; 

									$result = mysqli_query($conexao, $sql, $field=0);
									?>
									<select name='grupo'>''
										<option value=''>Selecione</option>''
										<?php

										if (mysqli_num_rows($result) > 0) {
											while($row = mysqli_fetch_assoc($result)) {
											?>
											<option value="<?php echo $row['codigo']; ?>"> 
												<?php echo $row['nome']; ?>
											</option>
										<?php
											}
										}
										?>
									</select>
									<?php
									mysql_close();
									?>   
								</div>
							</div>  
							<div class="control-group">
								<label class="control-label" for="login">Login </label>
								<div class="controls">
									<input type="text" name="login"/>
								</div>
							</div>  
							<div class="control-group">
								<label class="control-label" for="senha">Senha </label>
								<div class="controls">
									<input type="text" name="senha"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="confsenha"> Confirmação de Senha </label>
								<div class="controls">
									<input type="text" name="confsenha"/>
								</div>
							</div>  
						</fieldset> 
					</div>
					<div class="form-actions">
						<input type="submit" value="Enviar" class= "btn btn-success"/>
						<a class = "btn btn-default" href="admin.php">Voltar</a>  
					</div>      
				</form>
			</div>
		</div>
	</div>
</body>
</html>