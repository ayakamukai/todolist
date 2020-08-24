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
        
        </style>

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
      @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif

      
      @foreach ($todos as $todo)
        <div class="row m-3" style="margin:0 auto;">
          <div class="todo col-6">
            <ul>
             <li><sapn class="">{{ $todo->content }}</span></li>
            </ul>
          </div>
        </div>
      @endforeach

  </div>
</div>

