<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{URL::to('/')}}/css/register.css">
</head>
<body>
    <div class="container">
       <div class="center"> 
        <div class="box" >
        <form action="{{URL::to('/')}}/login_action" method="post">
         @csrf
        
        <label for="email">Email :</label><br><input type="email"id="email" name="email" placeholder="Email"><br>
        @error('email')
             {{$message}}
         @enderror
        <label for="pwd">Password :</label><br><input type="password" id="pwd" name="password" placeholder="password"><br>
        @error('password')
             {{$message}}
         @enderror
       <br>
       @if (session()->has('error'))
    <div class="alert" role="alert">  
        {{ session('error') }}
      </div>
@endif
       
        <input type="submit"  value="Login" class="sub_btn"><br>
        <p>don't have account <a href="{{URL::to('/')}}/register">sign up</a></p>
     </form>  
     </div>
     <div class="illu"></div>
    </div>
    </div>
</body>
</html>