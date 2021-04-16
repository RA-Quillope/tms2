@extends('layout')
@section('main-content')
    <div class="float-start mb-3">
        <h3>Tasks</h3>
    </div>

    {{-- Add task button --}}
    <div class="float-end" data-bs-toggle="modal" data-bs-target="#task-modal">
        <button type="button" class="btn btn-primary" id="add-task">Add task</button>
    </div>

    {{-- Modal --}}
    <div class="modal" id="task-modal" tabindex="-1" aria-labelledby="task-modal-label">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="task-modal-label">New task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="task-form">
                        <div class="row mb-3">
                            <label for="title-form" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title-form">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="desc-form" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="desc-form">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="user_for_task" class="col-sm-2 col-form-label">User</label>
                            <div class="col-sm-10">
                                <select id="user_id" class="form-select">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->firstname . ' ' . $user->lastname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add-task-modal">Add</button>
                    <button type="button" class="btn btn-primary" id="save-task-modal">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div id="task-data" class="task-table-container">
        @include('task.pagination')
    </div>


@endsection
