<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class PostController extends Controller
{
    //retornando rota index mostrando os post
    public Function index()
    {
        $posts = Post::paginate(5);


        return  view('admin.posts.index', compact(('posts')));
    }

    //retornando rota para crear post
    public function create()
    {
        return view('admin.posts.create');
    }


    //criando post no db
    public function store(Request $request)
    {
       $post =  Post::create($request->all());

       return redirect()->route('post.index');
    }

    //detalhes do post
    public function show($id)
    {
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

       $post->delete();

       return redirect()->route('post.index');
    }


    //edtar post
    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post = Post::find($id)) {
            return redirect()->back();
        } else {
            return view('admin.posts.edit',compact('post'));
        }

    }

    public function update( Request $request , $id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->back();
        }
        $post->update($request->all());

        return redirect()->route('post.index');
    }


    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $posts = Post::where('title','=', "{$request->search}")
            ->orwhere('content','=', "{$request->search}")
            ->paginate(5);

        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
