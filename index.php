<?php 
    include('./config/database.php');

    if(strlen($_POST['email']) || isset($_POST['senha'])) {

        if(strlen($_POST['email']) == 0) {
            echo "O campo de email é obrigatório!";
        } else if(strlen($_POST['senha']) == 0) {
            echo "O campo de senha é obrigatório!";
        } else {
            $email = $mysqli -> real_escape_string($_POST['email']);
            $senha = $mysqli -> real_escape_string($_POST['senha']);

            $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
            $sql_query = $mysqli -> query($sql_code) or die("Erro na consulta!: " . $mysqli -> error);

            $quantidade = $sql_query -> num_rows;

            if($quantidade == 1) {
                $usuario = $sql_query -> fetch_assoc();

                if(!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];

                header("Location: ./templates/main.php");
                
            } else {
                echo "Erro!"; 
            } 
        } 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Boas vindas!</h1>
    <form action="" method="POST">
        <p>
            <label>E-mail</label>
            <input type="text" name="email">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button type="submit">Entrar</button>
        </p>
    </form>
    <h3>Ainda não é cadastrado? registre-se aqui:</h3>
    <p><a href="./templates/register.php">Registrar</a></p>
</body> 
</html>