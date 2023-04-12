<?php
    require_once __DIR__ . '/../config/DatabaseModel.php';
    $db = new \App\Config\Database();
    $conn = $db->getConnection();

    require_once 'Contest.php';
    $contest = new \App\Models\Contest($conn);

    $ar = array(
        "start_date" => "2023-04-01",
        "end_date" => "2023-04-30",
        "modifier" => "2",
        "status" => "open"
    );

    $contest->setValues($ar);

    if ($contest->createContest()) {
        echo "Concurso criado com sucesso!";
    } else {
        echo "Não foi possível criar o concurso.";
    }
?>