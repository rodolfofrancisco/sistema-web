<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<!-- Bootstrap -->
		<link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap-3.3.2/js/bootstrap.min.js"></script>
		<!-- Css de login -->
		<link href="css/login.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<form action="servidor/login.php" method="POST">
					<div class="col-md-offset-5 col-md-3">
						<div class="form-login">
							<h4>Login</h4>
							<input type="text" name="login"  class="form-control input-sm chat-input" placeholder="Login" />
						</br>
						<input type="text" name="senha" class="form-control input-sm chat-input" placeholder="Senha" />
					</br>
					<div class="wrapper">
						<span class="group-btn">     
							<?php
							echo isset($_GET['msg']) ? $_GET['msg'] : '';
							?>
							<br /><br />
							<button type="submit" class="btn btn-primary btn-md">Acessar <i class="fa fa-sign-in"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
