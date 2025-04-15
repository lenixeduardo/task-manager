document.addEventListener('DOMContentLoaded', function () {
    loadTasks();

    const taskForm = document.getElementById('taskForm');
    taskForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const taskId = document.getElementById('taskId').value;
        const taskTitle = document.getElementById('taskTitle').value;
        const taskDescription = document.getElementById('taskDescription').value;
        
        if (taskId) {
            updateTask(taskId, taskTitle, taskDescription);
        } else {
            createTask(taskTitle, taskDescription);
        }
    });
});

function loadTasks() {
    fetch('http://localhost:9000/tasks')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#tasksTable tbody');
            tableBody.innerHTML = '';
            data.forEach(task => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${task.title}</td>
                    <td>${task.status}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editTask(${task.id})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteTask(${task.id})">Excluir</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        });
}

function createTask(title, description) {
    fetch('http://localhost:9000/tasks', {
        method: 'POST',
        body: JSON.stringify({ title, description }),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(() => {
        loadTasks();
        resetForm();
    });
}

function updateTask(id, title, description) {
    fetch(`http://localhost:9000/tasks/${id}`, {
        method: 'PUT',
        body: JSON.stringify({ title, description, status: 'pendente' }),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(() => {
        loadTasks();
        resetForm();
    });
}

function deleteTask(id) {
    fetch(`http://localhost:9000/tasks/${id}`, { method: 'DELETE' })
        .then(response => response.json())
        .then(() => loadTasks());
}

function resetForm() {
    document.getElementById('taskForm').reset();
    document.getElementById('taskId').value = '';
}

function editTask(id) {
    fetch(`http://localhost:9000/tasks/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('taskId').value = data.id;
            document.getElementById('taskTitle').value = data.title;
            document.getElementById('taskDescription').value = data.description;
        });
}
