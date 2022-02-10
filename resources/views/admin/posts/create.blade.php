<h1>cadastrar novo post</h1>

<form action="{{ route('posts.store')}}" method="post">
    <input type="text" name="_token" value=" {{ csrf_token() }} ">
    <label for="title">titulo:</label>
    <input type="text" name="title" id="title">
    <textarea name="content" id="content" cols="30" rows="4" placeholder="conteudo"></textarea>
    <input type="submit" value="enviar">
</form>
