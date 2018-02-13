@extends('layout')

@section('header')
<div class="page-header">
        <h1>Users / Show #{{$user->id}}</h1>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('{{ trans('ui.areyousuredelete')}}')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('users.edit', $user->id) }}"><i class="glyphicon glyphicon-edit"></i> {{ trans('ui.edit') }}</a>
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
                     <label for="entries_id">NAME</label>
                     <p class="form-control-static">{{$user->name}}</p>
                </div>
                    <div class="form-group">
                     <label for="log">EMAIL</label>
                     <p class="form-control-static">{{$user->email}}</p>
                </div>
                    <div class="form-group">
                     <label for="task_day">PASSWORD</label>
                    <p class="form-control-static"></p>
            </form>

            <a class="btn btn-link" href="{{ route('users.index') }}"><i class="glyphicon glyphicon-backward"></i>  {{ trans('ui.back') }}</a>

        </div>
    </div>
@endsection
