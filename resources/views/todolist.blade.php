<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>To Do List</title>

        <style type="text/css">
        .invalid-feedback{
          display: block;
        }
        
        .status{
          text-decoration: line-through;
        }
        </style>

<div class="container">
  <div class="m-2 p-3 bg-white">
    <h3 class="mb-5">ToDo</h3>

    <div class="container mb-5">
    <div class="form-group row">
      <form class="form-inline form-row w-100 m-3" action="{{ route('store') }}" method="post">
      {{ csrf_field() }}
        <div class="col">
          <label for="content" class="col" style="16px;"><h4>ToDo</h4></label>
        </div>
        <div class="col-9">
          <input type="text" class="form-control w-100 @if($errors->has('content')) is-invalid @endif" name="content" value="{{ old('content') }}" placeholder="内容">
        </div>
        <div class="col-2">
          <input type="submit" value="登録" class="btn btn-primary">
        </div>
      </form>
    </div>
      @if ($errors->has('content'))
        <div class="invalid-feedback offset-1 col-9">
          {{ $errors->first('content') }}
        </div>
      @endif
    </div>
      
      @foreach ($todos as $todo)
        <div class="row m-3" style="margin:0 auto;">
        @if( $todo->status == 0)
          <div class="form-group col-2">
            <form class="form-inline" action="{{ route('update', ['id' => $todo->id]) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <input type="hidden" name="content" value="{{ $todo->content }}">
              <input type="hidden" name="status" value="1">
              <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
              <button type="submit" class="btn btn-info">済</button>
            </form>
          </div>
          @elseif( $todo->status == 1)
          <div class="todo col-2">
            <sapn >{{ $todo->date }}</span>
          </div>
          @endif
          <div class="todo col-6">
            <sapn class="@if($todo->status == 1) status @endif">{{ $todo->content }}</span>
          </div>
          <div class="delete col-1">
            <a href="{{ route('delete', ['id' => $todo->id]) }}" class="">✕</a>
          </div>
        </div>
      @endforeach

  </div>
</div>

