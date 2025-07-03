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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Raleway');

    body {
        background: #d2d6de;
        width: 100vw;
        height: 100vh;
        font-family: 'Raleway', sans-serif;
    }

    .info-text {
        font-size: 1rem;
    }

    .wrapper {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-box {
            background: #fff;
            width: 300px;
            height: 400px;
            box-shadow: 5px 5px 5px 1px rgba(0,0,0,0.1);
            text-align: center;
            padding: 20px;
    }

    .form-container {
        display: flex;
        flex-direction: column;
    }

    .form-container .input-addon {
        margin-top: 1.5rem;
    }

    .form-element {
        margin-top: 0.8rem;
        height: 1.5rem;
        border: 1px solid #d2d6de;
        padding: 5px;
        font-size: .9rem;
    }

    .form-element:focus {
        outline: 1px solid #673ab7;
    }

    .form-element::placeholder {
        font-family: 'Raleway', sans-serif;
        font-size: .8rem;
    }

    .form-element.is-submit {
        height: 3rem;
        font-size: 1rem;
        line-height: normal;
        font-family: 'Raleway', sans-serif;
        background: #673ab7;
        color: #fff;
    }

    .input-addon {
        display: flex;
    }

    .input-addon > .form-element {
        margin-top: 0;
    }

    .input-field {
        flex: 1;
    }

    .input-addon-item {
        padding: 5px;
        width: 35px;
        border: 1px solid #d2d6de;
        border-left: 0;
        background: #fff;
        color: #6a6b6d;
    }

    </style>
</head>

<body class="container">
    <div class="wrapper">
        <div class="login-box">
            <h3 class="info-text">Edit User</h3>
            <form class="form-container" action="#" id="userform">
                <div class="input-addon">
                    <input class="form-element input-field" name="name" placeholder="Name" type="text">
                    <button class="input-addon-item">
                        <span class="fa fa-user"></span>
                    </button>

                </div>
                <div class="input-addon">
                    <input class="form-element input-field" name="email" placeholder="Email" type="email">
                    <button class="input-addon-item">
                        <span class="fa fa-envelope"></span>
                    </button>
                </div>
                <div class="input-addon">
                    <input class="form-element input-field" name="password" placeholder="Password" type="password">
                    <button class="input-addon-item">
                        <span class="fa fa-lock"></span>
                    </button>
                </div>
                <input class="form-element is-submit" type="submit" value="Submit">
            </form>
        </div>
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
    getUser(callback)
    {
        fetch(`${baseUrl}/api/users/{{ $id }}`)
        .then(response =>
        {
            if (!response.ok)
                throw new Error('Failed to fetch users');

            return response.json();
        })
        .then(data => callback(data))
        .catch(error => console.error('Error:', error));
    }

    setData()
    {
        this.getUser(({email,name}) =>
        {
            $('[name="name"]').val(name);
            $('[name="email"]').val(email);
        });
    }

    submit()
    {
        fetch(`${baseUrl}/api/users/{{ $id }}`,
        {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: $('[name="name"]').val(),
                email: $('[name="email"]').val(),
                password: $('[name="password"]').val()
            })
        })
        .then(async response => {
            if (!response.ok)
            {
                const error = await response.json();
                console.error('Update failed:', error);

                Swal.fire({
                    title: "Error",
                    text: 'Update failed',
                    icon: "error"
                });
            }
            else
            {
                const data = await response.json();

                Swal.fire({
                    title: "Success",
                    text: 'User Updated successfully!',
                    icon: "success"
                })
                .then(()=> window.location.href = '{{ url("/") }}');
                console.log('User updated:', data);
            }
        })
        .catch(error => console.error('Request error:', error));
    }
}

const edit =new App();
      edit.setData();


$('#userform').submit(()=>
{
    edit.submit();
    return false;
});
</script>

</html>