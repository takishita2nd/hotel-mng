@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">スケジュール</div>

                <div class="panel-body">
                    {!! Form::open(['url' => action('RegisterManagementController@scheduleToMonthly')]) !!}
                    <table>
                        <tr>
                            <td>{!! Form::selectYear('year', 2019, 2020) !!}年</td>
                            <td>{!! Form::selectMonth('month') !!}</td>
                            <td>{!! Form::submit('表示') !!}</td>
                        </tr>
                    </table>
                    {!! Form::close() !!}
                    <table class="schedule">
                        <tr>
                            <th>日時</th>
                            <th>名前</th>
                        </tr>
                    @foreach ($Lists as $list)
                        <tr>
                            <td>{{ $list['day'] }}</td>
                            <td>{{ $list['name'] }}</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
                <div>{{ Html::link('/management', '戻る', ['class' => 'btn']) }}</div>
            </div>
        </div>
    </div>
</div>
@endsection