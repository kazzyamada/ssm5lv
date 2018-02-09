@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Days / Edit #{{$day->id}}</h1>
    </div>
@endsection

@section('content')

<!--    @include('error') -->

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('days.update', $day->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('dd')) has-error @endif">
                       <label for="dd-field">Dd</label>
                    <input type="text" id="dd-field" name="dd" class="form-control date-picker" value="{{ is_null(old("dd")) ? $day->dd : old("dd") }}"/>
                       @if($errors->has("dd"))
                        <span class="help-block">{{ $errors->first("dd") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('days.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
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
