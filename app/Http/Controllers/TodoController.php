<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TodoController extends Controller
{
     //一覧
     public function index()
     {
         $todos = Todo::all();
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
            $todo->status = $request->status;
            $todo->update();
            return redirect()->route('index');
        }
}
