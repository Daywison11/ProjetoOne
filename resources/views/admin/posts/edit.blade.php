@extends('admin.layouts.app')

@section('content')
    <h1 style="color: gray">Editar <strong style="color: black"> {{ $post->title }}</strong></h1>

    <form action="{{ route('posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @include('admin.posts.partials.form')
    </form>

@endsection
