@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Entries / Create </h1>
    </div>
@endsection

@section('content')

    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('entries.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('title')) has-error @endif">
                       <label for="title-field">Title</label>
                    <textarea class="form-control" id="title-field" rows="3" name="title">{{ old("title") }}</textarea>
                       @if($errors->has("title"))
                        <span class="help-block">{{ $errors->first("title") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('hour')) has-error @endif">
                       <label for="hour-field">Hour</label>
                    <input type="text" id="hour-field" name="hour" class="form-control" value="{{ old("hour") }}"/>
                       @if($errors->has("hour"))
                        <span class="help-block">{{ $errors->first("hour") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('pre')) has-error @endif">
                       <label for="pre-field">Pre</label>
                    <input type="text" id="pre-field" name="pre" class="form-control date-picker" value="{{ old("pre") }}"/>
                       @if($errors->has("pre"))
                        <span class="help-block">{{ $errors->first("pre") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('estimated')) has-error @endif">
                       <label for="estimated-field">Estimated</label>
                    <input type="text" id="estimated-field" name="estimated" class="form-control date-picker" value="{{ old("estimated") }}"/>
                       @if($errors->has("estimated"))
                        <span class="help-block">{{ $errors->first("estimated") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('accepted')) has-error @endif">
                       <label for="accepted-field">Accepted</label>
                    <input type="text" id="accepted-field" name="accepted" class="form-control date-picker" value="{{ old("accepted") }}"/>
                       @if($errors->has("accepted"))
                        <span class="help-block">{{ $errors->first("accepted") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('start')) has-error @endif">
                       <label for="start-field">Start</label>
                    <input type="text" id="start-field" name="start" class="form-control date-picker" value="{{ old("start") }}"/>
                       @if($errors->has("start"))
                        <span class="help-block">{{ $errors->first("start") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('end')) has-error @endif">
                       <label for="end-field">End</label>
                    <input type="text" id="end-field" name="end" class="form-control date-picker" value="{{ old("end") }}"/>
                       @if($errors->has("end"))
                        <span class="help-block">{{ $errors->first("end") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('mainte')) has-error @endif">
                       <label for="mainte-field">Mainte</label>
                    <input type="text" id="mainte-field" name="mainte" class="form-control date-picker" value="{{ old("mainte") }}"/>
                       @if($errors->has("mainte"))
                        <span class="help-block">{{ $errors->first("mainte") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('status')) has-error @endif">
                       <label for="status-field">Status</label>
                    <textarea class="form-control" id="status-field" rows="3" name="status">{{ old("status") }}</textarea>
                       @if($errors->has("status"))
                        <span class="help-block">{{ $errors->first("status") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('entries.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
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
