<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
    <link rel="stylesheet" href="{{url('css/styles.css')}}">
    <link rel="stylesheet" href="{{url('css/register.css')}}">
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
        <div class="title">
            <h2>User Register</h2>
        </div>

        <div class="account">
            <label>Already have an account?</label>
            <a href="{{url('/login')}}">Sign in</a> 
        </div>    

        <form action="/register" method="POST" id="registerform"> 
            @csrf

            <div class="form-group">
                <label for="name">Complete Name:</label>
                <input type="text" id="name" name="name" required placeholder="Your Name" value="{{ old('name') }}" />
                @if ($errors->has('name'))
                    <span style="color: red;">{{ $errors->first('name') }}</span>
                @endif
                <br>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required placeholder="Your E-mail" value="{{ old('email') }}" />
                @if ($errors->has('email'))
                    <span style="color: red;">{{ $errors->first('email') }}</span>
                @endif
                <br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required minlength="8" placeholder="Your Password" />
                <p>ℹ️ Password must be at least 8 characters.</p>
                @if ($errors->has('password'))
                    <span style="color: red;">{{ $errors->first('password') }}</span>
                @endif
                <br>

                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8" placeholder="Password Confirmation"/>
                @if ($errors->has('password_confirmation'))
                    <span style="color: red;">{{ $errors->first('password_confirmation') }}</span>
                @endif
                <br> 

            </div>
            
            <button class="button" type="submit">Register</button>    

        </form>
    </div>

</body>
</html>
