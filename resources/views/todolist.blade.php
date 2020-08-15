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


        </style>

<div class="container">
  <h4>ToDo</h4>

    <form class="form-inline" action="{{ route('store') }}" method="post">
      {{ csrf_field() }}

      <div class="form-group row">
        <label for="title" class="col-3 col-form-label">ToDo</label>
          <div class="col-6">
            <input type="text" class="form-control @if($errors->has('content')) is-invalid @endif" name="content" value="{{ old('content') }}">
              <div class="form-group col-3">
                <input type="submit" value="登録する" class="btn btn-primary">
              </div>
          </div>
      </div>
      <input type="hidden" class="form-control" name="done" value="1">
    </form>
      @if ($errors->has('content'))
      <div class="invalid-feedback">
        {{ $errors->first('content') }}
      </div>
      @endif

        @foreach ($todos as $todo)

          <form action="{{ route('update', ['id' => $todo->id]) }}" method="post">
          @method('PUT')
            {{ csrf_field() }}
              <div class="form-group">
                <input type="submit" value="済" class="btn btn-info">
              </div>
           </form>

          {{ $todo->content }}

          <div class="form-group">
            <a href="{{ route('delete', ['id' => $todo->id]) }}" class="btn btn-danger delete-btn">削除</a>
          </div>
        @endforeach
</div>

