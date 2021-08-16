<?php

namespace App\Http\Controllers;

use App\Post;
// use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('index')->with(['posts' => $post->getPaginateByLimit()]); // indexビューのpostsにPostのインスタンス$postのgetPaginateByLimitメソッドの返り値を代入して、ビューを返してる
    }

    public function show(Post $post)
    {
        return view("show")->with(['post' => $post]); // showビューのpostにPostのインスタンス$postを代入して、ビューを返してる
    }

    public function create()
    {
        return view("create"); //createというビューを返してる
    }

    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post']; // $inputにPostRequestのインスタンス$requestのpostをキーにもつリクエストパラメータを取得. createビューのタイトル&本文入力のname属性をname="post[title]"にしてるからpost？
        $post->fill($input)->save(); // $post->create($input)でもいい
        return redirect("/posts/" . $post->id); // リダイレクト処理(/posts/ブログid)
    }
    
    public function edit(Post $post)
    {
        return view("edit")->with(["post" => $post]); // editビューのpostにPostのインスタンス$postを代入して、ビュー返してる
    }
    
    public function update(Post $post, PostRequest $request)
    {
        $input = $request["post"]; // $inputにPostRequestのインスタンス$requestのpostをキーにもつリクエストパラメータを取得. editビューのタイトル&本文編集のname属性をname="post[title]"にしてるからpost？
        $post->fill($input)->save(); // $post->create($input)でもいい // updateメソッドでは未変更で全上書きされたり、Postクラスのfillableがチェックされない
        return redirect("/posts/" . $post->id); // リダイレクト処理(/posts/ブログid)
    }
}
