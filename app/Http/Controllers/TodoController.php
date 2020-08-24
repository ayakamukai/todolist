<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Http\Requests\TodoRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

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
            $todo->content = $request->content;
            $todo->status = $request->status;
            $todo->date = $request->date;
            $todo->save();

            return redirect()->route('index');
    }

    // 全件更新
    public function doneAll(Request $request)
    {
        Todo::where('status', 0)->update(['status' => 1, 
                                        'date' => Carbon::now()]);

            return redirect()->route('index')->with('status', 'Todoを全件済みにしました');;
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

    // 全件削除
    public function deleteAll()
    {   
        Todo::query()->delete();
        return redirect()->route('index')->with('status', 'Todoを全件削除しました');
    }

}
