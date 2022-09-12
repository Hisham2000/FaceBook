<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="{{ URL::asset('assets/Css/EditPost.css')}}" rel="stylesheet">
</head>
<body>
    <div class="create">
        <h1>Edit post</h1>
        <form enctype="multipart/form-data" method="POST" action="{{route('posts.update',$post['id'])}}">
            @csrf
            @method('PUT')
            <textarea required name="content" placeholder="What is in your Mind">
                {{$post['content']}}
            </textarea>
            @if ($post['image'] !=null)
            <img src="{{ URL::asset('assets/Post_image/'.$post['image']) }}" style="width: 50%; margin:auto; display: block; border-radius: 5%">
            @endif
            <input name="image" type="file">
            <input name="submit" type="submit" value="Create">
        </form>
        
    </div>
</body>
</html>