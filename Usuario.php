<!-- Arquivo utilizado para realizar consultas relacionadas aos dados de entrada do usuário-->
<?php
    class Usuario{
        public function login($login, $senha){
            global $pdo;
            //Realizando consulta no Banco de Dados na tabela usuarios
            $query_usuarios = "SELECT * FROM usuarios WHERE login = :login AND senha = :senha";
            $resultado = $pdo->prepare($query_usuarios);
            $resultado->bindValue('login',$login);
            $resultado->bindValue('senha',md5($senha));
            $resultado->execute();
            // Validando os dados
            // Se o número de linhas forem maiores que 0
            if($resultado->rowCount() > 0){
                $dado = $resultado->fetch();
                // Fetch irá criar um vetor com todos os dados da tabela usuarios
    
                // Criando uma sessão para passar os dados do usuário
                $_SESSION['idUsuario'] = $dado['id'];

                return true;
            }

            return false;
        }
        public function logado($id){ // Consultando login e senha
            global $pdo; // recebendo variável global
            $array = array(); // variável onde iremos guardar os dados
            $query_id = "SELECT nome FROM usuarios WHERE id = :id";
            // Fazendo consulta no BD verificando se id é igual ao recebidos
            $resultado = $pdo->prepare($query_id); // Acessando a variável pdo e preparar a consulta
            $resultado->bindValue("id",$id); 
            $resultado->execute();//executando a busca
            //Validando os dados
            if($resultado->rowCount() > 0){ // Contando quantos registros tem com esses dados no BD
                $array = $resultado->fetch(); // Fetch cria um vetor que recebe todos os dados da tabela

                return $array;
            }
        }
}
?>