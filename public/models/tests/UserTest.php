<?php
    require_once __DIR__ . '/../config/DatabaseModel.php';
    $db = new \App\Config\Database();
    $conn = $db->getConnection();

    require_once 'User.php';
    $user = new \App\Models\User($conn);


    $ar = array(
        "name" => "Janine Milena",
        "email" => "janinemilenadalchiavon@gmail.com",
        "password" => "admin",
        "permission_type" => "admin"
    );

    $user->setID(1);
    $user->setValues($ar);

    if ($user->updateUser()) {
        echo "Usuário atualizado com sucesso!";
    } else {
        echo "Não foi possível atualizar o usuário.";
    }
?>