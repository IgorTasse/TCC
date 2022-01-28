<?php
    include_once 'verifica.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="shortcut icon" href="src/imagens/favicon.ico" type="image/x-icon">

    <title>Sistema Web</title>
</head>
<body>
    <header class="cabecalho">
        <nav class="navegacao">
            <ul>
                <li><a href="index.php?pg=home">Home</a></li>
                <li><a href="index.php?pg=tabela">Tabela</a></li>
                <li><a href="#">Gráficos</a>
                    <ul>
                        <li><a href="index.php?pg=graficoIrradiancia">Irradiância</a></li>
                        <li><a href="index.php?pg=graficoTemperaturas">Temperaturas</a></li>
                        <li><a href="index.php?pg=graficoPotencia">Potência</a></li>
                    </ul>
                </li>
                <li><a href="painel-login.html">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main class="corpo">
        <div class="conteudo">
        <?php 
            // Fazendo o direcionamento dos links das opções que podem ser selecionadas pelo usuário
            $pg = "";
            if(isset($_GET['pg']) && !empty($_GET['pg'])){
                $pg = addslashes($_GET['pg']);
            }
            //Vai ficar verificando a variável PG
            switch ($pg) {       
                case 'tabela': require 'tabela.php'; break;
                case 'graficoIrradiancia': require 'graficoIrradiancia.php'; break;
                case 'graficoTemperaturas': require 'graficoTemperaturas.php'; break;
                case 'graficoPotencia': require 'graficoPotencia.php'; break;
                default: require 'home.php'; 
            }$pg;
         ?>
        </div>
    </main>
    <footer class="rodape">
        <p class="texto">Este Sistema Web foi desenvolvido pelo aluno <strong><a class="externo" href="https://igortasse.github.io/javascript" target="_blank">Igor Tasse</a></strong> para a realização do Trabalho de Conclusão de Curso.</p>
    </footer>
</body>
</html>