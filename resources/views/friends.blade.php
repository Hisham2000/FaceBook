<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{Auth::user()->name}}</title>
    <link rel="stylesheet" href="{{URL::asset('assets/Css/Profile.css') }}">
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
    <div class="cover">
        <img style="width: 100%;height: 100;">
    </div>

    <div class="userData">
        <img 
                    @if($user['image'] == null)
                    
                    src="{{URL::asset('assets/Images/profile-user.png') }}" 
                            
                    @else
                        src="{{URL::asset('assets/User_image/'.$user['image'])}}"
                    @endif
                        alt="Profile picture" style="width: 20%;height: 100%; border-radius:50%">

        <p>{{$user['name']}}</p>
        <a href="{{route('user.edit',$user['id'])}}"><img src="{{URL::asset('assets/Images/edit.png')}}" class="userEditIcon"></a>
        @if ($relation == false)
            <form method="POST" action="{{ route('relation.store') }}">
                @csrf
                @method('post')
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="friend" value="{{$user['id']}}">
                <input type="submit" value="Send friend Requset">
            </form>
        @endif
        
    </div>

    @if(!empty($posts))
        <div class="posts">
            @php
                $i = count($posts);
                $j = 0;
            @endphp
        
            @foreach ($posts as $value)
            <div class="postHead">
                <img 
                    @if($user["image"] == null)
                    
                    src="{{URL::asset('assets/Images/profile-user.png') }}" 
                            
                    @else
                        src="{{URL::asset('assets/User_image/'.$user['image'])}}"
                    @endif
                        alt="Profile picture" style="width: 5%;height: 100%;border-radius:50%">

                <p class="PostUser">{{$user["name"]}}</p>    
            </div>
            <p class="pData"> 
                @php print_r($value["content"]);@endphp
            </p>
            @php
                $image = $value["image"];
            @endphp
            @if ($image)
            <img src="{{ URL::asset('assets/Post_image/'.$image) }}" class="PostPhoto" >
            @endif
            @php $j++; @endphp
                @if ($j != $i)
                    <hr>
                @endif
            @endforeach

        </div>
    @endif
</body>
</html>
