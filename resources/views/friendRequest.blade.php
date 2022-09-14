<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="{{ URL::asset('assets/Css/search.css')}}" rel="stylesheet">
    <title>View</title>
</head>
<body>
    <header>
        <div class="left">
            <a><img src="{{URL::asset('assets/Images/facebook.png') }}" alt="Facebook icon" style="width: 100%;height: 100%;"></a>
            <form method="GET" action="{{route('search')}}">
                @csrf
                @method('GET')
                <input type="text" name="search" placeholder="&#128269; Search Facebook">
            </form>
        </div>
        <div class="center">
            <a href="{{route('posts.index')}}" class="house"><img  src="{{URL::asset('assets/Images/House.png') }}" alt="Home icon" style="width: 100%;height: 100%;"></a>
            <a href="{{ route('relation.index') }}" class="friends" ><img  src="{{URL::asset('assets/Images/friends.png') }}" alt="friends icon" style="width: 100%;height: 100%;"></a>
        </div>
        <div class="right">
            <a>
                <img 
                    @if(Auth::user()->image == null)
                    
                    src="{{URL::asset('assets/Images/profile-user.png') }}" 
                            
                    @else
                        src="{{URL::asset('assets/User_image/'.Auth::user()->image)}}"
                    @endif
                        alt="Profile picture" style="width: 100%;height: 100%;border: 2px solid white; border-radius: 50%">
                </a>
                <form method="POST"  action="{{ route('logout') }}" >
                    @csrf
                    <input type="submit" value="Log Out">
                </form>
        </div>
    </header>
    @foreach ($friends as $friend )
    <a href="{{ route('user.show',$friend['id']) }}">
        <div class="userSearch">
            <img 
                        @if(empty($friend['user_image']))
                    
                        src="{{URL::asset('assets/Images/profile-user.png') }}" 
                            
                        @else
                            src="{{ URL::asset('assets/User_image/'.$friend['user_image'] )}}"
                        @endif
                            alt="Profile picture" style="width: 30%;height: 70%;border: 2px solid white; border-radius: 50%">
            <p class="name">{{$friend['name']}}</p> <br>
            <p class="data"> Email : {{$friend['email']}}</p> <br>
            <p class="data"> Porn at : {{$friend['bdate']}} </p> <br>
            <p class="data"> Gender: {{$friend['gender']}}</p> <br>
            <form method="POST" action="{{route('relation.update',$friend['id'])}}">
                @csrf
                @method('PUT')
                <input type="submit" value="Accept">
            </form>
            <form method="POST" action="{{route('relation.destroy',$friend['id'])}}">
                @csrf
                @method('DELETE')
                <input type="submit" value="Reject">
            </form>
        </div>
    </a>    
    @endforeach
</body>
</html>