<?php

require_once 'classes/TaskManager.php';
require_once 'classes/Task.php';

$taskManager = new TaskManager('jsonTasks.json');

// Function to display usage
function displayUsage() {
    "Usage:\n";
    echo " php tmcli.php list\n";
    echo " php tmcli.php view <task_id>\n";
    echo " php tmcli.php update <task_id> <title> <description> <isComplete\n";
    echo " php tmcli.php update <delete> <task_id>\n";
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
            echo "ID: {$task['id']}, Title: {$task['title']}, Description: {$task['description']}, Completed: " . ($task['isComplete'] ? 'Yes' : 'No') . "\n";
        }
        break;
    case 'view':
        break;
    case 'update';
        break;
    case 'delete';
        break;
    default:
        echo "Unknown command.\n";
        displayUsage();
        break;
}

