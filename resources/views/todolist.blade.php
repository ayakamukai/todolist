<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <title>To Do List</title>

      <style type="text/css">
      .invalid-feedback{
          display: block;
        }
      .status{
          text-decoration: line-through;
        }
      .delete{
          border: none;
          background-color:transparent;
          color:blue;
          text-decoration:underline;
      }
      </style>
  </head>
  
<body>
<div class="container">
  <div class="m-2 p-3 bg-white">
    <h3 class="mb-5">ToDo</h3>

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
        <div class="alert alert-danger">
          {{ $errors->first('content') }}
        </div>
      @endif
      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif
      @if (session('status'))
        <div class="alert alert-primary">
          {{ session('status') }}
        </div>
      @endif

      @if(count($todos) > 0)
        @foreach ($todos as $todo)
          <div class="row m-3" style="margin:0 auto;">
          @if( $todo->status == 0)
            <div class="form-group col-2">
              <form class="form-inline" action="{{ route('update', ['id' => $todo->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <button type="submit" class="btn btn-info">済</button>
              </form>
            </div>
          @elseif( $todo->status == 1)
          <div class="todo col-2">
            <sapn >{{ $todo->date->format('Y-n-j') }}</span>
          </div>
          @endif
            <div class="todo col-8">
              <sapn class="@if($todo->status == 1) status @endif">{{ $todo->content }}</span>
            </div>
            <div class="form-group col-2">
              <form class="form-inline" action="{{ route('delete', ['id' => $todo->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <input type="submit" value="✕" class="delete">
              </form>
            </div>
          </div>
        @endforeach
      @else
        <div class="todo col-8">Todoがありません</div>
      @endif
  </div>
</div>
</body>
</html>

