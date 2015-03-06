<?php 
require_once("servidor/conexao.php");
session_start();

//Se não tiver logado redireciona para login
if (isset($_SESSION["Usuario"]) /*&& isset($_COOKIE['logado'])*/ ){
	setcookie("logado", 'ok', time()+60);			
	
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
		<title>Administração do sistema</title>
		
		<link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap-3.3.2/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<h4 class="row">Usuários Cadastrados</h4>
			<div class="row">   
				<a href="Cadastro.php" class="btn btn-link">Cadastrar</a>    
				<table class="table table-hover table-condensed table-striped table-bordered" style="width: 75%;">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Email</th>
							<th>Data Nascimento</th>
							<th>Telefone</th>
							<th>Sexo</th>
							<th>Grupo</th>
							<th>Privilegio</th>
							<th>Ações</th>
						</tr>
					</thead>

					<tbody>
						<?php 
						$sql = "SELECT u.id, u.nome, u.email, u.datanasc, u.telefone, u.sexo, u.acesso, g.nome as grupo 
								FROM usuario as u 
								INNER JOIN grupo as g 
								ON u.codigogrupo = g.codigo";

						$result = mysqli_query($conexao, $sql, $field=0);

						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
							?>
							<tr>
								<td> <?php echo $row['nome']; ?> </td>
								<td> <?php echo $row['email']; ?> </td>
								<td> <?php echo $row['datanasc']; ?> </td>
								<td> <?php echo $row['telefone']; ?> </td>
								<td> <?php echo $row['sexo'] == 'M' ? 'Marculino' : 'Feminino'; ?> </td>
								<td> <?php echo $row['grupo']; ?> </td>
								<td> <?php echo $row['acesso'] == '1' ? 'Administrador' : 'Usuario'; ?> </td>    
								<td width="250">
									<a class="btn btn-xs btn-success " href="Atualizar.php?id=<?php echo $row['id']; ?>" > Atualizar</a>
									<a class="btn btn-xs btn-danger" href="Excluir.php?id=<?php echo $row['id']; ?>" > Excluir</a>
								</td>                     
							</tr>
							<?php
							}
						}    

						mysqli_close($conexao);         
					?>
					</tbody>
				</table>
			</div>
		</div>  
	</body>
</html>