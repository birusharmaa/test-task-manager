<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Manager</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row shadow p-3 mb-5 bg-body rounded">
            <h1 class="text-center">Task Manager</h1>
            <div class="col-6 shadow mr-2 mb-5 bg-body rounded">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center">Add Task</h3>
                        <div class="mb-3 mt-3">
                            <label for="taskInput" class="form-label">Task</label>
                            <input type="text" class="form-control" id="taskInput" placeholder="Enter a task" name="taskInput">
                        </div>
                        <button onclick="addTask()" class="btn btn-success">Add Task</button>
                    </div>
                    <div class="col-12">
                        <hr/>
                        <h2>List Tasks</h2>
                        <ul id="taskList" style="list-style-type: none;"> 
                            @foreach ($tasks as $task)
                                <li id="li{{ $task->id }}">
                                    <input type="checkbox" {{ $task->is_completed ? 'checked' : '' }} onclick="toggleTask({{ $task->id }}, this)">
                                    {{ $task->task }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-6 shadow ml-2 mb-5 bg-body rounded">
                <div class="row">
                    <h3 class="text-center"> All Tasks With Status</h3>
                    <div class="col-12">
                        <button onclick="showAllTasks()" class="btn btn-info">Show All Tasks</button>
                        <ul id="taskListShow" style="list-style-type: none;">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/task.js') }}" defer></script>

</body>
</html>
