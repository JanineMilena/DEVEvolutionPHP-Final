# Jogo do Bicho Online

## Apresentação do Projeto:
O sistema de apostas é uma plataforma online que permite aos usuários realizarem apostas em animais em diferentes concursos. Para utilizar o sistema, o usuário precisa estar logado, portanto é necessário criar uma conta de usuário com informações básicas como nome, email e senha.

Ao fazer login, o usuário pode navegar pelos concursos disponíveis e selecionar um animal para apostar. As apostas serão armazenadas em um banco de dados, juntamente com informações como o valor apostado, o animal selecionado, o concurso selecionado e a data da aposta.

Cada animal será representado por quatro números, e quando os resultados forem sorteados, será escolhido um número aleatório de 0 a 99 e o animal que corresponde a esse número será o animal sorteado.

Os concursos têm uma data de início e fim definidas, e o valor do ganhador é calculado multiplicando o valor apostado pelo multiplicador do concurso selecionado. O status do concurso também é exibido para os usuários, indicando se o concurso ainda está aberto para apostas.

Os resultados dos concursos serão armazenados no banco de dados, juntamente com a data do sorteio. Isso permitirá que o sistema rastreie e exiba os resultados dos concursos para os usuários.

## Requisitos:

* Docker
* Docker compose

## Configurações:

### Configurando os dados de autenticação

Crie um arquivo `.env` com o conteúdo de `.env-sample` na raiz.

### Buildando os Containers:
No terminal execute a seguinte linha de comando para subir os containers.<br>
`docker-compose up -d --build`

### Alternando o IP do container do banco:
No terminal execute a seguinte linha de comando para validar o IP do container do banco de dados.<br>
`docker inspect mariadb | grep IPAddress`<br>
Após isso, no arquivo dentro de `public/models/config/DatabaseModel.php` defina o IP obtido como o host, na seguinte linha:<br>
`private $host = "<IP_OBTIDO>";`<br>
Salve.

### Acessando a aplicação aplicação:
Para acessar a aplicação basta acessar o seguinte link no navegador:<br>
`localhost:8888`
