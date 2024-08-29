<?php

require_once 'classes/TaskManager.php';
require_once 'classes/Task.php';

$taskManager = new TaskManager('jsonTasks.json');

// Function to display usage
function displayUsage() {
    "Usage:\n";
    echo " php tmcli.php list <options>\n";
    echo " php tmcli.php view <task_id>\n";
    echo " php tmcli.php update <task_id> <title> <description> <isComplete\n";
    echo " php tmcli.php update <delete> <task_id>\n";
    echo "OPTIONS: \n [-td]  displays date time of task\n";
}

// check number of arguments
if($argv < 2) {
    displayUsage();
    exit(1);
}

// command checking and output
$command = $argv[1];

switch ($command) {
    case 'list':
        $allTasks = $taskManager->listTasks();
        foreach($allTasks as $task) {
            // Check if -dt flag is at argv2 pos
            if(isset($argv[2]) && $argv[2] == '-dt') {
                echo "ID: {$task['id']}, Title: {$task['title']}, Description: {$task['description']}, Completed: " . ($task['isComplete'] ? 'Yes' : 'No') . ", Created at: {$task['createdAt']}" . "\n";
            }else {
                echo "ID: {$task['id']}, Title: {$task['title']}, Description: {$task['description']}, Completed: " . ($task['isComplete'] ? 'Yes' : 'No') . "\n";
            }
        }
        break;
    case 'view':
        $allTasks = $taskManager->listTasks();
        if(isset($argv[2])) {
            $task = $allTasks[$argv[2]];
            echo "ID: {$task['id']}, Title: {$task['title']}, Description: {$task['description']}, Completed: " . ($task['isComplete'] ? 'Yes' : 'No') . ", Created at: {$task['createdAt']}" . "\n";
        }else {
            echo "Please provide <task_id> as 2nd argument e.g. php tmcli.php view <id>\n";
        }

        break;
    case 'update';
        break;
    case 'delete';
        break;
    case '--help' || '-h';
        displayUsage();
        break;
    default:
        echo "Unknown command.\n";
        displayUsage();
        break;
}

