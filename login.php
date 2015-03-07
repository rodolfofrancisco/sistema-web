<?php
	echo isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		
		<link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap-3.3.2/js/bootstrap.min.js"></script>
	</head>
	<body>
	   <div class="panel panel-default">
		   <form action="servidor/login.php" method="POST">
		       Login: <br/><input type="text" name="login" /><br/>
		       Senha: <br/><input type="password" name="senha" /><br/>
		        <input type="submit" name="btn" value="Acessar"><br/>
		    </form>
	    </div>
	</body>
</html>
<!-- <div class="panel panel-default">
  <div class="panel-heading">Panel heading without title</div>
  <div class="panel-body">
    Panel content
  </div>
</div> -->