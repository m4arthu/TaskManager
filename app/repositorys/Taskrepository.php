<?php
namespace app\repositorys;

use app\database\Connection;

class TaskRepository
{
    public static function getTasks()
    {
        $connection = Connection::getConnection();
        $prepare = $connection->prepare("select * from tbl_tasks");
        $prepare->execute();
        $tasks = $prepare->fetchAll();
        return $tasks;
    }

    public static function createTask($taskData)
    {
        $connection = Connection::getConnection();
        $prepare = $connection->prepare(
            "INSERT INTO tbl_tasks (task_name, task_description, deadline)
            VALUES (:task_name, :task_description, :deadline)"
        );

        $prepare->bindParam(':task_name', $taskData['name']);
        $prepare->bindParam(':task_description', $taskData['description']);
        $prepare->bindParam(':deadline', $taskData['date']);
        $createTask = $prepare->execute();

        if ($createTask) {
            return true;
        } else {
            return "Erro na execução do comando: " . implode(" ", $prepare->errorInfo());
        }

    }

    public static function updateTask($taskData)
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

    public static function deleteTask($taskId)
    {
        $connection = Connection::getConnection();
        $checkIdQuery = $connection->prepare("SELECT COUNT(*) as count FROM tbl_tasks WHERE id = $taskId");
        $checkIdQuery->execute();
        $result = $checkIdQuery->fetchObject();

        if ($result->count > 0) {
            $prepare = $connection->prepare(
                "DELETE FROM tbl_tasks WHERE id = $taskId"
            );

            $deleteTask = $prepare->execute();
            
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
