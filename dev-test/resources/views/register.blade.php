<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>

    <link rel="stylesheet"

</head>
<body>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    <div class="container">
        <h2>User Register</h2>
        <form action="/register" method="POST">

    <div class="form-group">
            @csrf
            <label for="name">Complete Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter your name" />
            <br>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required placeholder="Enter your e-mail" />
            <br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="8" placeholder="Enter your password" />
            <br>

            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8" placeholder="password_confirmation"/>
            <br>
    </div>
            <button type="submit">Register</button>
        </form>
    </div>

</body>
</html>
