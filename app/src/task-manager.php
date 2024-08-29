<?php

class Task {
    public $id;
    public $title;
    public $description;
    public $isComplete;

    function __construct($id, $title, $description, $isComplete) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->isComplete = $isComplete;
    }

    public function markAsComplete() {
        $this->isComplete = true;
    }

    public function markAsIncomplete() {
        $this->isComplete = false;
    }

    public function edit(string $title, string $description, bool $isComplete): void {
        $this->title = $title;
        $this->description = $description;
        $this->isComplete = $isComplete;
    }

}

// Json helpers
function saveToJsonFile(string $filePath, array $data) : bool {

    $jsonData = json_encode($data, JSON_PRETTY_PRINT);

    if($jsonData === false) {
        throw new Exception("Error encoding data to JSON: " . json_last_error_msg());
    }

    // Use atomic file write
    $tempFilePath = tempnam(sys_get_temp_dir(), 'json_');
    if(file_put_contents($tempFilePath, $jsonData) === false){
        throw new Exception("Error writing JSON data to temporary file for file path : {$filePath}");
    }

    if(!rename($tempFilePath, $filePath)) {
        throw new Exception("Error renaming temporary file to {$filePath}");
    }

    return true;
}

function loadFromJsonFile(string $filePath) : array {

    if(!file_exists($filePath)) {
        throw new Exception("File not found: {$filePath}");
    }

    $jsonData = file_get_contents($filePath);

    if($jsonData === false) {
        throw new Exception("Error reading file: {$filePath}");
    }
    $data = json_decode($jsonData, true);

    if(json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Error decoding JSON data from file: {$filePath}: " . json_last_error_msg());
    }

    return $data;
}

class TaskManager {
    function __construct(string $storagePath = "jsonTasks.json") {

        $this->storagePath = $storagePath;
        $this->tasks = loadFromJsonFile($this->storagePath);
    }

    private function saveTasks(): void {
        saveToJsonFile($this->storagePath, $this->tasks);
    }

    public function addTask(Task $task): void {
        $this->tasks[$task->id] = $task;
        $this->saveTasks();
    }

    public function getTask(int $taskId): ?Task {
        return $this->tasks[$taskId] ?? null;
    }

    public function listTasks(): array {
        return $this->tasks;
    }

    public function updateTask(Task $task): void {
        if(isset($this->tasks[$task->id])) {
            try {
                $this->tasks[$task->id] = $task;
                $this->saveTasks();

            } catch (Exception $e) {
                throw new Exception("Error occured when updating task: " . $e.getMessage());
            }
        }
    }

    public function deleteTask(int $taskId): void {
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