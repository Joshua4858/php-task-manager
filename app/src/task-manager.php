<?php

require_once 'classes/TaskManager.php';
require_once 'classes/Task.php';

$taskManager = new TaskManager('jsonTasks.json');

$newTask = new Task("task1", "task description", false);

$taskManager->addTask($newTask);

print_r($taskManager->listTasks());

