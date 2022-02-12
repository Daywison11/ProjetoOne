@extends('admin.layouts.app')
@section('title',' listagem dos posts-')

@section('content')
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
    <h2>{{$post -> title}} </h2>
    <img src="{{ url("storage/{$post->image}") }}" alt="{{$post->image}}" style='width: 100px;'>
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


@endsection
