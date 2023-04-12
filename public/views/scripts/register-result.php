<?php
    session_start();

    require_once __DIR__ . '/../../models/config/DatabaseModel.php';
    $db = new \App\Config\Database();
    $conn = $db->getConnection();
    require_once __DIR__ . '/../../models/classes/Result/ResultModel.php';
    $result = new \App\Models\Result($conn);
    require_once __DIR__ . '/../../models/classes/Animal/AnimalModel.php';
    $animal = new \App\Models\Animal($conn);
    require_once __DIR__ . '/../../models/classes/Contest/ContestModel.php';
    $contest = new \App\Models\Contest($conn);

    $animal->setNumber($_POST['number']);
    $id_animal = $animal->getAnimalIDByNumber();
    $id_contest = $_POST['id_contest']; 
    $today = new DateTime();
    $date_string = $today->format('Y-m-d');

    $ar = array(
        "contest_id" => $id_contest,
        "animal_id" => $id_animal,
        "result_date" => $date_string
    );

    $result->setValues($ar);

    if ($result->createResult()) {
        $contest->setID($id_contest);   
        $contest->setStatus('closed');
        $contest->updateContestStatus();
    } else {
        echo "Não foi possível criar o resultado.";
    } 
?>