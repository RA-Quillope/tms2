<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Laravel</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    {{-- Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Task Management System v2.0</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="/user">Users</a>
                    <a class="nav-link active" aria-current="page" href="/">Tasks</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        @yield('main-content')
        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {

        let user_id;
        let task_id;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // USER PAGINATION
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_user_data(page);
        });

        function fetch_user_data(page) {
            $.ajax({
                url: "fetch_user_data?page=" + page,
                success: function(data) {
                    $('#user-data').html(data);
                }
            });
        }

        // TASK PAGINATION
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_task_data(page);
        });

        function fetch_task_data(page) {
            $.ajax({
                url: "fetch_task_data?page=" + page,
                success: function(data) {
                    $('#task-data').html(data);
                }
            });
        }

        //SHOW USER MODAL
        $(document).on('click', '#add-user', function(e) {
            $('#add-user-modal-label').text('New user')
            $('#add-modal').show();
            $('#save-modal').hide();
            $('#user-form').trigger("reset");
            $('#userFormError').hide();
        });

        //SHOW TASK MODAL
        $(document).on('click', '#add-task', function(e) {
            $('#task-modal').show();
            $('#add-task-modal').show();
            $('#save-task-modal').hide();
            $('#task-form').trigger("reset");
            $('#taskFormError').hide();
            $('#user-for-task').show();
        });

        // ADD USER
        $(document).on('click', '#add-modal', function(e) {
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            $.ajax({
                url: "/user",
                method: 'POST',
                data: {
                    firstname: firstname,
                    lastname: lastname
                },
                success: function(response) {
                    $('#add-user-modal').modal('hide');
                    $('.user-table-container').load("/fetch_user_data",
                        function() {
                            $('.user-table-container').fadeIn();
                        });

                },
                error: function(response) {
                    $('#userFormError').show();

                }
            });

        });

        // ADD TASK
        $(document).on('click', '#add-task-modal', function(e) {
            var title = $('#title-form').val();
            var desc = $('#desc-form').val();
            var user_id = $('#user_id').val();

            $.ajax({
                url: "/task",
                method: 'POST',
                data: {
                    title: title,
                    desc: desc,
                    user_id: user_id
                },
                success: function(response) {

                    $('#task-modal').modal('hide');
                    $('.task-table-container').load("/fetch_task_data",
                        function() {
                            $('.task-table-container').fadeIn();
                        });

                },
                error: function(response) {
                    $('#taskFormError').show();

                }
            });

        });

        //DELETE USER
        $(document).on('click', '#delete-user', function(e) {
            var id = $(this).data('id');

            $.ajax({
                url: 'user/' + id,
                method: 'DELETE',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response) {
                        $('.user-table-container').load("/fetch_user_data",
                            function() {
                                $('.user-table-container').fadeIn();
                            });
                    } else {
                        alert('Error')
                    }
                }
            });
        });

        //DELETE USER
        $(document).on('click', '#delete-task', function(e) {
            var id = $(this).data('id');
            $.ajax({
                url: 'task/' + id,
                method: 'DELETE',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response) {
                        $('.task-table-container').load("/fetch_task_data",
                            function() {
                                $('.task-table-container').fadeIn();
                            });
                    } else {
                        alert('Error')
                    }
                }
            });
        });

        //EDIT USER MODAL
        $(document).on('click', '#edit-user', function(e) {
            $('#add-user-modal-label').text('Edit user')
            $('#add-modal').hide();
            $('#save-modal').show();
            var firstname = $(this).data('firstname');
            var lastname = $(this).data('lastname');
            $('#firstname').val(firstname);
            $('#lastname').val(lastname);
            user_id = $(this).data('id');
            $('#userFormError').hide();
        });

        //EDIT TASK MODAL
        $(document).on('click', '#edit-task', function(e) {
            $('#task-modal-label').text('Edit task')
            $('#add-task-modal').hide();
            $('#save-task-modal').show();
            var title = $(this).data('title');
            var desc = $(this).data('desc');
            $('#title-form').val(title);
            $('#desc-form').val(desc);
            task_id = $(this).data('id');
            console.log(task_id)
            $('#taskFormError').hide();
            $('#user-for-task').hide();
        });


        //EDIT USER
        $(document).on('click', '#save-modal', function(e) {
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            $.ajax({
                url: 'user/' + user_id,
                method: 'PATCH',
                data: {
                    firstname: firstname,
                    lastname: lastname
                },
                success: function(response) {
                    if (response) {
                        $('#add-user-modal').modal('hide');
                        $('.user-table-container').load("/fetch_user_data",
                            function() {
                                $('.user-table-container').fadeIn();
                            });
                    } else {
                        alert('Error');
                    }
                }
            });
        });

        //EDIT TASK
        $(document).on('click', '#save-task-modal', function(e) {
            var title = $('#title-form').val();
            var desc = $('#desc-form').val();
            $.ajax({
                url: 'task/' + task_id,
                method: 'PATCH',
                data: {
                    title: title,
                    desc: desc
                },
                success: function(response) {
                    if (response) {
                        $('#task-modal').modal('hide');
                        $('.task-table-container').load("/fetch_task_data",
                            function() {
                                $('.task-table-container').fadeIn();
                            });
                    } else {
                        alert('Error');
                    }
                }
            });
        });

        //SHOW USER TASKS
        $(document).on('click', '#show-user', function(e) {
            $('#table-body').empty();
            var firstname = $(this).data('firstname');
            var id = $(this).data("id");
            var url = $(this).data("route");
            console.log(id)
            $('#user-tasks-label').text(firstname + "'s Tasks");
            $.ajax({
                url: url,
                success: function(data) {
                    $('#table-body').html(data);
                }
            });

        });

    });

</script>
