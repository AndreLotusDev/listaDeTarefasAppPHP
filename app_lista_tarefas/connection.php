<?php 
    //Cria a conexão com o servidor 
    class Connection
    {
        // Credenciais para efetuar a conexão
        private $host = 'localhost';
        private $db_name = 'php_com_pdo';
        private $user = 'root';
        private $pass = '';

        public function connect()
        {
            // Evita que a aplicação crashe
            try
            {
                // Estabeliza a conexão com o DB
                $connection = new PDO(
                    "mysql:host=$this->host;dbname=$this->db_name",
                    "$this->user", //Coloco o usuario aqui
                    "$this->pass", //Coloco o pass aqui
                );

                return $connection;
            }
            catch(PDOException $e)
            {
                // Retorna mensagem de erro
                echo "<p>" . $e->getMessage() . "<p/>";
            }
        }
    }
?>