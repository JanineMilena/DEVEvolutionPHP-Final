<?php
    require_once __DIR__ . '/../config/DatabaseModel.php';
    $db = new \App\Config\Database();
    $conn = $db->getConnection();

    require_once '../classes/Animal/AnimalModel.php';
    $animal = new \App\Models\Animal($conn);

/*     if ($animal->getAnimals()) {
        echo "Consulta realizada com sucesso!";
    } else {
        echo "Não foi possível realizar a consulta.";
    } */

    $animal->setNumber(40);
    $receba =  $animal->getAnimalIDByNumber();
    echo $receba;

?>