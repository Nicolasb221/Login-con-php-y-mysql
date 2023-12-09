<?php 
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $user = null;
        if(count($results) > 0){
            $user = $results;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <title>Bienvenido</title>
</head>
<body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
        <br>Bienvenido. <?= $user['email']?>
        <br>Inicio de sesion exitoso
        <a href="logout.php">Cerrar sesion</a>
    <?php else: ?>
        <h1>Por favor Ingresa o Registrate</h1>
        <a href="login.php">Ingresa</a> o
        <a href="signup.php">Registrate</a>
    <?php endif; ?>
    
</body>
</html>