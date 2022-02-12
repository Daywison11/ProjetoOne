<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //retornando rota index mostrando os post
    public Function index()
    {
        //faz a paginação do index com no maximo de parametros passados no parentese foreach
        $posts = Post::paginate(5);

        //retorna a viw index
        return  view('admin.posts.index', compact(('posts')));
    }

    //retornando rota para crear post
    public function create()
    {
        //retorna o formulario de criação de post
        return view('admin.posts.create');
    }


    //criando post no db
    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();

        if($request->image->isValid()){
            //para edtar o nome nao hora de adcionar imagem
            $nameFile = Str::of($request->title)->slug('-') . ".". $request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('public/posts' ,$nameFile);
            $image = str_replace('public/','',$image);
            $data['image'] = $image;
        }

        //criando o post no db
        $post =  Post::create($data);

       return redirect()->route('post.index');
    }

    //detalhes do post
    public function show($id)
    {
        //verificando se existe o post como id passado caso exista retorna uma viw com os detalhes
        if (!$post = Post::find($id)){
            return redirect()->route('post.index');
        }
        else{

            return view('admin.posts.show',compact('post'));
        };
    }

    //deletar post
    public function destroy($id)
    { //--find-- recupera um item pelo id
       if (!$post = Post::find($id)){
           return redirect()-> route('post.index');
       }

       //verifica se o post existe e exclui a imagem atribuida ao post
       if(Storage::exists($post->image)){
            Storage::delete($post->image);
       }

       $post->delete();

       return redirect()->route('post.index');
    }


    //Formulario de edição
    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post = Post::find($id)) {
            return redirect()->back();
        } else {
            return view('admin.posts.edit',compact('post'));
        }

    }

    //edição do post no db
    public function update( StoreUpdatePost $request , $id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if($request->image && $request->image->isValid()){
            if(Storage::exists($post->image)){
                Storage::delete($post->image);
            }
            //memo esquema do create só que aqui antes de adcionar ele exclui o post antigo e cria um novo
            $nameFile = Str::of($request->title)->slug('-') . ".". $request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('public/posts' ,$nameFile);
            $image = str_replace('public/','',$image);
            $data['image'] = $image;
        }

        //adiciona o post ja edtado no db
        $post->update($data);

        return redirect()->route('post.index');
    }


    //filtragem por nome e conteudo
    public function search(StoreUpdatePost $request)
    {
        $filters = $request->except('_token');
        //pesquisa o nome no comesso e no final do titulo do post
        $posts = Post::where('title','=', "{$request->search}")
            //psquisa o titulo no começo e no final do post
            ->orwhere('content','=', "{$request->search}")
            ->paginate(5);
        //apos a pesquisa retorna a pagina index so que com os resultados
        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
