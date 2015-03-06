<?php
	echo isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
   
   <form action="servidor/login.php" method="POST">
       Login: <br/><input type="text" name="login" /><br/>
       Senha: <br/><input type="password" name="senha" /><br/>
        <input type="submit" name="btn" value="Acessar"><br/>
    </form>
</body>
</html>