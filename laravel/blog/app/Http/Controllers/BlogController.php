<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     *ブログ一覧を表示する
     *
     *@return view
     */
    public function showList(){
        // ブログのデータを全部取り出す
        $blogs = Blog::all();

        // データをviewで返す
        return view('blog.list', ['blogs' => $blogs]);
    }

    /**
     *ブログ詳細を表示する
     *@param int $id
     *@return view
     */
    public function showDetail($id){
        $blog = Blog::find($id);

        if(is_null($blog)){
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }
        return view('blog.detail', ['blog' => $blog]);
    }

    /**
     *ブログ登録画面を表示する
     *
     *@return view
     */
    public function showCreate(){
        return view('blog.form');
    }

    /**
     *ブログを登録する
     *
     *@return view
     */
    public function exeStore(BlogRequest $request){
        // ブログのデータを受け取る
        $inputs = $request->all();
        // トランザクション
        \DB::beginTransaction();
        try{
            // ブログを登録
            Blog::create($inputs);
            // コミット
            \DB::commit();
        }catch(\Throwable $e){
            // 例外処理
            \DB::rollback();
            abort(500);
        }
        // メッセージ
        \Session::flash('err_msg', 'ブログを登録しました。');
        return redirect(route('blogs'));
    }

    /**
     *ブログ編集フォームを表示する
     *@param int $id
     *@return view
     */
    public function showEdit($id){
        $blog = Blog::find($id);

        if(is_null($blog)){
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }
        return view('blog.edit', ['blog' => $blog]);
    }

    /**
    *ブログを更新する
    *
    *@return view
    */
    public function exeUpdate(BlogRequest $request){
        // ブログのデータを受け取る
        $inputs = $request->all();
        // トランザクション
        \DB::beginTransaction();
        try{
            // ブログを更新する
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $blog->save();
            // コミット
            \DB::commit();
        }catch(\Throwable $e){
            // 例外処理
            \DB::rollback();
            abort(500);
        }
        // メッセージ
        \Session::flash('err_msg', 'ブログを更新しました。');
        return redirect(route('blogs'));
    }

    /**
     *ブログ削除
     *@param int $id
     *@return view
     */
    public function exeDelete($id){
        // データが空の場合
        if(empty($id)){
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }
        try{
            // ブログを削除
            $blog = Blog::destroy($id);
        }catch(\Throwable $e){
            // 例外処理
            abort(500);
        }
        // メッセージ
        \Session::flash('err_msg', '削除しました。');
        return redirect(route('blogs'));
    }
}
