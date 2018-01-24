@extends('layouts.app')
@section('header')
<div class="page-header">
        <h1>Tasks / Show #{{$task->id}}</h1>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('tasks.edit', $task->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </form>
    </div>
@endsection

@section('content')
<div class="container">
@yield('header')

    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static"></p>
                </div>
                <div class="form-group">
                     <label for="entries_id">ENTRIES_ID</label>
                     <p class="form-control-static">{{$task->entries_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="log">LOG</label>
                     <p class="form-control-static">{{$task->log}}</p>
                </div>
                    <div class="form-group">
                     <label for="task_day">TASK_DAY</label>
                     <p class="form-control-static">{{$task->task_day}}</p>
                </div>
                    <div class="form-group">
                     <label for="task_hour">TASK_HOUR</label>
                     <p class="form-control-static">{{$task->task_hour}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('tasks.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>
</div>

@endsection
