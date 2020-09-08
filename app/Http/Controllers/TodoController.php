<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class TodoController extends Controller
{
     //一覧
     public function index(Request $request)
     {
        //ソート
        $status = $request->search;
        if(isset($status) && is_numeric($status)){
          if($status == 1 || $status == 0){
            $todos = Todo::where('status', $status)->get();
          }else{
            $todos = Todo::all();
            $status = null;
          }
        }else{
            $todos = Todo::all();
            $status = null;
        }

        //未済があるか
        $yet = Todo::where('status', 0)->first();
        if(empty($yet)){
            $selected = 'selected';
        }else{
            $selected = '';
        }

         return view('todolist', ['todos' => $todos, 'status' => $status, 'selected' => $selected]);
     }
 
     //登録処理
     public function store(TodoRequest $request)
     {
         $todos = new Todo;
         $todos->content = $request->content;
         $todos->status = 0;
         $todos->save();
 
         return redirect()->route('index')->with('success', 'Todoを追加しました');
     }

    // 変更処理
    public function update(Request $request, int $id)
    {
        try {
            $todo = Todo::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したTodoが存在しません']);
        }
            $todo->update(['status' => 1,
                            'date' => Carbon::now()]);
            return redirect()->route('index')->with('status', 'Todo達成！');
    }

    // 全件更新
    public function doneAll(Request $request)
    {
        Todo::where('status', 0)->update(['status' => 1, 
                                        'date' => Carbon::now()]);
            return redirect()->route('index')->with('status', 'Todoを全件済みにしました');;
    }

    // 削除処理
    public function delete(int $id)
    {   
        try {
            $todos = Todo::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->withErrors(['ID' => '指定したTodoが存在しません']);
        }
          $todos->delete();
          return redirect()->route('index')->with('success', 'Todoを消去しました');
    }

    // 全件削除
    public function deleteAll(Request $request)
    {   
        Todo::query()->delete();
        return redirect()->route('index')->with('success', 'Todoを全件削除しました');
    }

}
