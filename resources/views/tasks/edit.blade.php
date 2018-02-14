@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Tasks / Edit #{{$task->id}}</h1>
    </div>
@endsection

@section('content')

<!--    @include('error') -->

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('entries_id')) has-error @endif">
                       <label for="entries_id-field">Entry_id</label>
                    <select class="form-control" name="entries_id">
                       @foreach($entries as $entry)
                       <option value="{{$entry->id}}" {{$entry->selected}}>{{$entry->id}}:{{$entry->title}}</option>
                       @endforeach
                    </select>

                    </div>



                    <div class="form-group @if($errors->has('log')) has-error @endif">
                       <label for="log-field">Log</label>
                    <textarea class="form-control" id="log-field" rows="3" name="log">{{ is_null(old("log")) ? $task->log : old("log") }}</textarea>
                       @if($errors->has("log"))
                        <span class="help-block">{{ $errors->first("log") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('task_day')) has-error @endif">
                       <label for="task_day-field">Date</label>
                    <input type="text" id="task_day-field" name="task_day" class="form-control date-picker" value="{{ is_null(old("task_day")) ? $task->task_day : old("task_day") }}"/>
                       @if($errors->has("task_day"))
                        <span class="help-block">{{ $errors->first("task_day") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('task_hour')) has-error @endif">
                       <label for="task_hour-field">Hour</label>
                    <input type="text" id="task_hour-field" name="task_hour" class="form-control" value="{{ is_null(old("task_hour")) ? $task->task_hour : old("task_hour") }}"/>
                       @if($errors->has("task_hour"))
                        <span class="help-block">{{ $errors->first("task_hour") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">{{ trans('ui.save') }}</button>
                    <a class="btn btn-link pull-right" href="{{ route('tasks.index') }}"><i class="glyphicon glyphicon-backward"></i>  {{ trans('ui.back') }}</a>
                </div>
            </form>

        </div>
    </div>

@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/locales/bootstrap-datepicker.ja.min.js"></script>
  <script>
    $('.date-picker').datepicker({
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd",
        language: 'ja'
    });
  </script>
@endsection
