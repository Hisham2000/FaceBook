<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('assets/Css/ShowPost.css') }}">
    <title>{{Auth::user()->name}} Post</title>
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

    <div class="posts"> 
        <div class="postHead">
            <img 
                @if(Auth::user()->user_image == null)
                    src="{{URL::asset('assets/Images/profile-user.png') }}" 
                @else
                    src="{{URL::asset('assets/User_image/'.Auth::user()->user_image)}}"
                @endif
                    alt="Profile picture" style="width: 5%;height: 100%;border-radius:50%">
            <p class="PostUser">{{Auth::user()->name}}</p>    
        </div>

        <p class="pData">{{$post['content']}}</p>
        @if ($post['post_image'])
            <img src="{{ URL::asset('assets/Post_image/'.$post['post_image']) }}" class="PostPhoto" >
        @endif
    </div>

    <div class="comments">

        <div class="create-comment">
            <form method="POST" action="{{route('comment.store')}}">
                @csrf
                @method('Post')
                <textarea name="content" placeholder="Put your comment Here"></textarea>
                <input type="hidden" name="post_id" value="{{$post['post_id']}}">
                <input type="submit" value="Save Comment">
            </form>
        </div>

        <div class="comments-data">
            @if ($comments == null)
                <p>There is no comments yet Put Your first comment</p>
            @else
                @foreach ($comments as $comment )
                    <p>{{$comment['content']}}</p>
                @endforeach
            @endif


        </div>
        

    </div>
</body>
</html>