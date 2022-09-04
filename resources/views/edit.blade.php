<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="{{ URL::asset('assets/Css/Register.css')}}" rel="stylesheet">
</head>
<body>
    <h1>Edit</h1>
    <div>
        <h2>Edit Your account</h2>
        <p>it's quickly and easy</p>
        <hr style="color: darkgray;" >
        <form method="POST" enctype="multipart/form-data" action="{{ route('user.update',Auth::user()->id) }}">
            @csrf
            @method('put')
            <br>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <input type="text" name="name" placeholder="Name...." required value="{{$user['name']}}">
            <input type="text" name="email" placeholder="Mobile number or email adress" required value="{{$user['email']}}">
            @if (Auth::user()->image !=null)
            <img src="{{ URL::asset('assets/User_image/'.Auth::user()->image) }}" style="width: 20%; margin:auto; display: block; border-radius: 50%">
            @endif
            <input type="file" name="image">
            <br>
            <br>
            <input type="submit" value="Confirm" name="submit">
        </form>
    </div>
</body>
</html>