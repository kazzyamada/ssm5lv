@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Entries
            <a class="btn btn-success pull-right" href="{{ route('entries.create') }}"><i class="glyphicon glyphicon-plus"></i> {{ trans('ui.create') }}</a>
        </h1>

    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if($entries->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TITLE</th>
                        <th>HOUR</th>
                        <th>PRE</th>
                        <th>ESTIMATED</th>
                        <th>ACCEPTED</th>
                        <th>START</th>
                        <th>END</th>
                        <th>MAINTE</th>
                        <th>STATUS</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($entries as $entry)
                            <tr>
                                <td>{{$entry->id}}</td>
                                <td>{{$entry->title}}</td>
                    <td>{{$entry->hour}}</td>
                    <td>{{$entry->pre}}</td>
                    <td>{{$entry->estimated}}</td>
                    <td>{{$entry->accepted}}</td>
                    <td>{{$entry->start}}</td>
                    <td>{{$entry->end}}</td>
                    <td>{{$entry->mainte}}</td>
                    <td>{{$entry->status}}</td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('entries.show', $entry->id) }}"><i class="glyphicon glyphicon-eye-open"></i> {{ trans('ui.view') }}</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('entries.edit', $entry->id) }}"><i class="glyphicon glyphicon-edit"></i> {{ trans('ui.edit') }}</a>
                                    <form action="{{ route('entries.destroy', $entry->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('{{ trans('ui.areyousuredelete')}}')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> {{ trans('ui.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $entries->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection
