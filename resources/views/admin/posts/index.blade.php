<a href="{{ route('create.posts') }}">criar novo post</a>
<br><br><br>
<form action="{{ route('posts.search')}}" method="POST">
    @csrf
    <input type="text" name="search" placeholder="pesquisar">
    <input type="submit" value="Buscar">
</form>

<h1>Posts</h1>
@foreach ($posts as $post )
    <hr>
    <p>{{$post -> title}} </p>
    <p>
        [<a href="{{ route('posts.show',$post->id ) }}">detahes</a> ||
        <a href="{{ route('posts.edit',$post->id ) }}">Edit</a>]
    </p>

@endforeach
<hr>

@if (isset($filters))

    {{ $posts->appends($filters)->links() }}
@else
    {{ $posts->links() }}

@endif

