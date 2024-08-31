document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        addTask();
    }
})
function addTask() {
    const task = document.getElementById('taskInput').value;
    axios.post('/tasks', { task })
        .then(response => {
            const taskList = document.getElementById('taskList');
            taskList.innerHTML += `<li id="li${response.data.id}">
                <input type="checkbox" onclick="toggleTask(${response.data.id}, this)">
                ${response.data.task}
                <button class="d-none" onclick="confirmDeleteTask(${response.data.id})">Delete</button>
            </li>`;
            document.getElementById('taskInput').value = '';
        })
        .catch(error => {
            alert(error.response.data.errors.task[0]);
        });
}

function toggleTask(taskId, checkbox) {
    axios.patch(`/tasks/${taskId}`, { is_completed: checkbox.checked })
        .then(response => {
            console.log('Task updated');
            document.getElementById("li"+taskId).style.display = "none"
        });
}

function confirmDeleteTask(taskId) {
    if (confirm('Are you sure to delete this task?')) {
        deleteTask(taskId);
    }
}

function deleteTask(taskId) {
    axios.delete(`/tasks/${taskId}`)
        .then(response => {
            document.getElementById("delId"+taskId).style.display = "none";
            document.getElementById("li"+taskId).style.display = "none"
        });
}

function showAllTasks() {
    axios.get('/tasks')
        .then(response => {
            const taskList = document.getElementById('taskListShow');
            taskList.innerHTML = '';
            response.data.forEach(task => {
                taskList.innerHTML += `<li class="mt-2" id="delId${task.id}">
                    ${task.is_completed ? '<span class="badge bg-primary">Completed</span>' : '<span class="badge bg-secondary">Not Complete</span>'}
                    ${task.task}
                    <button class="btn btn-warning" onclick="confirmDeleteTask(${task.id})">Delete</button>
                </li>`;
            });
        });
}