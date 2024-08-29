<?php

class Task {
    public $id;
    public $title;
    public $description;
    public $isComplete;

    function __construct($title, $description, $isComplete) {
        $this->id = uniqid();
        $this->title = $title;
        $this->description = $description;
        $this->isComplete = $isComplete;
    }

    public function markAsComplete(): void {
        $this->isComplete = true;
    }

    public function markAsIncomplete(): void {
        $this->isComplete = false;
    }

    public function edit(string $title, string $description, bool $isComplete) {
        $this->title = $title;
        $this->description = $description;
        $this->isComplete = $isComplete;
    }
}