<?php
	session_start();
	if (!isset($_SESSION['Usuario']) || !isset($_COOKIE["logado"]))
		header("Location: login.php");

	setcookie("logado", 'ok', time()+60, "/");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
</head>
<body>
   <h1>Compartilhamento de arquivos</h1>
</body>
</html>