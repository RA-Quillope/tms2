<table class="table table-dark table-hover">
    <thead>
        <tr>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Number of tasks</th>
            <td class="col-md-3">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)

            <tr>
                <td class="col-md-3">{{ $user->firstname }}</td>
                <td class="col-md-3">{{ $user->lastname }}</td>
                <td class="col-md-3">{{ $user->tasks->count() }}</td>
                <td>
                    <button type="button" class="btn btn-success" id="show-user" data-bs-toggle="modal"
                        data-bs-target="#user-tasks" data-firstname="{{ $user->firstname }}"
                        data-id="{{ $user->id }}"
                        data-route="{{ route('fetch_user_tasks', $user->id) }}">Show</button>
                    <button type="button" class="btn btn-warning" id="edit-user"
                        data-firstname="{{ $user->firstname }}" data-lastname="{{ $user->lastname }}"
                        data-bs-toggle="modal" data-bs-target="#add-user-modal"
                        data-id={{ $user->id }}>Edit</button>
                    <button type="button" class="btn btn-danger" id="delete-user"
                        data-id={{ $user->id }}>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-4') }}
</div>
