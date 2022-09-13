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

    <div class="cover">
        <img style="width: 100%;height: 100;">
    </div>

    <div class="userData">
        <img 
                    @if(Auth::user()->user_image == null)
                    
                    src="{{URL::asset('assets/Images/profile-user.png') }}" 
                            
                    @else
                        src="{{URL::asset('assets/User_image/'.Auth::user()->user_image)}}"
                    @endif
                        alt="Profile picture" style="width: 20%;height: 100%; border-radius:50%">

        <p>{{Auth::user()->name}}</p>
        <a href="{{route('user.edit',Auth::user()->id)}}"><img src="{{URL::asset('assets/Images/edit.png')}}" class="userEditIcon"></a>
    </div>

    <div class="create">
        <h1>Create post</h1>
        <form enctype="multipart/form-data" method="POST" action="{{route('posts.store')}}">
            @csrf
            @method('post')
            <textarea required name="content" placeholder="What is in your Mind"></textarea>
            <input name="image" type="file">
            <input name="submit" type="submit" value="Create">
        </form>
        
    </div>


    @if($data != null)
        <div class="posts">
            @php
                $i = count($data);
                $j = 0;
            @endphp
        
            @foreach ($data as $value)
            <div class="postHead">
                <img 
                    @if(Auth::user()->user_image == null)
                    
                    src="{{URL::asset('assets/Images/profile-user.png') }}" 
                            
                    @else
                        src="{{URL::asset('assets/User_image/'.Auth::user()->user_image)}}"
                    @endif
                        alt="Profile picture" style="width: 5%;height: 100%;border-radius:50%">

                <p class="PostUser">{{Auth::user()->name}}</p>    
                <a href="{{route('posts.edit',$value->id)}}"><img src="{{URL::asset('assets/Images/edit.png')}}" class="userEditIcon"></a>
                <form method="POST" action="{{route('posts.destroy',$value->id)}}">
                    @csrf
                    @method('Delete')
                    <input style="width: 3%; float: right; " type="image" src="{{URL::asset('assets/Images/delete.png')}}">
                </form>

                @if ($value->isprivate == 0)
                    <form method="POST" action="{{route('private')}}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$value->id}}">
                        <input type="submit" value="Make Private">
                    </form>
                @else
                    <form method="POST" action="{{route('public')}}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$value->id}}">
                        <input type="submit" value="Make public">
                    </form>
                @endif


                
            </div>
            <p class="pData"> 
                @php print_r($value->content);@endphp
            </p>
            @php
                $image = $value->post_image;
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