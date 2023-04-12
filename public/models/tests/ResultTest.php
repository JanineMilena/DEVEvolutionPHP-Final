<?php
    require_once __DIR__ . '/../config/DatabaseModel.php';
    $db = new \App\Config\Database();
    $conn = $db->getConnection();

    require_once 'Result.php';
    $result = new \App\Models\Result($conn);


    $ar = array(
        "contest_id" => "1",
        "animal_id" => "10",
        "result_date" => "2023-04-10"
    );

    $result->setValues($ar);

    if ($result->createResult()) {
        echo "Resultado criado com sucesso!";
    } else {
        echo "Não foi possível criar o resultado.";
    }
?>