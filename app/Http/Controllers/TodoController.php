<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    //一覧
    public function index()
    {
        $todos = Todo::all();
        return view('todolist', ['todos' => $todos]);
    }

    //登録処理
    public function store(Request $request)
    {
        $todos = new Todo;
        $todos->content = $request->content;
        $todos->save();

        return redirect()->route('index');
    }

    // 変更処理
    public function update(Request $request, int $id)
    {
        // $categories = Category::findOrFail($id);
        // $categories->name = $request->name;
        // $categories->save();
        // return redirect()->route('category.index');
    }

    // 削除処理
    public function delete(Request $request, int $id)
    {   
        try {
            $todos = Todo::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定した予定が存在しません']);
        }
          $todos->delete();
          return redirect()->route('index')->with('status', '予定を消去しました！');
        }

}
