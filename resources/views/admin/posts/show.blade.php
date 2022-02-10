<h1>Detalhes do post</h1>
<ul>
    <li><strong>Titulo:</strong> {{$post->title}}</li>
    <li><strong>Conteudo:</strong> {{$post->content}}</li>
</ul>


<form action="{{ route('posts.destroy',$post->id) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" >Detetar <strong>{{$post->title}}</strong></button>
</form>