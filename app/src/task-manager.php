<?php

require_once 'classes/TaskManager.php';
require_once 'classes/Task.php';

$taskManager = new TaskManager('jsonTasks.json');

$newTask = new Task();
$taskManager->addTask();

