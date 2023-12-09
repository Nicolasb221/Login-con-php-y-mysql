<?php
    session_start();

    require 'database.php';
    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id'] = $results['id'];
            header('Location: /Login con php y mysql');
        }else{
            $message = 'Contraseña incorrecta o el usuario es inexistente';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <title>Ingreso</title>
</head>
<body>
    <?php require 'partials/header.php' ?>

    <h1>Ingresar</h1>
    <span>o <a href="signup.php">Registrarse</a></span>

    <?php if(!empty($message)):?>
        <p><?= $message ?></p>
    <?php endif;?>


    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Ingrese su email">
        <input type="password" name="password" placeholder="Ingrese su contraseña">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>