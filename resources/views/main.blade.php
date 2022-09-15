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
            <a href="{{route('user.index')}}" class="house"><img  src="{{URL::asset('assets/Images/House.png') }}" alt="Home icon" style="width: 100%;height: 100%;"></a>
            <a href="{{ route('relation.index') }}" class="friends" ><img  src="{{URL::asset('assets/Images/friends.png') }}" alt="friends icon" style="width: 100%;height: 100%;"></a>
        </div>
        <div class="right">
            <a>
                <img 
                    @if(Auth::user()->user_image == null)
                    
                    src="{{URL::asset('assets/Images/profile-user.png') }}" 
                            
                    @else
                        src="{{URL::asset('assets/User_image/'.Auth::user()->user_image)}}"
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
            
            @foreach ($posts as $post)
            <a href="{{route('posts.show',$post['post_id'])}}">
            <div class="postHead">
                <img 
                    @if($post['user_image'] == null)
                    
                    src="{{URL::asset('assets/Images/profile-user.png') }}" 
                            
                    @else
                        src="{{URL::asset('assets/User_image/'.$post['user_image'])}}"
                    @endif
                        alt="Profile picture" style="width: 5%;height: 100%;border-radius:50%">

                <p class="PostUser">{{$post['name']}}</p>    
                
            </div>
            <p class="pData"> 
                @php print_r($post['content']);@endphp
            </p>
            @php
                $image = $post['post_image'];
            @endphp
            @if ($image)
            <img src="{{ URL::asset('assets/Post_image/'.$image) }}" class="PostPhoto" >
            @endif


                @if(isset($post[0]))
                    <form method="POST" action="{{route('like.destroy',$post['post_id'])}}">
                        @csrf
                        @method('delete')
                        <input type="hidden" value="{{$post['post_id']}}" name="post_id">
                        <input type="submit" value="dislike">
                    </form> 
                    
                @else

                <form method="POST" action="{{route('like.store')}}">
                    @csrf
                    @method('POST')
                    <input type="hidden" value="{{$post['post_id']}}" name="post_id">
                    <input type="submit" value="Like">
                </form>

                @endif
                

                @if(next($posts)) <hr> @endif
        
        @endforeach
    </a>
    </div>
</body>
</html>