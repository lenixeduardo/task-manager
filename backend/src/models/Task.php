<?php

namespace App\Models;

use App\Database\Database;

class Task {
    public $id;
    public $title;
    public $description;
    public $status;
    public $created_at;
    public $updated_at;

    public static function all() {
        $db = Database::connect();
        return $db->query("SELECT * FROM tasks")->fetchAll();
    }

    public static function find($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject(Task::class);
    }

    public function save() {
        $db = Database::connect();
        if ($this->id) {
            $stmt = $db->prepare("UPDATE tasks SET title = ?, description = ?, status = ?, updated_at = ? WHERE id = ?");
            return $stmt->execute([$this->title, $this->description, $this->status, $this->updated_at, $this->id]);
        } else {
            $stmt = $db->prepare("INSERT INTO tasks (title, description, status, created_at) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$this->title, $this->description, $this->status, $this->created_at]);
        }
    }

    public static function destroy($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
