<?php
    require_once __DIR__ . '/../config/DatabaseModel.php';
    $db = new \App\Config\Database();
    $conn = $db->getConnection();

    require_once 'Bet.php';
    $bet = new \App\Models\Bet($conn);

    $ar = array(
        "user_id" => "1",
        "animal_id" => "10",
        "contest_id" => "1",
        "value" => "100",
        "bet_date" => "2023-04-09"
    );

    $bet->setValues($ar);

    if ($bet->createBet()) {
        echo "Aposta criada com sucesso!";
    } else {
        echo "Não foi possível criar a aposta.";
    }
?>