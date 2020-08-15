<?php 

    // Acessa eles, mas como se tivesse sendo acessado dentro do Htdocs
    require "../../app_lista_tarefas/task_object.php";
    require "../../app_lista_tarefas/task_service.php";
    require "../../app_lista_tarefas/connection.php";

    // echo "<pre>";
    // print_r($_POST);
    // echo "<pre/>";

    $action = isset($_GET['action']) ? $_GET['action'] : $action;

    // Verifica se o comando é de inserção no front
    if($action == 'insert')
    {
        $task = new Task();
        $task->__set('task_descr', $_POST['task_description']);

        $connection = new Connection();

        $taskService = new TaskService($connection, $task);
        $taskService->addTask();

        // echo "<pre>";
        // print_r($taskService);
        // echo "<pre/>";

        header('Location: ../app_lista_tarefas_public/nova_tarefa.php?include=1');
    }
    else if($action == 'recover')
    {
        $task = new Task();
        $connection = new Connection();

        $taskService = new TaskService($connection, $task);
        $tasks = $taskService->findTask();
        // echo 'Funcionou';
    }
    else if($action == 'update')
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo  "</pre>";

        $task = new Task();
        $task->__set('id', $_POST['id'])->__set('task_descr', $_POST['task']);

        $connection = new Connection();

        $taskService = new TaskService($connection, $task);
        if($taskService->editTask())
        {
            if(isset($_GET['pag']) && $_GET['pag'] == 'index')
            {
                header('Location:index.php');
            }
            else
            {
                header('Location:todas_tarefas.php');
            }
            
        };
    }
    else if($action == 'remove')
    {
        $task = new Task();
        $task->__set('id', $_GET['id']);

        $connection = new Connection();

        $taskService = new TaskService($connection, $task);
        if($taskService->removeTask())
        {
            if(isset($_GET['pag']) && $_GET['pag'] == 'index')
            {
                header('Location:index.php');
            }
            else
            {
                header('Location:todas_tarefas.php');
            }
        };
    }
    else if($action == 'check')
    {
        $task = new Task();
        
        $task->__set('id', $_GET['id'])->__set('id_status', 2);

        // $task->__set('id', $_GET['id'])->__set('id_status', 1); 
        // echo "rodou";


        $connection = new Connection();

        $taskService = new TaskService($connection, $task);
        $taskService->checkUp();
        if(isset($_GET['pag']) && $_GET['pag'] == 'index')
            {
                header('Location:index.php');
            }
            else
            {
                header('Location:todas_tarefas.php');
            }
    }
    else if($action == 'recoverPendingTasks')
    {
        $task = new Task();
        $task->__set('id_status', 1);
        $connection = new Connection();
        $taskService = new TaskService($connection, $task);
        $tasks = $taskService->recoverPendingTasks();
    }

?>
    