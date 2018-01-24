@extends('layouts.app')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Tasks / Create </h1>
    </div>
@endsection

@section('content')
<div class="container">
@yield('header')

    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('tasks.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('entries_id')) has-error @endif">
                       <label for="entries_id-field">Entries_id</label>
                    <input type="text" id="entries_id-field" name="entries_id" class="form-control" value="{{ old("entries_id") }}"/>
                       @if($errors->has("entries_id"))
                        <span class="help-block">{{ $errors->first("entries_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('log')) has-error @endif">
                       <label for="log-field">Log</label>
                    <textarea class="form-control" id="log-field" rows="3" name="log">{{ old("log") }}</textarea>
                       @if($errors->has("log"))
                        <span class="help-block">{{ $errors->first("log") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('task_day')) has-error @endif">
                       <label for="task_day-field">Task_day</label>
                    <input type="text" id="task_day-field" name="task_day" class="form-control date-picker" value="{{ old("task_day") }}"/>
                       @if($errors->has("task_day"))
                        <span class="help-block">{{ $errors->first("task_day") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('task_hour')) has-error @endif">
                       <label for="task_hour-field">Task_hour</label>
                    <input type="text" id="task_hour-field" name="task_hour" class="form-control" value="{{ old("task_hour") }}"/>
                       @if($errors->has("task_hour"))
                        <span class="help-block">{{ $errors->first("task_hour") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('tasks.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
        format: "yyyy-mm-dd",
        language: 'ja'
    });
  </script>
@endsection
