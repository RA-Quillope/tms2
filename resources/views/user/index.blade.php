@extends('layout')
@section('main-content')
    <div class="float-start mb-3">
        <h3>Users</h3>
    </div>

    {{-- Add user button --}}
    <div class="float-end" data-bs-toggle="modal" data-bs-target="#add-user-modal">
        <button type="button" class="btn btn-primary" id="add-user">Add user</button>
    </div>

    {{-- Modal --}}
    <div class="modal" id="add-user-modal" tabindex="-1" aria-labelledby="add-user-modal-label">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-user-modal-label">New user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="user-form">
                        <span class="text-danger" id="userFormError">All fields are required</span>

                        <div class="row mb-3">
                            <label for="firstname" class="col-sm-3 col-form-label">
                                First Name
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="firstname">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lastname" class="col-sm-3 col-form-label">
                                Last Name
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lastname">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add-modal">Add</button>
                    <button type="button" class="btn btn-primary" id="save-modal">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- User Tasks Modal --}}
    <div class="modal" id="user-tasks" tabindex="-1" aria-labelledby="user-tasks-label">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="user-tasks-label">New user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            {{-- Show User Tasks Ajax Here --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div id="user-data" class="user-table-container">
        @include('user.pagination')
    </div>


@endsection
