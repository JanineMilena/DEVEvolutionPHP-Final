<?php
    session_start();

    require_once __DIR__ . '/../controllers/Auth/AuthController.php';
    $auth = new \App\Controller\Auth();

    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header('Location: login.php');
        exit();
    }

    require_once __DIR__ . '/../models/config/DatabaseModel.php';
    $db = new \App\Config\Database();
    $conn = $db->getConnection();
    require_once __DIR__ . '/../models/classes/Contest/ContestModel.php';
    $contest = new \App\Models\Contest($conn);
    $openContests = $contest->getOpenContests();
?>


<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Bichano's | Apostas </title>
        <link rel="icon" href="/assets/logotype-white.png">
        
        <!-- Incluindo o bootstrap css -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="/style/index.css">
    </head>

    <body>
        <!-- Navbar Primária -->
        <nav id="primary-navbar" class="navbar navbar-expand-lg navbar-dark bg-gradient-primary mx-auto">
            <a class="navbar-brand mx-auto" href="/index.php"> 
                <img src="/assets/logotype-white.png" width="50" height="50" alt="Logo"> 
            </a>

            <div class="navbar-text flex-grow-1"> 
                <img src="/assets/logo-white.png" width="200" height="200" alt="Outra imagem" class="img-fluid mx-auto"> 
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> 
                <span class="navbar-toggler-icon"></span> 
            </button>

            <div class="collapse navbar-collapse" id="navbarNav"> 
                <ul class="navbar-nav mr-auto"></ul> 
                <button class="btn btn-outline-light ml-2" onclick="window.location.href='./scripts/logout.php'"> Sair </button> 
            </div>
        </nav>

        <!-- Navbar Secundária -->
        <nav id="secondary-navbar" class="navbar navbar-expand-lg navbar-dark bg-gradient-primary mx-auto">
            <div class="mx-auto">
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" href="/views/bets.php">APOSTAR</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/views/contests.php">CONCURSOS</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/views/my-bets.php">MINHAS APOSTAS</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/views/insert-contest.php">ABRIR CONCURSOS (ADM)</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/views/results.php">RESULTADOS (ADM)</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/views/generate-result.php">GERAR RESULTADO (ADM)</a> </li>
                </ul>
            </div>  
        </nav>

        <!-- Conteúdo -->
        <div class="content-container" style="margin: 0 auto; text-align: center; max-width: 1300px;">
            <!-- Título -->
            <br><br><br>
            <h1 style="font-weight: bold; color: #0074D9;">FAÇA SUA APOSTA!</h1>

            <!-- Formulário -->
            <br><br><br>
            <form method="post">
                <div class="form-group">
                    <h3 for="concurso">Selecione o concurso:</h3>
                    <br>
                    <select class="form-control" id="concurso" name="concurso">
                        <?php while ($contest = $openContests->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $contest['id']; ?>">Concurso <?php echo $contest['id']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </form>

            <!-- Animais -->
            <br><br>
            <h3 for="concurso">Selecione o animal:</h3>
            <div id="hex-container">
                <div class="hex" id="1"><div class="inner"><p>AVESTRUZ</p></div></div>
                <div class="hex" id="2"><div class="inner"><p>ÁGUIA</p></div></div>
                <div class="hex" id="3"><div class="inner"><p>BURRO</p></div></div>
                <div class="hex" id="4"><div class="inner"><p>BORBOLETA</p></div></div>
                <div class="hex" id="5"><div class="inner"><p>CACHORRO</p></div></div>
                <div class="hex" id="6"><div class="inner"><p>CABRA</p></div></div>
                <div class="hex" id="7"><div class="inner"><p>CARNEIRO</p></div></div>
                <div class="hex" id="8"><div class="inner"><p>CAMELO</p></div></div>
                <div class="hex" id="9"><div class="inner"><p>COBRA</p></div></div>
                <div class="hex" id="10"><div class="inner"><p>COELHO</p></div></div>
                <div class="hex" id="11"><div class="inner"><p>CAVALO</p></div></div>
                <div class="hex" id="12"><div class="inner"><p>ELEFANTE</p></div></div>
                <div class="hex" id="13"><div class="inner"><p>GALO</p></div></div>
                <div class="hex" id="14"><div class="inner"><p>GATO</p></div></div>
                <div class="hex" id="15"><div class="inner"><p>JACARÉ</p></div></div>
                <div class="hex" id="16"><div class="inner"><p>LEÃO</p></div></div>
                <div class="hex" id="17"><div class="inner"><p>MACACO</p></div></div>
                <div class="hex" id="18"><div class="inner"><p>PORCO</p></div></div>
                <div class="hex" id="19"><div class="inner"><p>PAVÃO</p></div></div>
                <div class="hex" id="20"><div class="inner"><p>PERU</p></div></div>
                <div class="hex" id="21"><div class="inner"><p>TOURO</p></div></div>
                <div class="hex" id="22"><div class="inner"><p>TIGRE</p></div></div>
                <div class="hex" id="23"><div class="inner"><p>URSO</p></div></div>
                <div class="hex" id="24"><div class="inner"><p>VEADO</p></div></div>
                <div class="hex" id="25"><div class="inner"><p>VACA</p></div></div>
            </div>

            <br><br>
            <h3 for="concurso">Informe o valor da aposta:</h3>
            <div class="form-group">
            <br>
                <input id="value-input" type="text" class="form-control" id="input-text">
            </div>

            <div style="text-align: center;">
                <button id="submit-bet" class="btn btn-primary" style="background-image: linear-gradient(to right, #5DE0E6, #004AAD); font-size: 24px; border-radius: 10px; border: none; margin-bottom: 200px;  margin-top: 100px; width: 200px; height: 70px">APOSTAR</button>
            </div>


            <script>
                const hexagons = document.querySelectorAll('.hex');
                const concurso = document.querySelector('#concurso');
                const inputValue = document.getElementById('value-input');
                const submitButton = document.getElementById('submit-bet');

                let selectedHex = null;
                let id_animal = null;
                let id_contest = null;
                let value = null;

                hexagons.forEach(hex => {
                    hex.addEventListener('click', () => {
                        if (selectedHex) {
                        selectedHex.classList.remove('selected');
                        }
                        hex.classList.add('selected');
                        selectedHex = hex;

                        id_animal = selectedHex.getAttribute('id');
                    });
                });

                submitButton.addEventListener('click', () => {
                    id_contest = concurso.value;
                    value = inputValue.value;

                    const xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        console.log('ReadyState: ' + this.readyState);
                        console.log('Status: ' + this.status);
                        if (this.readyState === 4 && this.status === 200) {
                            alert('Aposta realizada com sucesso!');
                        }
                    };

                    xhr.open('POST', '/views/scripts/register-bet.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send('id_contest=' + id_contest + '&id_animal=' + id_animal + '&value=' + value);
                });

            </script>
        </div>

        <!-- Incluindo o bootstrap js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"> </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"> </script>
    </body>

</html>