<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>

</head>
<body>
    <div class="container">
        <h2>User Register</h2>
        <form action="/register" method="POST">

            <label for="name">Complete Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter your name" />

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required placeholder="Enter your e-mail" />

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="8" placeholder="Enter your password" />

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required minlength="8" placeholder="Confirm Password" />

            <button type="submit">Register</button>
        </form>
    </div>

</body>
</html>
