
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Login</title>

		<link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap-3.3.2/js/bootstrap.min.js"></script>
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
	<style type="text/css">
		body {
			background-color:#fff;
			-webkit-font-smoothing: antialiased;
			font: normal 14px Roboto,arial,sans-serif;
		}

		.container {
			padding: 25px;
			position: fixed;
		}

		.form-login {
			background-color: #EDEDED;
			padding-top: 10px;
			padding-bottom: 20px;
			padding-left: 20px;
			padding-right: 20px;
			border-radius: 15px;
			border-color:#d2d2d2;
			border-width: 5px;
			box-shadow:0 1px 0 #cfcfcf;
		}

		h4 { 
			border:0 solid #fff; 
			border-bottom-width:1px;
			padding-bottom:10px;
			text-align: center;
		}

		.form-control {
			border-radius: 10px;
		}

		.wrapper {
			text-align: center;
		}
	</style>
	</body>
</html>
<!-- <div class="panel panel-default">
  <div class="panel-heading">Panel heading without title</div>
  <div class="panel-body">
    Panel content
  </div>
</div> -->