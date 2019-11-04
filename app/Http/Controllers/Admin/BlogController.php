<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Blog;
use App\History;

use Carbon\Carbon;

class BlogController extends Controller
{
    public function add(){
        return view('admin.blog.create');
    }
    
    //ユーザーが入力したE-mail、パスワード、名前、住所などがRequestクラスに入ってくるイメージ。thisはこの情報を利用できる
    public function create(Request $request){
        
        $this->validate($request, Blog::$rules);
        
        $blog = new Blog;
        $form = $request->all();
        
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $blog->image_path = basename($path);
        } else {
            $blog->image_path = null;
        }
        
        unset($form['_token']);
        unset($form['image']);
        
        
        $blog->fill($form);
        $blog->save();
    
        return redirect('admin/blog/create');
        
    }
    
    public function index(Request $request){
        $cond_title = $request->cond_title;
        
        if ($cond_title != ''){
            $posts = Blog::where('title', $cond_title)->get();
        } else {
            $posts = Blog::all();
        }
        //admin/blogs/index.blade.phpに$posts、$cond_titleの変数の内容を渡す
        return view('admin.blog.index',['posts' => $posts, 'cond_title' => $cond_title]);
        
    }
    
    public function edit(Request $request){
        $blog = Blog::find($request->id);
        if (empty($blog)){
            abort(404);
        }
        return view('admin.blog.edit',['blogs_form' => $blog ]);
    }
    
    public function update(Request $request){
        
        $this->validate($request, Blog::$rules);
        $blog = Blog::find($request->id);
        $blog_form = $request->all();
        
        //削除されていた場合
        if ($request->remove == 'true') {
            $blog_form['image_path'] = null;
        //画像が変更になっている場合
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $blog_form['image_path'] = basename($path);
        //画像に変更がない場合、前回のファイルをそのまま入れる
        } else {
            $blog_form['image_path'] = $blog->image_path;
        }

        unset($blog_form['_token']);
        unset($blog_form['image']);
        unset($blog_form['remove']);
        $blog->fill($blog_form)->save();
        
        //以下編集履歴を保存する処理
        $history = new History;
        $history->blog_id = $blog->id;
        $history->edited_at = Carbon::now();
        $history->save();
        
        return redirect('admin/blog/index');
    }
    
    public function delete(Request $request) {
        $blog = Blog::find($request->id);
        $blog->delete();
        
        return redirect('admin/blog/index');
    }
    
    
}
