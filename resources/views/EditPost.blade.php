<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ URL::asset('assets/Css/EditPost.css')}}" rel="stylesheet">
    
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

    <div class="container">
        <p class="display-3 text-center">Edit post</p>
        <form enctype="multipart/form-data" method="POST" action="{{route('posts.update',$post['post_id'])}}">
            @csrf
            @method('PUT')
            <div class="md-form mb-4">
                <textarea name="content" placeholder="What is in your Mind"  id="form18" class="md-textarea form-control" rows="3" required style="font-size: 20px">{{$post['content']}}</textarea>
            </div>
            @if ($post['post_image'] !=null)
            <img class="img-fluid" src="{{ URL::asset('assets/Post_image/'.$post['post_image']) }}" style="width: 50%; margin:auto; display: block; border-radius: 5%">
            @endif
            <div class="input-group col-md-8 mx-auto" style="width: 50%; margin-bottom: 2%;margin-top:2%">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <input class="btn btn-primary" name="submit" type="submit" value="Save" style="width: 50%;font-size: 20px;margin: 1% auto;display: block">
        </form>
        
    </div>
</body>
</html>