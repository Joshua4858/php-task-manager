# PHP Task Manager

## Overview

The PHP Task Manager is a simple CLI-based task management application. It allows you to manage tasks with features such as adding, updating, deleting, and listing tasks. Tasks are stored in a JSON file for persistence.

## Features

- Add new tasks
- View existing tasks
- Update tasks
- Delete tasks
- List all tasks
- Data persistence using JSON files

## Installation

1. **Clone the Repository**

    ```bash
    git clone https://github.com/yourusername/php-tmcli.git
    ```

2. **Navigate to the Project Directory**

    ```bash
    cd php-task-manager
    ```

3. **Install Dependencies**

    If you have any dependencies, install them. For this project, no external dependencies are required.

## Usage

### Running the Script

1. **Navigate to the `src` Directory**

    ```bash
    cd src
    ```

2. **Run the PHP Script**

    ```bash
    php tmcli.php
    ```

### Command Line Interface

The application supports basic command-line operations. Here’s how you can use it:

- **Add a Task**

    ```bash
    php tmcli.php add "Task Title" "Task Description"
    ```

- **List Tasks**

    ```bash
    php tmcli.php list
    ```

- **View a Task**

    ```bash
    php tmcli.php view <task_id>
    ```

- **Update a Task**

    ```bash
    php tmcli.php update <task_id> "New Title" "New Description"
    ```

- **Delete a Task**

    ```bash
    php tmcli.php delete <task_id>
    ```

## Example

### Adding a Task

To add a new task:

```bash
php tmcli.php add "Finish Homework" "Complete the math homework by tomorrow"

