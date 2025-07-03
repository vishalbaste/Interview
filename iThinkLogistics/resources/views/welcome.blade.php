<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.min.css" rel="stylesheet">
        <style>
            #preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: none;
            }
            #loader {
                display: block;
                position: relative;
                left: 50%;
                top: 50%;
                width: 150px;
                height: 150px;
                margin: -75px 0 0 -75px;
                border-radius: 50%;
                border: 3px solid transparent;
                border-top-color: #9370DB;
                -webkit-animation: spin 2s linear infinite;
                animation: spin 2s linear infinite;
            }
            #loader:before {
                content: "";
                position: absolute;
                top: 5px;
                left: 5px;
                right: 5px;
                bottom: 5px;
                border-radius: 50%;
                border: 3px solid transparent;
                border-top-color: #BA55D3;
                -webkit-animation: spin 3s linear infinite;
                animation: spin 3s linear infinite;
            }
            #loader:after {
                content: "";
                position: absolute;
                top: 15px;
                left: 15px;
                right: 15px;
                bottom: 15px;
                border-radius: 50%;
                border: 3px solid transparent;
                border-top-color: #FF00FF;
                -webkit-animation: spin 1.5s linear infinite;
                animation: spin 1.5s linear infinite;
            }
            @-webkit-keyframes spin {
                0%   {
                    -webkit-transform: rotate(0deg);
                    -ms-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    -ms-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
            @keyframes spin {
                0%   {
                    -webkit-transform: rotate(0deg);
                    -ms-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    -ms-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
        </style>
    </head>
    <body class="container">
       <div class="d-flex mt-2 mb-2" style="justify-content: space-between">
            <h2>User Management</h2>
            <a href="{{ url('/') }}/add"><button class="btn btn-primary btn-sm">Add User</button></a>
       </div>
       <div>
            <table id="users" class="table table-striped">
                <thead>
                    <tr class="table-primary">
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
       </div>
       <div id="preloader">
            <div id="loader"></div>
       </div>
       <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
       <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
       <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js"></script>
    </body>
    <script>
        const baseUrl = "{{ url('/') }}";

        class App
        {
            getUsers(callback)
            {
                fetch(`${baseUrl}/api/users`)
                .then(response =>
                {
                    if (!response.ok)
                        throw new Error('Failed to fetch users');

                    return response.json();
                })
                .then(data => callback(data))
                .catch(error => console.error('Error:', error));
            }

            setUsers()
            {
                app.getUsers(data =>
                {
                    let html = data.reduce((htm,{id,name,email,created_at},index) => htm += `<tr data-id="${id}">
                        <td>${++index}</td>
                        <td>${name}</td>
                        <td>${email}</td>
                        <td>${created_at}</td>
                        <td>
                            <div>
                                <button type="button" class="btn btn-outline-primary edit"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-outline-danger delete"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>`,'');

                    $('#users').DataTable().destroy();
                    $('#users tbody').html(html);
                    this.deleteUser('.delete');
                    this.editUser('.edit');
                    $('#users').DataTable();
                });
            }

            editUser(selector)
            {
                $(selector).click(({ currentTarget }) =>
                {
                    $('#preloader').show();
                    let id = $(currentTarget).closest('tr').data('id');

                    window.location.href = baseUrl +'/edit/'+id;
                });
            }

            deleteUser(selector)
            {
                $(selector).click(({ currentTarget }) =>
                {
                    $('#preloader').show();
                    let id = $(currentTarget).closest('tr').data('id');

                    fetch(`${baseUrl}/api/users/${id}`,
                    {
                        method: 'DELETE',
                        headers:
                        {
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(response =>
                    {
                        $('#preloader').hide();
                        if (!response.ok)
                            throw new Error('Failed to delete user');

                        return response.json();
                    })
                    .then(({message}) =>
                    {
                        Swal.fire({
                            title: "Success",
                            text: message,
                            icon: "success"
                        });

                        this.setUsers();
                    })
                    .catch(({message}) =>
                    {
                        Swal.fire({
                            title: "Error",
                            text: message,
                            icon: "error"
                        });
                    });
                });
            }
        }

        const app =new App();
              app.setUsers();
    </script>
</html>
