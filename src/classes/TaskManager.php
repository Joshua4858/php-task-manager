<?php 

require_once "./helpers/json-helpers.php";

class TaskManager {
    function __construct(string $storagePath = "jsonTasks.json") {
        $this->storagePath = $storagePath;
        $this->tasks = loadFromJsonFile($this->storagePath);

        if(!is_array($this->tasks)){
            $this->tasks = [];
        }
    }

    private function saveTasks(): void {
        saveToJsonFile($this->storagePath, $this->tasks);
    }

    public function addTask(Task $task): void {
        $this->tasks[$task->id] = $task;
        $this->saveTasks();
    }

    public function getTask(string $taskId): array {
        return $this->tasks[$taskId] ?? null;
    }

    public function listTasks(): array {
        return $this->tasks;
    }

    public function updateTask(array $task): void {
        if(isset($this->tasks[$task['id']])) {
            try {
                $this->tasks[$task['id']] = $task;
                $this->saveTasks();

            } catch (Exception $e) {
                throw new Exception("Error occured when updating task: " . $e.getMessage());
            }
        }
    }

    public function deleteTask(string $taskId): void {
        try {
            if(isset($this->tasks[$taskId])) {
                unset($this->tasks[$taskId]);
                $this->saveTasks();
            }
        } catch (Exception $e) {
            throw new Exception("Error deleting tasks: " . $e.getMessage());
        }
    }

}