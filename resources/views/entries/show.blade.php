@extends('layouts.app')
@section('header')
<div class="page-header">
        <h1>Entries / Show #{{$entry->id}}</h1>
        <form action="{{ route('entries.destroy', $entry->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('entries.edit', $entry->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
                     <label for="title">TITLE</label>
                     <p class="form-control-static">{{$entry->title}}</p>
                </div>
                    <div class="form-group">
                     <label for="hour">HOUR</label>
                     <p class="form-control-static">{{$entry->hour}}</p>
                </div>
                    <div class="form-group">
                     <label for="pre">PRE</label>
                     <p class="form-control-static">{{$entry->pre}}</p>
                </div>
                    <div class="form-group">
                     <label for="estimated">ESTIMATED</label>
                     <p class="form-control-static">{{$entry->estimated}}</p>
                </div>
                    <div class="form-group">
                     <label for="accepted">ACCEPTED</label>
                     <p class="form-control-static">{{$entry->accepted}}</p>
                </div>
                    <div class="form-group">
                     <label for="start">START</label>
                     <p class="form-control-static">{{$entry->start}}</p>
                </div>
                    <div class="form-group">
                     <label for="end">END</label>
                     <p class="form-control-static">{{$entry->end}}</p>
                </div>
                    <div class="form-group">
                     <label for="mainte">MAINTE</label>
                     <p class="form-control-static">{{$entry->mainte}}</p>
                </div>
                    <div class="form-group">
                     <label for="status">STATUS</label>
                     <p class="form-control-static">{{$entry->status}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('entries.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>
</div>

@endsection
