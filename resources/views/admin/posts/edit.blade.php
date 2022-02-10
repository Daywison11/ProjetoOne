<h1 style="color: gray">Editar <strong style="color: black"> {{ $post->title }}</strong></h1>

<form action="{{ route('posts.update', $post->id)}}" method="post">
    @csrf
    @method('put')
    <label for="title">titulo:</label>
    <input type="text" name="title" id="title" value="{{$post->title}}">
    <textarea name="content" id="content" cols="30" rows="4" placeholder="conteudo" >{{$post->content}}</textarea>
    <input type="submit" value="enviar">
</form>
