<?php 

    // Objeto que ira incluir ou recuperar os dados do banco
    class Task
    {
        private $id;
        private $id_status;
        private $task_descr;
        private $launch_data;

        public function __get($atr)
        {
            return $this->$atr;
        }

        public function __set($atr, $value)
        {
            $this->$atr = $value;
            return $this;
            // echo "<br>" . $this->task_descr;
        }
    }
?>