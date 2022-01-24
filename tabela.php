<!-- Importando o arquivo de conexão com o Banco de Dados -->
<?php
    include_once "conectar.php"
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="src/imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="src/CSS/tabela.css">
    <title>Tabela de Dados</title>
</head>
<body>
    <header class="cabecalho">
        <nav class="navegacao">
            <ul class="menu">
                <li class="item"><a href="#">Início</a></li>
                <li class="item"><a href="#">Tabela</a></li>
                <li class="item"><a href="#">Gráficos</a></li>
                <li class="item"><a href="http://192.168.100.140/javascript/painel-login.html">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main class="conteudo">
            <!-- Recebendo os dados do formulário -->
        <?php
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); //Filtrando os dados
        ?>
        <form method="POST" action="#">
            <!-- Mantendo a data na caixa de pesquisa -->
                <div class="data">
                    <?php
                    $data_inicio = "";
                    if(isset($dados['data_inicio'])){
                        $data_inicio = $dados['data_inicio'];
                    }
                    ?>
                    <label class="texto">Data Inicial</label>
                    <input type="date" name="data_inicio" value="<?php echo $data_inicio;?>">
                    <!-- Mantendo a data na caixa de pesquisa -->
                    <?php
                    $data_final = "";
                    if(isset($dados['data_final'])){
                        $data_final = $dados['data_final'];
                    }
                    ?>
                    <label class="texto">Data Final</label>
                    <input type="date" name="data_final" value="<?php echo $data_final;?>">
                    <input class="botao" type="submit" value="Buscar" name="pesquisa_datas">
                </div>
        </form>
            <?php
                //Verificando se o usuário clicou no botão
                if(!empty($dados['pesquisa_datas'])){
                    // Selecionando os dados da tabela medidas que serão mostrados no período de data determinado
                    $query_medidas = "SELECT irradiancia,temperaturaAmbiente,temperaturaPlaca,potencia,created FROM medidas WHERE created BETWEEN :data_inicio AND :data_final";
                    $resultado = $pdo->prepare($query_medidas); //Preparando busca
                    $resultado->bindParam(':data_inicio',$dados['data_inicio']);
                    $resultado->bindParam(':data_final',$dados['data_final']);
                    $resultado->execute();
            
                    // Criando tabela de medidas e imprimindo na tela
                    echo " <table border =\"1\"> ";
                    echo "<tr> <th>Irradiância (W m^2)</th> <th>Potência (W)</th> <th>Temperatura da Placa (ºC)</th> <th>Temperatura Ambiente (ºC)</th> <th>Data e Hora</th> </tr>";
                    while($row_medidas = $resultado->fetch(PDO::FETCH_ASSOC)){
                        extract($row_medidas);
                        echo "<tr>";
                        echo "<td> $irradiancia </td>";
                        echo "<td> $temperaturaAmbiente </td>";
                        echo "<td> $temperaturaPlaca </td>";
                        echo "<td> $potencia </td>";
                        echo "<td>". date('d/m/Y H:i:s', strtotime($created))."</td>";
                        echo "<tr>";
                    }
                    echo "</table>";
                }
                ?>
    </main>
    <footer class="rodape">
        <p class="texto">Este Sistema Web foi desenvolvido pelo aluno <strong><a class="externo" href="https://igortasse.github.io/javascript" target="_blank">Igor Tasse</a></strong> para a realização do Trabalho de Conclusão de Curso.</p>
    </footer>
</body>
</html>