<table class="table table-dark table-hover">
    <thead>
        <tr>
            <th scope="col">User</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)

            <tr>
                <td class="col-md-3">{{ $task->user->firstname . ' ' . $task->user->lastname }}</td>
                <td class="col-md-3">{{ $task->title }}</td>
                <td class="col-md-3">{{ $task->desc }}</td>
                <td>
                    <button type="button" class="btn btn-warning" id="edit-task" data-bs-toggle="modal"
                        data-bs-target="#task-modal" data-id="{{ $task->id }}" data-title="{{ $task->title }}"
                        data-desc="{{ $task->desc }}" data-user_id="{{ $task->user_id }}">Edit</button>
                    <button type="button" class="btn btn-danger" id="delete-task"
                        data-id="{{ $task->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $tasks->links('pagination::bootstrap-4') }}
</div>
