@extends('layout')
@section('header')
<div class="page-header">
        <h1>Tasks / Show #{{$task->id}}</h1>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('{{ trans('ui.areyousuredelete')}}')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('tasks.edit', $task->id) }}"><i class="glyphicon glyphicon-edit"></i> {{ trans('ui.edit') }}</a>
                <button type="submit" class="btn btn-danger">{{ trans('ui.delete') }} <i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </form>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static"></p>
                </div>
                <div class="form-group">
                     <label for="entries_id">ENTRY_ID</label>
                     <p class="form-control-static">{{$task->entries_id}}</p>
                </div>
                <div class="form-group">
                     <label for="entry_title">TITLE</label>
                     <p class="form-control-static">{{$task->entry->title}}</p>
                </div>
                    <div class="form-group">
                     <label for="log">LOG</label>
                     <p class="form-control-static">{{$task->log}}</p>
                </div>
                    <div class="form-group">
                     <label for="task_day">DATE</label>
                     <p class="form-control-static">{{$task->task_day}}</p>
                </div>
                    <div class="form-group">
                     <label for="task_hour">HOUR</label>
                     <p class="form-control-static">{{$task->task_hour}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('tasks.index') }}"><i class="glyphicon glyphicon-backward"></i>  {{ trans('ui.back') }}</a>

        </div>
    </div>
</div>

@endsection
