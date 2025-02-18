<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{url('css/styles.css')}}">
    <link rel="stylesheet" href="{{url('css/login.css')}}">

</head>
<body>
    @if ($errors->any())
    
        
        @foreach ($errors->all() as $error)
               <script> 
               alert("{{ $error }}")
               </script>
        @endforeach
        
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            <script> 
            alert("{{ session('success') }}")
            </script>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            <script> 
            alert("{{ session('error') }}")
            </script>
        </div>
    @endif



    <div class="container">
        
    <div class="title">
        <h2>Login</h2>
    </div>

    <div class="account">
        <label>Don't have an account yet?</label>
        <a href="{{url ('/register') }}">Register</a> 
    </div>   

        <form class="form-group" action="/login" method="POST">
            @csrf
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" require placeholder="Enter your E-mail">
            <br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" require placeholder="Enter your passoword">
            <br>
            
            <button class="button" type="submit">Login</button>
        </form>

    </div>
</body>
</html>