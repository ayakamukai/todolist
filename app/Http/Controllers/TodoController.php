<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
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
     public function store(TodoRequest $request)
     {
         $todos = new Todo;
         $todos->content = $request->content;
         $todos->save();
 
         return redirect()->route('index')->with('status', 'Todoを追加しました');
     }
}