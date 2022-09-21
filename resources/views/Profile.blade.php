<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{Auth::user()->name}}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{URL::asset('assets/Css/Profile.css') }}">
    <script src="https://kit.fontawesome.com/d9b8a6c327.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="nav fixed-top navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{route('posts.index')}} ">
                    <span class="fa-stack fa-lg text-primary">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-facebook fa-stack-1x"></i>
                    </span>
                </a>
                <form class="form-inline mr-sm-2" method="GET" action="{{route('search')}}">
                    @csrf
                    @method('GET')
    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-facebook"></i>
                            </span>
                        </div>
    
                        <input type="text" name="search" class="form-control"
                        placeholder="&#128269; Search Facebook" aria-label="Username" aria-describedby="basic-addon1" >
                    </div>
                    
                </form>
            


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

                <div class="collapse navbar-collapse " id="navbarNavDropdown">
                
                
                <ul class="nav navbar-nav list-group" style="margin-left: 20%; margin-right: 50%">

                    <li class=" nav nav-item navbar-nav">
                        <a class="nav-link" href="{{ route('user.index') }}"> 
                            <i class="fa fa-home fa-3x" aria-hidden="true"></i>
                        </a>
                    </li>
                    

                    <li class=" nav nav-item navbar-nav">
                        <a class="nav-link" href="{{ route('relation.index') }}"> 
                            <i class="fa-solid fa-user-group fa-3x" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>



                <ul class="nav navbar-nav list-group">
                    <li class="nav-item dropdown navbar-nav">
                        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="float-right" style="width: 45px; margin-left: 30px">
                                <img class="img-fluid" style="width: 100%;border-radius: 50%" 
                                    @if(Auth::user()->user_image == null)
                            
                                src="{{URL::asset('assets/Images/profile-user.png') }}" 
                                    
                                @else
                                    src="{{URL::asset('assets/User_image/'.Auth::user()->user_image )}}"
                                @endif
                                    alt="Profile picture" >
                            </div> 
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('posts.index')}}">Profile</a>
                            <form method="POST"  action="{{ route('logout') }}" >
                                @csrf
                                <input type="submit" value="Log Out" class="dropdown-item text-danger"  >
                            </form>
                            
                        </div>
                    </li>
                </ul>
                

            

            </div>

        </nav>

    
    <div class="cover" style="margin-top: 75px">
        <img style="width: 100%;height: 100">
    </div>

    <div class="container" style="width: 70%">
        <div class="row">
            <div class="col-sm-3">
                <img
                        @if(Auth::user()->user_image  == null)
                        
                        src="{{URL::asset('assets/Images/profile-user.png') }}" 
                                
                        @else
                            src="{{URL::asset('assets/User_image/'.Auth::user()->user_image )}}"
                        @endif
                            alt="Profile picture" style="width: 100%;height: 100%; border-radius:50%">
            </div>
                
            <div class="col-sm-9" >
                <p class="lead" style="font-size: 35px;display: inline-block;margin-right: 2%">{{Auth::user()->name}}</p>
                <a href="{{route('user.edit',Auth::user()->id)}}"><i class="fa-regular fa-pen-to-square"></i></i></a>
            </div>
        </div>
    </div>

    <div class="container create">
        <h1 class="display-4">Create post</h1>
        <form enctype="multipart/form-data" method="POST" action="{{route('posts.store')}}">
            @csrf
            @method('post')
            <div class="md-form mb-4">
                <textarea name="content" placeholder="What is in your Mind"  id="form18" class="md-textarea form-control" rows="3" required style="font-size: 20px"></textarea>
            </div>

            <div class="input-group col-md-8 mx-auto" style="width: 50%">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <div class="container" style="margin-bottom: 20px">
                <div class="row" >
                    <div class="col text-center" >
                        <input name="submit" class="btn btn-primary" style="width: 50%;margin-top: 20px" type="submit" value="Create">
                    </div>
                </div>
            </div>
        </form>
        
    </div>


    @if($posts != null)
        <div class="container posts">
        
            @foreach ($posts as $post)
            <div class="row">
                {{-- <div class="col-sm-2">
                    <img class="img-fluid"
                    @if(Auth::user()->user_image  == null)
                        
                    src="{{URL::asset('assets/Images/profile-user.png') }}" 
                    @else
                        src="{{URL::asset('assets/User_image/'.Auth::user()->user_image )}}"
                    @endif
                        alt="Profile picture" style="border-radius:50%">
                </div> --}}
                    
                {{-- <div class="col-sm-5">
                    <p class="lead">{{Auth::user()->name}}</p>
                </div> --}}
                        
                <div class="col-sm-4 btn">
                    <a href="{{route('posts.edit',$post['post_id'])}}"><i class="fa-solid fa-pen-to-square"></i></a>
                </div>

                <div class="col-sm-4 btn">
                    <form method="POST" action="{{route('posts.destroy',$post['post_id'])}}">
                        @csrf
                        @method('Delete')
                        <button type="submit" class="text-danger btn" >
                            <i class="fa fa-trash" ></i>
                        </button>
                    </form>
                </div>
                    
                <div class="col-sm-4 btn">
                    @if ($post['isprivate'] == 0)
                        <form method="POST" action="{{route('private')}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$post['post_id']}}">
                            <input class="btn btn-danger" type="submit" value="Make Private">
                        </form>
                    @else
                        <form method="POST" action="{{route('public')}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$post['post_id']}}">
                            <input type="submit" class="btn btn-success" value="Make public">
                        </form>
                    @endif
                </div>
            </div>

            <p class="lead" style="font-size: 25px"> 
                @php print_r($post['content']);@endphp
            </p>
            
            @if ($post['post_image'])
            <img src="{{ URL::asset('assets/Post_image/'.$post['post_image']) }}" class="PostPhoto" >
            @endif
            
                {{-- @if ($like == null || in_array($post['post_id'],$like))
                    <form method="POST" action="{{route('like.store')}}">
                        @csrf
                        @method('POST')
                        <input type="hidden" value="{{$post['post_id']}}" name="post_id">
                        <input type="submit" value="Like">
                    </form>
                @else
                    <form method="POST" action="{{route('like.destroy',$post['post_id'])}}">
                        @csrf
                        @method('Delete')
                        <input type="hidden" value="{{$post['post_id']}}" name="post_id">
                        <input type="submit" value="DisLiKe">
                    </form>
                @endif --}}
            
                @if (next($posts))
                    <hr>
                @endif
            @endforeach 
        </div>
    @endif
</body>
</html>