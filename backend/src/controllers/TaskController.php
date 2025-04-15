<?php

namespace App\Controllers;

use App\Models\Task;
use App\Database\Database;

class TaskController {
    public function create($data) {
        $task = new Task();
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->status = 'pendente';
        $task->created_at = date('Y-m-d H:i:s');
        $task->updated_at = null;
        return $task->save();
    }

    public function getAll() {
        return Task::all();
    }

    public function update($id, $data) {
        $task = Task::find($id);
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->status = $data['status'];
        $task->updated_at = date('Y-m-d H:i:s');
        return $task->save();
    }

    public function delete($id) {
        return Task::destroy($id);
    }
}
