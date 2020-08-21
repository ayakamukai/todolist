<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Http\Requests\TodoRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TodoController extends Controller
{
    //一覧
    public function index(Request $request)
    {
        //ソート
        $status = $request->search;
        if(isset($status)){
            $todos = Todo::where('status', $status)->get();
        }else{
            $todos = Todo::all();
        }

        return view('todolist', ['todos' => $todos]);
    }

    //登録処理
    public function store(TodoRequest $request)
    {
        $todos = new Todo;
        $todos->content = $request->content;
        $todos->save();

        return redirect()->route('index')->with('status', 'Todoを追加しました');
    }

    // 変更処理
    public function update(Request $request, int $id)
    {
        try {
            $todo = Todo::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したTodoが存在しません']);
        }
            $todo->content = $request->content;
            $todo->status = $request->status;
            $todo->date = $request->date;
            $todo->save();
            return redirect()->route('index');
        }

    // 削除処理
    public function delete(Request $request, int $id)
    {   
        try {
            $todos = Todo::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したTodoが存在しません']);
        }
          $todos->delete();
          return redirect()->route('index')->with('status', 'Todoを消去しました');
        }

}
