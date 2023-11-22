<?php
namespace app\repositorys;

use app\database\Connection;

class TaskRepository
{
    public static function getTasks() // pega todas as  tasks
    {
        $connection = Connection::getConnection();
        $prepare = $connection->prepare("select * from tbl_tasks");
        $prepare->execute();
        $tasks = $prepare->fetchAll();
        return $tasks;
    }

    public static function createTask($taskData) // cria uma task
    {
        $connection = Connection::getConnection();
        $prepare = $connection->prepare(
            "INSERT INTO tbl_tasks (task_name, task_description, deadline)
            VALUES (:task_name, :task_description, :deadline)"
        );
         // conecta as referencias da queri iniciadas com : com os dadps passados pelo parametro
        $prepare->bindParam(':task_name', $taskData['name']);
        $prepare->bindParam(':task_description', $taskData['description']);
        $prepare->bindParam(':deadline', $taskData['date']);
        $createTask = $prepare->execute();

        // se  conseguir criar  retorna  true se não  retorna a mensagem de erro
        if ($createTask) {
            return true;
        } else {
            return "Erro na execução do comando: " . implode(" ", $prepare->errorInfo());
        }

    }

    public static function updateTask($taskData) // atualiza uma task
    {
        $connection = Connection::getConnection();
        // Verifique se o ID existe antes de executar a atualização
        $checkIdQuery = $connection->prepare("SELECT COUNT(*) as count FROM tbl_tasks WHERE id = :task_id");
        $checkIdQuery->bindParam(':task_id', $taskData['taskId']);
        $checkIdQuery->execute();
        $result = $checkIdQuery->fetchObject();

        if ($result->count > 0) {
            // O ID existe, execute a atualização
            $prepare = $connection->prepare(
                "UPDATE tbl_tasks
             SET task_name = :new_task_name, task_description = :new_task_description,
             deadline = :new_task_deadline
             WHERE id = :task_id"
            );

            // conecta as referencias da queri iniciadas com : com os dadps passados pelo parametro
            $prepare->bindParam(':new_task_name', $taskData['name']);
            $prepare->bindParam(':new_task_description', $taskData['description']);
            $prepare->bindParam(':new_task_deadline', $taskData['date']);
            $prepare->bindParam(':task_id', $taskData['taskId']);
            $createTask = $prepare->execute();

            // Verificar se a atualização foi bem-sucedida
            if ($createTask) {
                return true;
            } else {
                return  "Erro ao atualizar a tarefa.";
            }
        } else {
            return "ID não encontrado. A atualização não foi realizada.";
        }

    }

    public static function deleteTask($taskId) // deleta  as tasks
    {
        // verifica se existe  uma task  com o taskId passado
        $connection = Connection::getConnection();
        $checkIdQuery = $connection->prepare("SELECT COUNT(*) as count FROM tbl_tasks WHERE id = $taskId");
        $checkIdQuery->execute();
        $result = $checkIdQuery->fetchObject();

        if ($result->count > 0) {
            $prepare = $connection->prepare(
                "DELETE FROM tbl_tasks WHERE id = $taskId"
            );

            $deleteTask = $prepare->execute();
            
            // verifica se a operação foi  bem sucedida
            if ($deleteTask) {
                return true;
            } else {
                return  "Erro ao apagar a tarefa.";
            }
        } else {
            return "ID não encontrado. A deletação não foi realizada.";
        }
    }

}
