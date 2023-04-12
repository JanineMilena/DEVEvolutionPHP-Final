<?php
    session_start();

    require_once __DIR__ . '/../../models/config/DatabaseModel.php';
    $db = new \App\Config\Database();
    $conn = $db->getConnection();

    require_once __DIR__ . '/../../models/classes/Bet/BetModel.php';
    $bet = new \App\Models\Bet($conn);

    $id_user = $_SESSION['id'];
    $id_animal = $_POST['id_animal'];
    $id_contest = $_POST['id_contest'];
    $value = $_POST['value'];
    $today = new DateTime();
    $date_string = $today->format('Y-m-d');

    $ar = array(
        "user_id" => $id_user,
        "animal_id" => $id_animal,
        "contest_id" => $id_contest,
        "value" => $value,
        "bet_date" => $date_string
    );

    $bet->setValues($ar);

    if ($bet->createBet()) {
        echo "Aposta criada com sucesso!";
    } else {
        echo "Não foi possível criar a aposta.";
    }
?>