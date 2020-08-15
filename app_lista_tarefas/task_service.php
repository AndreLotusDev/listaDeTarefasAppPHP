<?php 
    //Sistema de CRUD 
    class TaskService
    {
        private $connection;
        private $task;

        // Com a tarefa previamente criada eu posso manipular dentro do TaskService as construindo aqui dentro
        public function __construct(Connection $connection,Task $task)
        {
            $this->connection = $connection->connect();
            $this->task = $task;
        }

        public function addTask()
        {
            // Inserção na tabela
            $query = 'insert into tb_tarefas (tarefa) values (?)';
            // Evita SQL Inection
            $stmt = $this->connection->prepare($query);
            // Trata qualquer tentativa de SQL Injection
            $stmt->bindValue(1,$this->task->__get('task_descr'));
            // Executo por final
            $stmt->execute();
        }

        public function findTask()
        {
            $query = 'select 
                t.id, s.status, t.tarefa 
            from 
                tb_tarefas as t
                left join tb_status as s on (t.id_status = s.id)
            ';
            $stmt = $this->connection->prepare($query);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function editTask()
        {
            // echo "<pre>";
            // print_r($this->task);
            // echo "</pre>";

            $query = 'update tb_tarefas set tarefa = ? where id = ?';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(1, $this->task->__get('task_descr'));
            $stmt->bindValue(2, $this->task->__get('id'));
            return $stmt->execute();
        }

        public function removeTask()
        {
            $query = 'delete from tb_tarefas where id = ?';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(1, $this->task->__get('id'));
            return $stmt->execute();
        }

        public function checkUp()
        {
            $query = 'update tb_tarefas set id_status = ? where id = ?';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(1, $this->task->__get('id_status'));
            $stmt->bindValue(2, $this->task->__get('id'));
            return $stmt->execute();
        }

        public function recoverPendingTasks()
        {
            $query = 'select 
                t.id, s.status, t.tarefa 
            from 
                tb_tarefas as t
                left join tb_status as s on (t.id_status = s.id)
            where
                t.id_status = ?
            ';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(1, $this->task->__get('id_status'));
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>