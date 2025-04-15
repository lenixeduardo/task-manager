export function fetchTasks() {
    return fetch('http://localhost:9000/tasks')
        .then(response => response.json());
}

export function createTask(title, description) {
    return fetch('http://localhost:9000/tasks', {
        method: 'POST',
        body: JSON.stringify({ title, description }),
        headers: { 'Content-Type': 'application/json' }
    });
}

export function updateTask(id, title, description) {
    return fetch(`http://localhost:9000/tasks/${id}`, {
        method: 'PUT',
        body: JSON.stringify({ title, description, status: 'pendente' }),
        headers: { 'Content-Type': 'application/json' }
    });
}

export function deleteTask(id) {
    return fetch(`http://localhost:9000/tasks/${id}`, { method: 'DELETE' });
}
