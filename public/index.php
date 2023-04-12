<?php
    session_start();

    require_once __DIR__ . '/./controllers/Auth/AuthController.php';
    $auth = new App\Controller\Auth();

    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header('Location: ./views/login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Bichano's | Sobre </title>
        <link rel="icon" href="/assets/logotype-white.png">
        
        <!-- Incluindo o bootstrap css -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="/style/index.css">
    </head>

    <body>
        <!-- Navbar Primária   <a href="/scripts/logout.php" class="btn btn-primary w-100">Sair</a> -->
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
                <button class="btn btn-outline-light ml-2" onclick="window.location.href='./views/scripts/logout.php'"> Sair </button> 
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
        <br><br><br>
                    <h1  style=" font-weight: bold; color: #0074D9;"> SOBRE AS APOSTAS </h1>
                    <br><br>
                    <p> 
                        O sistema de apostas é uma plataforma online que permite aos usuários realizarem apostas em animais em diferentes concursos. 
                        Para utilizar o sistema, o usuário precisa estar logado, portanto é necessário criar uma conta de usuário com informações básicas como nome, 
                        email e senha.
                    </p> 
                    <p> 
                        Ao fazer login, o usuário pode navegar pelos concursos disponíveis e selecionar um animal para apostar. As apostas serão armazenadas em um 
                        banco de dados, juntamente com informações como o valor apostado, o animal selecionado, o concurso selecionado e a data da aposta.
                    </p> 
                    <p>
                        Cada animal será representado por quatro números, e quando os resultados forem sorteados, será escolhido um número aleatório de 0 a 99 e o 
                        animal que corresponde a esse número será o animal sorteado.
                    </p>    
                    <p>
                        Os concursos têm uma data de início e fim definidas, e o valor do ganhador é calculado multiplicando o valor apostado pelo multiplicador do 
                        concurso selecionado. O status do concurso também é exibido para os usuários, indicando se o concurso ainda está aberto para apostas.
                    </p>
                    <p>
                        Os resultados dos concursos serão armazenados no banco de dados, juntamente com a data do sorteio. Isso permitirá que o sistema rastreie e 
                        exiba os resultados dos concursos para os usuários.
                    </p>
        </div>

        <!-- Incluindo o bootstrap js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"> </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"> </script>
    </body>

</html>