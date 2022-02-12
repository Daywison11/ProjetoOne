@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error )
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

<label for="title">Titulo:</label>
@csrf
@csrf

    <input type="file" name="image" id="image" >
    <input type="text" name="title" id="title" value="{{$post->title ?? old('Titulo')}}" >
    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteudo" >{{$post->content ?? old('content')}}</textarea>
    <input type="submit" value="enviar">
