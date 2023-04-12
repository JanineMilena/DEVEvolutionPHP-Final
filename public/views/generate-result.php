<?php
    session_start();

    require_once __DIR__ . '/../controllers/Auth/AuthController.php';
    $auth = new \App\Controller\Auth();

    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header('Location: login.php');
        exit();
    }

    if(!$auth->checkPermission('common')) {
        header('Location: errors/not-authorized.php');
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
        <title> Bichano's | Gerar Resultados </title>
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
            <div class="container">
                <div class="row">
                        <div class="col-md-12">
                            <br><br><br>
                            <h1 style="font-weight: bold; color: #0074D9;">SORTEIO</h1>
                            <div class="form-container">
                                <form method="post">
                                    <div class="form-group">
                                    <br><br>
                                        <label for="concurso">Selecione o concurso:</label>
                                        <br>
                                        <select class="form-control" id="concurso" name="concurso">
                                            <?php while ($contest = $openContests->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $contest['id']; ?>">Concurso <?php echo $contest['id']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" onclick="sortearNumero()">Sortear</button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <script>
            const concurso = document.querySelector('#concurso');
            let id_contest = null;
            let numeroSorteado = null;

            function sortearNumero() {
                numeroSorteado = Math.floor(Math.random() * 100);
                id_contest = concurso.value;
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    console.log('ReadyState: ' + this.readyState);
                    console.log('Status: ' + this.status);
                    if (this.readyState === 4 && this.status === 200) {
                        alert('O número sorteado foi ' + numeroSorteado);    
                    } 
                };
                xhr.open('POST', '/views/scripts/register-result.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id_contest=' + id_contest + '&number=' + numeroSorteado);
            }
        </script>

        <!-- Incluindo o bootstrap js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"> </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"> </script>
    </body>

</html>