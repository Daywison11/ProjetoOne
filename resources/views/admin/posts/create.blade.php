@extends('admin.layouts.app')
@section('title' , 'cadastro de post - ')

@section('content')
    <h1>Cadastrar Novo Post</h1>

    <form action="{{ route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.posts.partials.form')
    </form>

@endsection
