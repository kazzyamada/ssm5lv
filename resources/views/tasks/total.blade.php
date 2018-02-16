@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Total
        </h1>

    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if(count($totals))
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                        <th>id</th>
                        <th>title</th>
                        <th>project_days</th>
                        <th>project_hour</th>
                        <th>man_hour</th>
                        <th>remain</th>
                        <th>start</th>
                        <th>end</th>
                        <th>status</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($totals as $total)
                        <tr>
                        <td>{{$total->id}}</td>
                        <td>{{$total->title}}</td>
                        <td>{{$total->days}}</td>
                        <td>{{$total->hour}}</td>
                        <td>{{$total->man_hour}}</td>
                        <td>{{$total->remain}}</td>
                        <td>{{$total->pre}}</td>
                        <td>{{$total->end}}</td>
                        <td>{{$total->status}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection
