<!-- Importando o arquivo de conexão com o Banco de Dados -->
<?php
    include_once "conectar.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/tabela.css">
</head>
<body>
    <header class="cabecalho">
        <div class="titulo">
            <h1 class ="texto">Entre com o intervalo de Datas desejado!</h1>
        </div>
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
                    <input class="caixa"type="date" name="data_inicio" value="<?php echo $data_inicio;?>"><br><br>
                    <!-- Mantendo a data na caixa de pesquisa -->
                    <?php
                    $data_final = "";
                    if(isset($dados['data_final'])){
                        $data_final = $dados['data_final'];
                    }
                    ?>
                    <label class="texto">Data Final</label>
                    <input class="caixa" type="date" name="data_final" value="<?php echo $data_final;?>"><br><br>
                    <input class="botao" type="submit" value="Buscar" name="pesquisa_datas">
                </div>
        </form>
    </header>
    <main class="conteudo">
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
</body>
</html>